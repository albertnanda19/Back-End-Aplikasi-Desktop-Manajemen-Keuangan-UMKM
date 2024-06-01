<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("transaction", function (Blueprint $table) {
            $table->string("id")->primary();
            $table->enum("type", ["income", "expense"]);
            $table->integer("amount");
            $table->string("category_id");
            $table->text("note")->nullable();
            $table->timestamps();

            $table->foreign("category_id")->references("id")->on("category");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("transaction");
    }
}
