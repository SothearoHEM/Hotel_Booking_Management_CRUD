<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'room_id' => ['required', 'exists:rooms,id'],
            'guest_id' => ['required', 'exists:guests,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'room_id.required' => 'Please select a room.',
            'room_id.exists' => 'The selected room does not exist.',
            'guest_id.required' => 'Please select a guest.',
            'guest_id.exists' => 'The selected guest does not exist.',
            'check_in.required' => 'Check-in date is required.',
            'check_in.after_or_equal' => 'Check-in date must be today or a future date.',
            'check_out.required' => 'Check-out date is required.',
            'check_out.after' => 'Check-out date must be after check-in date.',
            'status.required' => 'Booking status is required.',
            'status.in' => 'Invalid booking status selected.',
        ];
    }
}
