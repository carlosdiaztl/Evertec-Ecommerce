<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
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
