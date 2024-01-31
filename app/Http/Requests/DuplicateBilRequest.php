<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DuplicateBilRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'notebook_id' => ['required', 'integer', 'exists:notebooks,id'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900'],
            'month' => ['required', 'digits:2', 'in:01,02,03,04,05,06,07,08,09,10,11,12'],
            'duplicateYear' => ['required', 'integer', 'digits:4', 'min:1900'],
            'duplicateMonth' => ['required', 'digits:2', 'in:01,02,03,04,05,06,07,08,09,10,11,12'],
        ];
    }
}
