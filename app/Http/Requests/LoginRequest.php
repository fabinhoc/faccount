<?php

namespace App\Http\Requests;

class LoginRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'string|email|required',
            'password' => 'string|required'
        ];
    }
}
