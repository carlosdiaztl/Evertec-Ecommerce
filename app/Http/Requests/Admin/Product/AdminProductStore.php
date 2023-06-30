<?php

namespace App\Http\Requests\Admin\Product;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;

class AdminProductStore extends FormRequest
{
    private $status;
    private $stock;
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
        return [
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:250'],
            'status' => ['required', 'in:' . implode(',', Constants::getProductStatusOptions())],
            'category_id' => ['required', 'exists:categories,id'],
            'stock' => ['required', 'int', 'min:1', 'max:9999'],
            'price' => ['required', 'int', 'min:1000', 'max:1000000'],
            'image' => [ 'image', 'mimes:jpeg,png', 'max:2000'],
        ];
    }

    public function withValidator($validator)
    {
        $this->status = $this->input('status');
        $this->stock = $this->input('stock');
        $validator->after(function ($validator) {
            if ($this->status == 'available' && $this->stock == 0) {
                $validator->errors()->add('stock', 'If available must have stock');
            }
        });
    }
}
