<?php

namespace App\Repositories;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function getTransactionById($id);
    public function createTransaction(array $data);
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
    public function getTotalAmountByTypeAndDateRange($type, $fromDate, $toDate);
}
