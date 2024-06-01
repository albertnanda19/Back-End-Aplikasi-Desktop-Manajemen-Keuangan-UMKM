<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        $now = Carbon::now();

        $transactions = [
            [
                "id" => Str::uuid()->toString(),
                "type" => "expense",
                "amount" => 50000,
                "category_id" => $categories[0]->id,
                "note" => "Beli makan siang",
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "id" => Str::uuid()->toString(),
                "type" => "expense",
                "amount" => 15000,
                "category_id" => $categories[1]->id,
                "note" => "Naik ojek online",
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "id" => Str::uuid()->toString(),
                "type" => "income",
                "amount" => 2000000,
                "category_id" => $categories[2]->id,
                "note" => "Gaji bulan ini",
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "id" => Str::uuid()->toString(),
                "type" => "expense",
                "amount" => 75000,
                "category_id" => $categories[3]->id,
                "note" => "Beli buku pelajaran",
                "created_at" => $now,
                "updated_at" => $now,
            ],
            [
                "id" => Str::uuid()->toString(),
                "type" => "expense",
                "amount" => 100000,
                "category_id" => $categories[4]->id,
                "note" => "Nonton bioskop",
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ];

        DB::table("transaction")->insert($transactions);
    }
}
