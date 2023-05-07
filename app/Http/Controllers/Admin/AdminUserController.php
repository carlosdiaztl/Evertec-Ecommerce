<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Requests\Admin\AdminUserFormRequest;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        DB::connection()->enableQueryLog();
        $search = $request->search;
        $users = User::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function exportPDF()
    {
        $users = User::all();
        $pdf = FacadePdf::loadView('admin.users.users-pdf-export', compact('users'));

        return $pdf->download('users-list.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    public function create()
    {
        //
    }

    public function show(User $user)
    {



        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
        //
    }

    public function update(AdminUserFormRequest $request, User $user)
    {


        if ($request->has('status')) {
            $user->update(
                [
                    'status' => $request->status,
                ]
            );

            $state = $request->status == 'active' ? 'activado' : 'desactivado';

            return redirect()->back()->withSuccess("Usuario {$state} con exito ");
        }
        if ($request->has('password')) {

            $user->update(
                [
                    'password' => Hash::make($request->password),
                ]
            );

            return redirect()->back()->withSuccess("Clave modificada con exito ");
        }

        return redirect()->back()->withErrors('Solo puedes actualizar la contraseña y el estado del usuario  ');
    }
}
