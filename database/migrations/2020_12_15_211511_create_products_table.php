<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // also as product image name
            $table->uuid('id')->primary();
            // owner of product
            $table->foreignUuid('user_id')->references('id')->on('accounts')->onDelete('cascade');
            // detail of product
            $table->string('name')->nullable();
            $table->string('description',1000)->nullable();
            $table->string('net_price')->nullable();
            $table->string('gross')->nullable();
            $table->string('discount')->nullable();
            $table->string('profit')->nullable();
            $table->string('ig',1000)->nullable();
            $table->string('ecommerce',1000)->nullable();
            // type of product image, jpg, jpeg, or png
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
        Schema::dropIfExists('products');
    }
}
