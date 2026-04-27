<?php

namespace App\Http\Requests\VehicleRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DirectAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'driver_id'   => [
                'required',

            ],
            'vehicle_id'  => [
                'required',
            ],
            'start_at'    => 'required|date|after:now',
            'end_at'      => 'required|date|after:start_at',
            'observation' => 'nullable|string|max:500',
        ];
    }
}
