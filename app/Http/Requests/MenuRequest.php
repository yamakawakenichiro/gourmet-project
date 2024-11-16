<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'menu.image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'menu.shop_name' => 'required|string|max:25',
            'menu.name' => 'required|string|max:25',
            'menu.price' => 'required|integer|min:0|max:999999',
            'menu.count' => 'required|integer|min:0|max:100',
            'menu.body' => 'nullable|max:500',

            'menu.latitude' => 'nullable|numeric',
            'menu.longitude' => 'nullable|numeric',
        ];
    }
}
