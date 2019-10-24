<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reschedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('appointment_id')->unsigned()->index();
            $table->date('prev_date');
            $table->date('reschedule_date');
            $table->timestamps();

             $table->foreign('appointment_id')
            ->references('id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reschedules');
    }
}
