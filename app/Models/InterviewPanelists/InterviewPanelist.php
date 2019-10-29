<?php

namespace App\Models\InterviewPanelists;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InterviewPanelist extends Model
{
    protected $table = 'interview_panelists';

    public static function getPanelists()
    {
        $panelists = DB::table('interview_panelists')
            ->select(
                DB::raw('interview_panelists.int_id'),
                DB::raw('interview_panelists.panelists')
            )
            ->orderBy('id', 'asc')
            ->get();

        return $panelists;
    }
}