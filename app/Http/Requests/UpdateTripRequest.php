<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
            'travel_route_id' => [
                'sometimes',
                'nullable',
                'integer',
            ],
            'departure_at'    => 'sometimes|date',
            'return_at'       => 'sometimes|nullable|date|after:departure_at',
            'return_mileage'  => 'sometimes|nullable|integer',
            'observations'    => 'sometimes|nullable|string',
        ];
    }
}
