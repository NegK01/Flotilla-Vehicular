<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequestRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // driver_id: el controller lo sobreescribe con auth()->id() para choferes (fix IDOR)
            'driver_id'  => 'required|integer',
            'vehicle_id'  => 'required|integer',
            'start_at'    => 'required|date|after:now',
            'end_at'      => 'required|date|after:start_at',
            'observation' => 'nullable|string|max:500',
        ];
    }
}
