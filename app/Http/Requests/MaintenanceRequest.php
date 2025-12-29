<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'photo' => ['nullable','image','mimes:jpg,jpeg,png','max:5120'],
            'conclusion_photo' => ['nullable','image','mimes:jpg,jpeg,png','max:5120'],
            'description' => ['nullable', 'string'],
            'pole_id' => 'required|integer',
        ];
    }
}
