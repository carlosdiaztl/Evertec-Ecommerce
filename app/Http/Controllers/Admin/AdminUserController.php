<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUser;
//excel
use Maatwebsite\Excel\facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Hash;
//pdf
use PDF;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        DB::connection()->enableQueryLog();



        $search = $request->search;
        $users = User::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate();
        // $users->items();
        return view('admin.users.index', compact('users'));
    }
    public function exportPDF()
    {
        $users = User::all();
        $pdf = FacadePdf::loadView('admin.users.users-pdf-export', compact('users'));
        return $pdf->download('users-list.pdf');
        // return view('admin.users.users-pdf-export', compact('users'));
    }
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {



        return view('admin.users.show', compact('user'));


        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        // dd($request);

        if ($request->has('status')) {
            $user->update(
                [
                    'status' => $request->status
                ]
            );

            $state = $request->status == 'active' ?  'activado' : 'desactivado';
            return redirect()->back()->withSuccess("Usuario {$state} con exito ");
        }
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

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
