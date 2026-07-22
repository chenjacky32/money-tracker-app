<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $transactionId = $this->route('transaction');
        if (!$transactionId) {
            return false;
        }

        $transaction = Transaction::find($transactionId);
        return $transaction && $transaction->user_id === $this->user()->id;
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
