<?php

namespace App\Http\Requests;

class ResetPasswordRequest extends AbstractRequest
{
    // store the length of the title in a constant
    // to make it available outside the class
    const PASSWORD_MIN_LENGTH = 6;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:' . self::PASSWORD_MIN_LENGTH,
        ];
    }
}
