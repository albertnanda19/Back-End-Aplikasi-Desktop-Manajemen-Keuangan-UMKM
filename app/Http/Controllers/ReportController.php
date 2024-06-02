<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Repositories\TransactionRepositoryInterface;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getReport(Request $request)
    {
        $date = $request->query('date', Carbon::now()->toDateString());

        $transactions = $this->transactionRepository->getTransactionsByDate($date);

        $responseData = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'date' => $transaction->created_at->toDateString(),
            ];
        });

        return ResponseHelper::createResponse(200, 'Berhasil mendapatkan data laporan.', $responseData);
    }
}
