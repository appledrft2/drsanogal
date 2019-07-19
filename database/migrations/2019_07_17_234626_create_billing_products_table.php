<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('billing_id')->unsigned()->index();
            $table->string('name');
            $table->string('category');
            $table->string('unit');
            $table->double('price');
            $table->integer('quantity');


            $table->timestamps();

             $table->foreign('billing_id')
            ->references('id')->on('billings')
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
        Schema::dropIfExists('billing_products');
    }
}
