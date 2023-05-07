<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'password' => ['string', 'min:8', 'confirmed'],
            'name' => ['string', 'max:200', 'regex:/^[a-zA-Z\s]+$/'],
            'image' => ['image', 'mimes:jpeg,png', 'max:2000'],
            'lastName' => ['string', 'max:200', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'identification' => ['integer', 'min:999', 'max:9999999999', Rule::unique('users')->ignore($this->user()->id)],
            'phone' => ['string', 'min:10', 'max:10', 'regex:/^\d{10}$/', Rule::unique('users')->ignore($this->user()->id)],
            'address' => ['string', 'max:255', 'regex:/^[0-9a-zA-Z\s\#\-\.áéíóúñÁÉÍÓÚÑ\(\),]+$/'],

            //
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Porfavor proporciona un numero valido de 10 digitos',
        ];
    }
}
