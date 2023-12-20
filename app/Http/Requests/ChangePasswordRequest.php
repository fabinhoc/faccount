<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends AbstractRequest
{
    const PASSWORD_MIN_LENGTH = 6;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|string|confirmed|min:' . self::PASSWORD_MIN_LENGTH
        ];
    }
}
