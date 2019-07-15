<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->date('next_appointment');
            $table->string('next_appointment2');
            $table->string('time');
            $table->double('temperature');
            $table->double('kilogram');
            $table->string('appointment');
            $table->string('price');
            $table->text('description');
            $table->double('amount');

            $table->boolean('isPaid')->default(false);
            $table->boolean('isNotified')->default(false);
            $table->string('isCompleted')->default('Not Completed');
            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')->on('patients')
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
        Schema::dropIfExists('appointments');
    }
}
