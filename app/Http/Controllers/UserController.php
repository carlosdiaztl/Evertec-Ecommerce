<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\CheckUserAccess;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware(CheckUserAccess::class . ':user');
    }

    //
    public function edit(User $user)
    {


        return view('user.edit', compact('user'));
    }

    public function Update(UpdateUser $request, User $user)
    {


        if ($request->has('password')) {

            $user->update(
                [
                    'password' => Hash::make($request->password),
                ]
            );

            return redirect()->back()->withSuccess("Clave modificada con exito ");
        }
        if ($request->has('image')) {
            // fasat storage storage para buscar el patch de la imagen actual y borrarla

            $filePath = public_path($user->image);
            // Verificar si el archivo existe y eliminarlo si es así
            if (file_exists($filePath)) {
                Storage::delete('public/images/' . $user->image);
                unlink($filePath);
            }
            $path = $request['image']->store('public/images');
            $newpath = str_replace("public", "storage", $path);
            $user->update(
                [
                    'image' => $newpath,
                ]
            );

            return redirect()->back()->withSuccess("Imagen actualizada con exito ");
        }


        if ($request['email'] !== $user->email) {

            $user->email_verified_at = null;

            $user->update($request->all());
        }
        $user->update($request->all());

        return redirect()->back()->withSuccess("Usuario editado con exito");
    }
}
