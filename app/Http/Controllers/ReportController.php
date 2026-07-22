<?php

namespace App\Http\Controllers;

use App\Actions\GetReportAction;
use App\DTOs\ReportFilterDTO;
use App\Http\Requests\Transaction\GetReportRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(GetReportRequest $request, GetReportAction $action): View
    {
        $periodType = $request->input('period_type') ?: 'bulanan';
        $selectedMonthYear = $request->input('month_year') ?: now()->format('m/Y');
        $startDate = $request->input('start_date') ?: now()->startOfMonth()->toDateString();
        $endDate = $request->input('end_date') ?: now()->endOfMonth()->toDateString();

        $filter = ReportFilterDTO::fromRequest(
            Auth::id(),
            $periodType,
            $selectedMonthYear,
            $startDate,
            $endDate
        );

        $data = $action->execute($filter);

        return view('reports.index', [
            'summary' => $data['summary'],
            'incomes' => $data['incomes'],
            'expenses' => $data['expenses'],
            'periodType' => $periodType,
            'selectedMonthYear' => $selectedMonthYear,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
