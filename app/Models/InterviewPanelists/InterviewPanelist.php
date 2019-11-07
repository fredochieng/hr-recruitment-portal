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

    public static function getPanelistsData()
    {
        $panelists_data = DB::table('interview_panelists')
            ->select(
                DB::raw('interview_panelists.int_id'),
                DB::raw('users.id as panelist_id'),
                DB::raw('users.name'),
                DB::raw('users.email'),
                DB::raw('users.created_at as panelist_created_date'),
                // DB::raw('COUNT(candidate_ratings.id) AS all_ratings'),

                DB::raw('interviews.interview_status'),
                DB::raw('COUNT(interviews.id) AS all_interviews'),
                DB::raw('interview_panelists.panelists'),
                DB::raw('candidate_ratings.panelist_id as rating_panelist_id'),
                DB::raw('interviews.id as interview_id')
            )
            ->leftJoin('users', 'interview_panelists.panelists', '=', 'users.id')
            ->join('candidate_ratings', 'candidate_ratings.panelist_id', '=', 'interview_panelists.panelists', 'left outer')
            ->join('interviews', 'interviews.id', '=',  'interview_panelists.int_id', 'left outer')
            // ->groupBy('candidate_ratings.panelist_id')
            ->groupBy('interview_panelists.panelists')
            ->get();

        return $panelists_data;
    }
}