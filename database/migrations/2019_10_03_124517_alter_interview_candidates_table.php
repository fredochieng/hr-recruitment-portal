<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInterviewCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_candidates', function (Blueprint $table) {
            $table->string('interviewed')->default('PENDING')->change();
            $table->string('session_started')->default('YES')->after('interview_time');
            $table->timestamp('started_at')->useCurrent()->after('session_started');
            $table->timestamp('ended_at')->useCurrent()->after('started_at');
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
            $table->dropColumn('session_started');
            $table->dropColumn('started_at');
            $table->dropColumn('ended_at');
        });
    }
}