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
            'remote_management_relay' => ['nullable','image','mimes:jpg,jpeg,png','max:5120'],
            'paving_id' => 'required|exists:pavings,id',
            'position_id' => 'required|exists:positions,id',
            'network_type_id' => 'required|exists:network_types,id',
            'connection_type_id' => 'required|exists:connection_types,id',
            'transformer_id' => 'required|exists:transformers,id',
            'access_id' => 'required|exists:accesses,id',
            'luminaire_quantity' => 'required|integer',
            'qrcode' => 'required|string|unique:poles,qrcode,' . $poleId,
            'characteristic_id' => 'required|exists:characteristics,id',
            'arm_id' => 'required|exists:arms,id',
            'lamp_id' => 'required|exists:lamps,id',
            'power_id' => 'required|exists:powers,id',
            'reactor_id' => 'required|exists:reactors,id',            
        ];
    }
}
