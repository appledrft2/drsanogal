<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('gender');
            $table->string('occupation')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable()->unique();
            $table->string('work')->nullable()->unique();; 
            $table->string('home')->nullable()->unique();;
            $table->string('smsNotify')->default(0);
            $table->text('address');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
