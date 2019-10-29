<?php

namespace App\Models\CandidateRatings;

use DB;

use Illuminate\Database\Eloquent\Model;

class CandidateRating extends Model
{
    protected $table = 'candidate_ratings';

    public static function getRatings()
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
}