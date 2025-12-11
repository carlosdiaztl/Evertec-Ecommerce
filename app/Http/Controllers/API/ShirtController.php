<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shirt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShirtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
       $shirts = Shirt::query()->paginate(10);
       return response()->json($shirts);

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
    public function show($id): JsonResponse
    {
        try {
            $shirts = Shirt::query()->where('id', $id)->firstOrFail();
    
            // Devolver el shirtso como respuesta JSON
            return response()->json($shirts);
        } catch (ModelNotFoundException $exception) {
            // Si no se encuentra el shirtso, devolver una respuesta 404 Not Found
            return response()->json(['error' => 'camisa no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
