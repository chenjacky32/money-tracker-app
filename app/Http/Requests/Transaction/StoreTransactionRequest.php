<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authed via middleware
    }

    public function rules(): array
    {
        return [
            'transaction_type' => ['required', 'in:pemasukan,pengeluaran'],
            'category_id' => ['required', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'date' => ['required', 'date_format:Y-m-d'],
            'note' => ['nullable', 'string', 'max:1000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // 1. Clean and convert amount to float
        $amount = $this->input('amount');
        if (is_string($amount)) {
            $amount = str_replace('.', '', $amount);
        }

        // 2. Parse Indonesian Date Format (e.g. '23 Jul 2026', '23 Mei 2026')
        $date = $this->input('date');
        $parsedDate = null;
        if ($date) {
            // Translate Indonesian month names to English for Carbon parsing
            $replacements = [
                'Mei' => 'May',
                'Agu' => 'Aug',
                'Okt' => 'Oct',
                'Des' => 'Dec'
            ];
            $translatedDate = str_replace(array_keys($replacements), array_values($replacements), $date);
            try {
                $parsedDate = Carbon::createFromFormat('d M Y', $translatedDate)->format('Y-m-d');
            } catch (\Exception $e) {
                // Fallback to normal parsing if format fails
                try {
                    $parsedDate = Carbon::parse($translatedDate)->format('Y-m-d');
                } catch (\Exception $ex) {
                    $parsedDate = null;
                }
            }
        }

        $this->merge([
            'amount' => $amount ? (float) $amount : null,
            'date' => $parsedDate,
        ]);
    }
}
