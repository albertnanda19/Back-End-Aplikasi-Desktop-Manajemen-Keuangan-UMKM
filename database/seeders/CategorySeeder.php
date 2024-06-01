<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["id" => Str::uuid()->toString(), "name" => "Makanan"],
            ["id" => Str::uuid()->toString(), "name" => "Transportasi"],
            ["id" => Str::uuid()->toString(), "name" => "Kesehatan"],
            ["id" => Str::uuid()->toString(), "name" => "Pendidikan"],
            ["id" => Str::uuid()->toString(), "name" => "Hiburan"],
        ];

        DB::table("category")->insert($categories);
    }
}
