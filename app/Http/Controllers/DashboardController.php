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
        $fromDate = Carbon::yesterday()->toDateString();
        $toDate = Carbon::today()->toDateString();

        $income = $this->transactionRepository->getTotalAmountByTypeAndDateRange(
            "income",
            $fromDate,
            $toDate
        );
        $expense = $this->transactionRepository->getTotalAmountByTypeAndDateRange(
            "expense",
            $fromDate,
            $toDate
        );
        $profit = $income - $expense;

        $data = [
            "profit" => [
                "amount" => $profit,
                "from_date" => $fromDate,
                "to_date" => $toDate,
            ],
            "income" => [
                "amount" => $income,
                "from_date" => $fromDate,
                "to_date" => $toDate,
            ],
            "expense" => [
                "amount" => $expense,
                "from_date" => $fromDate,
                "to_date" => $toDate,
            ],
        ];

        return ResponseHelper::createResponse(
            200,
            "Berhasil mendapatkan data dashboard",
            $data
        );
    }
}
