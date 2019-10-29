<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToInterviewCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_candidates', function (Blueprint $table) {
            $table->string('interviewed')->after('cv')->default('No');
            $table->string('interview_time')->after('interviewed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_candidates', function (Blueprint $table) {
            $table->dropColumn('interviewed');
            $table->dropColumn('interview_time');
        });
    }
}