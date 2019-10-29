<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('panelist_id');
            $table->longText('ratings');
            $table->unsignedBigInteger('total_marks');
            $table->unsignedBigInteger('full_marks');
            $table->unsignedBigInteger('overall_rating');
            $table->unsignedBigInteger('recommendations');
            $table->longText('comments')->nullable();
            $table->unsignedBigInteger('availability');
            $table->unsignedBigInteger('expected_salary')->nullable();
            $table->unsignedBigInteger('current_salary')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_ratings');
    }
}