<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::connection()->enableQueryLog();
        if (auth()->user()->role_id === 2) {

            $users = User::paginate(10);
            $users->items();
            return view('users.index', compact('users'));
        }
        return redirect()->back()->withErrors('No tienes acceso a esta vista ');
        //
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
        if (auth()->user()->role_id === 2) {


            return view('users.show', compact('user'));
        }
        return redirect()->back()->withErrors('No tienes acceso a esta funcion ');
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
    public function update(Request $request, User $user)
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
