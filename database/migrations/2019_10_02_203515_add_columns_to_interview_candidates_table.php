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
            // $table->dropColumn('candidates');
            $table->string('name')->nullable()->after('int_id');
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->longText('cv')->nullable()->after('phone');
            // $table->timestamp('created_at')->after('cv')->nullable();
            // $table->timestamp('updated_at')->after('created_at');
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
            // $table->unsignedBigInteger('candidates')->nullable()->after('id');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('cv');
            // $table->dropColumn('created_at');
            // $table->dropColumn('updated_at');
        });
    }
}
