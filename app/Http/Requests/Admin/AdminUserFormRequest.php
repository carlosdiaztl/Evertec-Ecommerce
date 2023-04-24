<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        // aqui se ponen las validaciondes del controlador 
        return [
            'status' => 'in:active,inactive',
            'password' => ['string', 'min:8', 'confirmed'],
            //
        ];
    }
    public function messages()
    {
        return [
            'status.in' => 'Los valores validos son activo e inactivo',
        ];
    }
}
