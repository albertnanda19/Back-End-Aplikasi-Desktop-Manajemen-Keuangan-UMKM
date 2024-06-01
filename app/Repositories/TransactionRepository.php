<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::all();
    }

    public function getTransactionById($id)
    {
        return Transaction::findOrFail($id);
    }

    public function createTransaction(array $data)
    {
        return Transaction::create($data);
    }

    public function updateTransaction($id, array $data)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);
        return $transaction;
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return $transaction;
    }

    public function getTotalAmountByTypeAndDateRange($type, $fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate)->startOfDay();
        $toDate = Carbon::parse($toDate)->endOfDay();

        return Transaction::where("type", $type)
            ->whereBetween("created_at", [$fromDate, $toDate])
            ->sum("amount");
    }
}
