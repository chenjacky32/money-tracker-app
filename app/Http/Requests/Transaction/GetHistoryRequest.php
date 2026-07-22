<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class GetHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'month_year' => ['nullable', 'regex:/^\d{2}\/\d{4}$/'],
        ];
    }
}
