<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        return [
            'name' => 'required',
            'id_category' => 'required|numeric|exists:categories,id',
            'description' => 'required',
            'prices.*' => 'required|numeric|min:0',
            'new_prices.*' => 'nullable|numeric|min:0',
        ];
    }
}
