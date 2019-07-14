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
        Schema::create('stockout_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('stockout_id')->unsigned()->nullable();;
            $table->double('original');
            $table->double('price');
            $table->integer('quantity');
            $table->integer('amount');
            $table->timestamps();


                  $table->foreign('stockout_id')
                              ->references('id')->on('stock_outs')
                              ->onDelete('cascade');
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
