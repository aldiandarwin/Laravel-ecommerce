<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'province' => ['required', 'exists:provinces,id'],
            'city' => ['required', 'exists:cities,id'],
            'subdistrict' => ['nullable', 'exists:subdistricts,id'],
            'address' => ['required'],
        ];
    }
}
