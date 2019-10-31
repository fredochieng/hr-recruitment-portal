<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exit_interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_name');
            $table->string('employee_no')->nullable();
            $table->unsignedBigInteger('country');
            $table->unsignedBigInteger('department_id');
            $table->string('current_position');
            $table->string('start_date');
            $table->string('exit_date');
            $table->string('immediate_supervisor')->nullable();
            $table->unsignedBigInteger('interviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exit_interviews');
    }
}