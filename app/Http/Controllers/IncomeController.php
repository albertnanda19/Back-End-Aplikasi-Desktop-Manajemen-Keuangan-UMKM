<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreIncomeRequest;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class IncomeController extends Controller
{
    public function store(StoreIncomeRequest $request)
    {
        $validated = $request->validated();

        try {
            $category = Category::findOrFail($validated["category"]);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::createResponse(
                400,
                "Kategori tidak valid",
                null
            );
        }

        $transaction = new Transaction();
        $transaction->id = Str::uuid()->toString();
        $transaction->type = "income";
        $transaction->amount = $validated["amount"];
        $transaction->category_id = $validated["category"];
        $transaction->note = $validated["note"];
        $transaction->created_at =
            $validated["date"] . " " . $validated["time"];
        $transaction->updated_at =
            $validated["date"] . " " . $validated["time"];
        $transaction->save();

        return ResponseHelper::createResponse(
            201,
            "Berhasil menambahkan data pemasukan",
            null
        );
    }
}
