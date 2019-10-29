<?php

namespace App\Models\Candidates;

use Illuminate\Database\Eloquent\Model;
use DB;

class Candidate extends Model
{
    protected $table = 'interview_candidates';

    public static function getcandidates()
    {
        $candidates = DB::table('interview_candidates')
            ->select(
                DB::raw('interview_candidates.*'),
                DB::raw('interview_candidates.id as candidate_id'),
                DB::raw('interview_candidates.created_at as candidate_created_at'),
                DB::raw('interviews.id')
            )
            ->leftJoin('interviews', 'interview_candidates.int_id', '=', 'interviews.id')
            ->orderBy('interview_candidates.id', 'asc')
            ->get();

        return $candidates;
    }

    public static function getCandidateDetails()
    {
        $candidates = DB::table('interview_candidates')
            ->select(
                DB::raw('interview_candidates.*'),
                DB::raw('interview_candidates.created_at as candidate_created_at'),
                DB::raw('interview_candidates.started_at as session_started_at'),
                DB::raw('interview_candidates.ended_at as session_ended_at'),
                DB::raw('interviews.*'),
                DB::raw('interviews.id as interview_id'),
                DB::raw('candidate_ratings.*'),
                DB::raw('job_openings.*'),
                DB::raw('candidate_ratings.candidate_id as rating_candidate_id'),
                DB::raw('interview_candidates.id as candidate_id')

            )
            ->leftJoin('interviews', 'interview_candidates.int_id', '=', 'interviews.id')
            ->leftJoin('job_openings', 'interviews.job_opening_id', '=', 'job_openings.id')
            // ->leftJoin('candidate_ratings', 'interview_candidates.id', '=', 'candidate_ratings.candidate_id')
            ->join('candidate_ratings', 'candidate_ratings.candidate_id', '=', 'interview_candidates.id', 'left outer')
            ->orderBy('interview_candidates.id', 'asc')
            ->get();

        return $candidates;
    }

    public static function getDecisions()
    {
        $decisions = DB::table('candidates_decision')
            ->select(
                DB::raw('candidates_decision.*')
            )->get();

        return $decisions;
    }
}