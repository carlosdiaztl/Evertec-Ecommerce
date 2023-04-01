<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUser;
use PDF;



class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:admin.users.index')->only('index');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if (!$this->middleware('can:admin.users.index')) {
        //     dd('no eres admin');
        //     return redirect()->back()->withErrors('No tienes acceso a esta vista');
        // }
        // dd('si eres admin');

        DB::connection()->enableQueryLog();


        // if (auth()->user()->role_id === 2) {
        $search = $request->search;
        $users = User::where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate();
        // $users->items();
        return view('admin.users.index', compact('users'));

        // $users->items();

        // }
        // return redirect()->back()->withErrors('No tienes acceso a esta vista ');
        // //
    }
    public function exportPDF()
    {
        $users = User::all();
        $pdf = PDF::loadView('admin.users.users-pdf-export', compact('users'));
        return $pdf->download('users-list.pdf');
        // return view('admin.users.users-pdf-export', compact('users'));
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
        // if (auth()->user()->role_id === 2) {


        return view('admin.users.show', compact('user'));
        // }
        // return redirect()->back()->withErrors('No tienes acceso a esta funcion ');
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        // dd($user);
        // dd($request->status);
        $user->update(
            [
                'status' => $request->status
            ]
        );
        // dd($user);
        $state = $request->status == 'active' ?  'activado' : 'desactivado';
        return redirect()->back()->withSuccess("Usuario {$state} con exito ");
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
