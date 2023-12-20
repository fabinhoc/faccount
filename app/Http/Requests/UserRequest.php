<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends AbstractRequest
{
    public function rules(): array
    {
        $id = isset($this->id) ? $this->id : 'NULL';
        return [
            'name' => ['required'],
            'email' => ['required', "unique:users,email,{$id},id"]
        ];
    }
}
