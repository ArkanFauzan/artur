<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // also as payment proof image name
            $table->uuid('id')->primary();
            // owner
            $table->foreignUuid('user_id')->references('id')->on('accounts')->onDelete('cascade');
            // detail transacion
            $table->string('product_name')->nullable();
            $table->string('net_price')->nullable();
            $table->string('gross_price')->nullable();
            $table->string('profit')->nullable();
            $table->string('ongkir')->nullable();
            // extension of payment proof image
            $table->string('file_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
