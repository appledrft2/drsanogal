<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned()->index();
            $table->string('name');
            $table->string('breed');
            $table->string('gender');
            $table->string('specie');
            $table->string('markings');
            $table->string('special_considerations');            
            $table->bigInteger('user_id')->unsigned()->index();            
            $table->date('date_of_birth');
            $table->timestamps();
            
            $table->foreign('client_id')
            ->references('id')->on('clients')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('patients');
    }
}
