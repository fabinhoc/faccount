<?php

namespace App\Http\Requests;

class RegisterUserRequest extends AbstractRequest
{
    // store the length of the title in a constant
    // to make it available outside the class
    const NAME_MAX_LENGTH = 255;
    const PASSWORD_MIN_LENGTH = 6;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:' . self::NAME_MAX_LENGTH,
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:' . self::PASSWORD_MIN_LENGTH
        ];
    }
}
