<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'price' => ['required', 'decimal:0,2'],
            'is_paid' => ['nullable', 'boolean'],
            'total_paid' => ['nullable', 'decimal:0,2'],
            'due_date' => ['required', 'date_format:Y-m-d'],
            'tag_id' => ['nullable', 'integer', 'exists:tags,id'],
            'notebook_id' => ['integer', 'exists:notebooks,id']
        ];
    }
}
