<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
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
            'room_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('rooms', 'room_number')->ignore($this->room),
            ],
            'type' => ['required', 'string', 'max:255'],
            'price_per_night' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'status' => ['required', 'in:available,occupied,maintenance'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'room_number.required' => 'Room number is required.',
            'room_number.unique' => 'This room number already exists.',
            'type.required' => 'Room type is required.',
            'price_per_night.required' => 'Price per night is required.',
            'price_per_night.min' => 'Price must be greater than or equal to 0.',
            'status.required' => 'Room status is required.',
            'status.in' => 'Invalid room status selected.',
            'description.required' => 'Room description is required.',
        ];
    }
}
