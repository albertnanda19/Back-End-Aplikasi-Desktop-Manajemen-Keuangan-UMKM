<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Repositories\TransactionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $transactionRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        $fromDate = Carbon::now()->subMonth()->toDateString();
        $toDate = Carbon::today()->toDateString();

        $income = intval($this->transactionRepository->getTotalAmountByTypeAndDateRange(
            "income",
            $fromDate,
            $toDate
        ));
        $expense = intval($this->transactionRepository->getTotalAmountByTypeAndDateRange(
            "expense",
            $fromDate,
            $toDate
        ));
        $profit = $income - $expense;

        $detailIncome = [];
        $detailExpense = [];
        $detailProfit = [];

        $currentDate = Carbon::now()->subMonth();
        $endDate = Carbon::today();

        while ($currentDate->lte($endDate)) {
            $date = $currentDate->toDateString();

            $dailyIncome = intval($this->transactionRepository->getTotalAmountByTypeAndDateRange(
                "income",
                $date,
                $date
            ));
            $dailyExpense = intval($this->transactionRepository->getTotalAmountByTypeAndDateRange(
                "expense",
                $date,
                $date
            ));
            $dailyProfit = $dailyIncome - $dailyExpense;

            $detailIncome[] = [
                "date" => $date,
                "amount" => $dailyIncome,
            ];
            $detailExpense[] = [
                "date" => $date,
                "amount" => $dailyExpense,
            ];
            $detailProfit[] = [
                "date" => $date,
                "amount" => $dailyProfit,
            ];

            $currentDate->addDay();
        }

        $data = [
            "profit" => [
                "amount" => $profit,
                "from_date" => $fromDate,
                "to_date" => $toDate,
                "detail" => $detailProfit,
            ],
            "income" => [
                "amount" => $income,
                "from_date" => $fromDate,
                "to_date" => $toDate,
                "detail" => $detailIncome,
            ],
            "expense" => [
                "amount" => $expense,
                "from_date" => $fromDate,
                "to_date" => $toDate,
                "detail" => $detailExpense,
            ],
        ];

        return ResponseHelper::createResponse(
            200,
            "Berhasil mendapatkan data dashboard",
            $data
        );
    }
}
