<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockoutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('stock_out_id')->unsigned();
            $table->string('category');
            $table->string('unit');
            $table->double('price');
            $table->integer('quantity');
            $table->integer('amount');
            $table->timestamps();


            $table->foreign('stock_out_id')->references('id')->on('stock_outs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockout_details');
    }
}
