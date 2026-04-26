<?php

namespace App\Http\Requests\VehicleRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StoreRequest extends FormRequest
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
            // driver_id no se pide en el payload porque el controller inyecta auth()->id() automáticamente
            'vehicle_id'  => [
                'required',
            ],
            'start_at'    => 'required|date|after:now',
            'end_at'      => 'required|date|after:start_at',
            'observation' => 'nullable|string|max:500',
        ];
    }
}
