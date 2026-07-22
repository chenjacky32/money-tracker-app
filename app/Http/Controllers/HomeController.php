<?php

namespace App\Http\Controllers;

use App\Actions\GetHomeDashboardAction;
use App\DTOs\HomeFilterDTO;
use App\Http\Requests\Transaction\GetHomeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(GetHomeRequest $request, GetHomeDashboardAction $action): View
    {
        $selectedMonthYear = $request->input('month_year') ?: now()->format('m/Y');

        $filter = HomeFilterDTO::fromRequest(Auth::id(), $selectedMonthYear);
        $data = $action->execute($filter);

        return view('home.index', [
            'summary' => $data['summary'],
            'incomes' => $data['incomes'],
            'expenses' => $data['expenses'],
            'latestTransactions' => $data['latestTransactions'],
            'selectedMonthYear' => $selectedMonthYear,
        ]);
    }
}
