<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckUserAccess;

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

    public function Update()
    {
    }
}
