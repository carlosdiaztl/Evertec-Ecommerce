<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckUserAccess;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Middleware global para todo el controlador
        // $this->middleware(CheckUserAccess::class);

        $this->middleware(CheckUserAccess::class . ':user');
    }


    //
    public function edit(User $user)
    {


        return view('user.edit', compact('user'));
    }

    public function Update(UpdateUser $request, User $user)
    {
        // dd($request);

        if ($request->has('password')) {

            $user->update(
                [
                    'password' =>  Hash::make($request->password)
                ]
            );




            return redirect()->back()->withSuccess("Clave modificada con exito ");
        }
        if ($request->has('image')) {
            $path = $request['image']->store('public/images');
            // dd($path);
            $newpath = str_replace("public", "storage", $path);
            // dd($path, $newpath);
            // dd($path);
            $user->update(
                [
                    'image' =>  $newpath
                ]
            );




            return redirect()->back()->withSuccess("Imagen actualizada con exito ");
        }




        if ($request['email'] !== $user->email) {

            $user->email_verified_at = null;

            $user->update($request->all());
        }
        $user->update($request->all());

        // dd($user);
        return redirect()->back()->withSuccess("Usuario editado con exito");
    }
}
