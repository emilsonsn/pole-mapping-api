<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoleRequest extends FormRequest
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
        $poleId = $this->route('pole')?->id ?? null;

        return [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'height' => 'required|numeric',
            'paving_id' => 'required|exists:pavings,id',
            'position_id' => 'required|exists:positions,id',
            'network_type_id' => 'required|exists:network_types,id',
            'connection_type_id' => 'required|exists:connection_types,id',
            'transformer_id' => 'required|exists:transformers,id',
            'access_id' => 'required|exists:accesses,id',
            'luminaire_quantity' => 'required|integer',
            'qrcode' => 'required|string|unique:poles,qrcode,' . $poleId,
        ];
    }
}
