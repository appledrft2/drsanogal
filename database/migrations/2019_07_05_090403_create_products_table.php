<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id')->unsigned()->index();
            $table->string('name');
            $table->string('category');
            $table->string('unit');
            $table->double('original');
            $table->double('price');
            $table->Integer('quantity');
            $table->Integer('lowstock');
            $table->timestamps();

            $table->foreign('supplier_id')
            ->references('id')->on('suppliers')
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
        Schema::dropIfExists('products');
    }
}
