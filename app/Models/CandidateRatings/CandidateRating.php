<?php

namespace App\Models\CandidateRatings;

use DB;

use Illuminate\Database\Eloquent\Model;

class CandidateRating extends Model
{
    protected $table = 'candidate_ratings';

    public static function getRatings($candidate_id)
    {
        $ratings = DB::table('candidate_ratings')
            ->select(
                DB::raw('candidate_ratings.*'),
                DB::raw('candidate_ratings.id as rating_id'),
                DB::raw('interview_candidates.id as cand_id'),
                DB::raw('interview_candidates.name as candidate_name'),
                DB::raw('interviews.id as interview_id'),
                DB::raw('users.id as panelist_id'),
                DB::raw('users.name as panelist_name'),
                DB::raw('overall_rating.id as overall_rating_id'),
                DB::raw('overall_rating.overall_rating as overall_rating_name'),
                DB::raw('recommendations.id as recommendation_id'),
                DB::raw('recommendations.recommendation as recommendation_name')
            )
            ->leftJoin('users', 'candidate_ratings.panelist_id', '=', 'users.id')
            ->leftJoin('overall_rating', 'candidate_ratings.overall_rating', '=', 'overall_rating.id')
            ->leftJoin('recommendations', 'candidate_ratings.recommendations', '=', 'recommendations.id')
            ->leftJoin('interview_candidates', 'candidate_ratings.candidate_id', '=', 'interview_candidates.id')
            ->leftJoin('interviews', 'interview_candidates.int_id', '=', 'interviews.id')
            ->orderBy('candidate_ratings.id', 'asc')
            ->where('candidate_ratings.candidate_id', '=', $candidate_id)
            ->get();

        $ratings->map(function ($item) {

            $average_marks = DB::table('candidate_ratings')
                ->select(
                    DB::raw('avg(candidate_ratings.total_marks) as average_marks')
                )->where('candidate_id', $item->candidate_id)
                ->get();

            $item->avg_marks = json_encode($average_marks);
            $item->avg_marks = str_replace('[{"average_marks":"', '', $item->avg_marks);
            $item->avg_marks = number_format(str_replace('"}]', '', $item->avg_marks), 2, '.', ',');
            return $item;
        });
        return $ratings;
    }
    public static function getInterviewRatings($interview_id)
    {
        $ratings = DB::table('candidate_ratings')
            ->select(
                DB::raw('candidate_ratings.*'),
                DB::raw('candidate_ratings.id as rating_id'),
                DB::raw('interview_candidates.id as cand_id'),
                DB::raw('interview_candidates.name as candidate_name'),
                DB::raw('interviews.id as interview_id'),
                DB::raw('users.id as panelist_id'),
                DB::raw('users.name as panelist_name'),
                DB::raw('overall_rating.id as overall_rating_id'),
                DB::raw('overall_rating.overall_rating as overall_rating_name'),
                DB::raw('recommendations.id as recommendation_id'),
                DB::raw('recommendations.recommendation as recommendation_name')
            )
            ->leftJoin('users', 'candidate_ratings.panelist_id', '=', 'users.id')
            ->leftJoin('overall_rating', 'candidate_ratings.overall_rating', '=', 'overall_rating.id')
            ->leftJoin('recommendations', 'candidate_ratings.recommendations', '=', 'recommendations.id')
            ->leftJoin('interview_candidates', 'candidate_ratings.candidate_id', '=', 'interview_candidates.id')
            ->leftJoin('interviews', 'interview_candidates.int_id', '=', 'interviews.id')
            ->orderBy('candidate_ratings.id', 'asc')
            ->where('interview_candidates.int_id', '=', $interview_id)
            ->get();

        $ratings->map(function ($item) {

            $average_marks = DB::table('candidate_ratings')
                ->select(
                    DB::raw('avg(candidate_ratings.total_marks) as average_marks')
                )->where('candidate_id', $item->candidate_id)
                ->get();

            $item->avg_marks = json_encode($average_marks);
            $item->avg_marks = str_replace('[{"average_marks":"', '', $item->avg_marks);
            $item->avg_marks = number_format(str_replace('"}]', '', $item->avg_marks), 2, '.', ',');
            return $item;
        });
        return $ratings;
    }

    public static function getAverageRatings()
    {
        $avergae_ratings = DB::table('candidate_ratings')
            ->select(
                DB::raw('candidate_ratings.id as rating_id'),
                DB::raw('avg(candidate_ratings.total_marks) as average_marks'),
                DB::raw('interview_candidates.id as candidate_id'),
                DB::raw('interview_candidates.name as candidate_name'),
                DB::raw('interview_candidates.started_at as session_start_time'),
                DB::raw('interview_candidates.ended_at as session_end_time'),
                DB::raw('interview_candidates.email'),
                DB::raw('interview_candidates.phone'),
                DB::raw('interviews.id as interview_id'),
                DB::raw('candidates_decision.id as candidates_decision_id'),
                DB::raw('candidates_decision.decision_id'),
                DB::raw('candidates_decision.candidate_id as candidates_decision_cand_id'),
                DB::raw('interview_decision.decision'),
                DB::raw('interview_decision.id as interview_decision_id'),
                DB::raw('candidate_ratings.candidate_id as cand_id'),
                DB::raw('candidates_decision.id as candidates_decision_id')
            )
            ->leftJoin('users', 'candidate_ratings.panelist_id', '=', 'users.id')
            ->leftJoin('interview_candidates', 'candidate_ratings.candidate_id', '=', 'interview_candidates.id')
            ->leftJoin('interviews', 'interview_candidates.int_id', '=', 'interviews.id')
            ->join('candidates_decision', 'candidates_decision.candidate_id', '=', 'candidate_ratings.candidate_id', 'left outer')
            ->join('interview_decision', 'interview_decision.id', '=', 'candidates_decision.decision_id', 'left outer')
            ->groupBy('candidate_ratings.candidate_id')
            ->orderBy('average_marks', 'desc')
            ->get();

        return $avergae_ratings;
    }
}