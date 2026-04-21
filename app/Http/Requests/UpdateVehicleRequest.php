<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'plate' => 'sometimes|string|max:20',
            'brand' => 'sometimes|string|max:100',
            'model' => 'sometimes|string|max:100',
            'year' => 'sometimes|integer|min:1900|max:2100',
            'vehicle_type' => 'sometimes|string|max:50',
            'capacity' => 'sometimes|integer|min:1|max:255',
            'fuel_type' => 'sometimes|string|max:50',
            'image_path' => 'sometimes|string|max:255',
            'status' => 'nullable|in:available,reserved,maintenance,out_of_service',
            'current_mileage' => 'nullable|integer|min:0',
        ];
    }
}
