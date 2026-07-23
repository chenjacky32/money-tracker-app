<?php

namespace App\Http\Controllers;

use App\Actions\CreateTransactionAction;
use App\Actions\DeleteTransactionAction;
use App\Actions\GetTransactionHistoryAction;
use App\Actions\UpdateTransactionAction;
use App\DTOs\CreateTransactionDTO;
use App\DTOs\TransactionFilterDTO;
use App\DTOs\UpdateTransactionDTO;
use App\Http\Requests\Transaction\GetHistoryRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Repositories\CategoryRepository;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(GetHistoryRequest $request, GetTransactionHistoryAction $action): View
    {
        $selectedMonthYear = $request->input('month_year') ?: now()->format('m/Y');

        $filter = TransactionFilterDTO::fromRequest(Auth::id(), $selectedMonthYear);
        $data = $action->execute($filter);

        return view('transactions.index', [
            'transactions' => $data['transactions'],
            'summary' => $data['summary'],
            'selectedMonthYear' => $selectedMonthYear,
        ]);
    }

    public function create(CategoryRepository $categoryRepo): View
    {
        $categories = $categoryRepo->getAllForUser(Auth::id());

        return view('transactions.create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreTransactionRequest $request, CreateTransactionAction $action): RedirectResponse
    {
        $dto = CreateTransactionDTO::fromRequest($request, Auth::id());
        $action->execute($dto, $request->input('custom_category_name'));

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(int $id, TransactionService $service, CategoryRepository $categoryRepo): View
    {
        $transaction = $service->getTransactionForUser($id, Auth::id());
        if (! $transaction) {
            abort(404, 'Transaksi tidak ditemukan.');
        }

        $categories = $categoryRepo->getAllForUser(Auth::id());

        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateTransactionRequest $request, int $id, UpdateTransactionAction $action): RedirectResponse
    {
        $dto = UpdateTransactionDTO::fromRequest($request, $id, Auth::id());
        $action->execute($dto, $request->input('custom_category_name'));

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(int $id, DeleteTransactionAction $action): RedirectResponse
    {
        try {
            $action->execute($id, Auth::id());

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('transactions.index')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
