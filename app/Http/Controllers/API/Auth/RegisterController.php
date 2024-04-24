<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'lastName'=>$request->get('lastName'),
            'phone'=>$request->get('phone'),
            'identification'=>$request->get('identification'),
            'address'=>$request->get('address'),
            'password' => bcrypt($request->get('password')),
        ]);

        return response()->json([
            'message' => trans('the user was register successfully', ['attribute' => 'user']),
            'user' => $user->only(['name', 'email']),
        ], 201);
    }
    //
}
