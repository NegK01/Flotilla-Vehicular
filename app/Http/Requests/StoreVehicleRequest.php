<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'plate' => 'required|string|max:20',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:2027',
            'vehicle_type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1|max:255',
            'fuel_type' => 'required|string|max:50',
            'image_path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|in:available,reserved,maintenance,out_of_service',
            'current_mileage' => 'nullable|integer|min:0',
        ];
    }
}
