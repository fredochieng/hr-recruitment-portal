<?php

namespace App\Models\Interviews;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Interview extends Model
{
    use SoftDeletes;
    protected $table = 'interviews';
    protected $dates = ['deleted_at'];

    public static function getInterviews()
    {
        $interviews = DB::table('interviews')
            ->select(
                DB::raw('interviews.*'),
                DB::raw('interviews.id as interview_id'),
                DB::raw('interviews.created_at as interview_created_at'),
                DB::raw('interviews.created_by as interview_created_by'),
                DB::raw('status.id'),
                DB::raw('status.status_name'),
                DB::raw('status.label_color'),
                DB::raw('users.id'),
                DB::raw('users.name'),
                DB::raw('job_openings.*'),
                DB::raw('job_types.id'),
                DB::raw('job_types.id as job_type_id'),
                DB::raw('job_types.type_name'),
                DB::raw('countries.*'),
                DB::raw('countries.id as country_id'),
                DB::raw('departments.*'),
                DB::raw('departments.id as department_id')
            )
            ->leftJoin('job_openings', 'interviews.job_opening_id', '=', 'job_openings.id')
            ->leftJoin('status', 'interviews.interview_status', '=', 'status.id')
            ->leftJoin('users', 'interviews.created_by', '=', 'users.id')
            ->leftJoin('job_types', 'job_openings.opening_type', '=', 'job_types.id')
            ->leftJoin('countries', 'job_openings.country_id', '=', 'countries.id')
            ->leftJoin('departments', 'job_openings.department_id', '=', 'departments.id')
            ->orderBy('interviews.id', 'desc')
            ->get();

        return $interviews;
    }

    public static function getInterviewFunctionHead()
    {
        $functional_head = DB::table('interviews')
            ->select(
                DB::raw('interviews.id as interview_id'),
                DB::raw('interviews.funct_head_id'),
                DB::raw('users.id'),
                DB::raw('users.name as functional_head_name')
            )
            ->leftJoin('users', 'interviews.funct_head_id', '=', 'users.id')
            ->get();

        return $functional_head;
    }

    public static function getSelectedCandidates()
    {
        $candidates = DB::table('candidates_decision')->select(
            DB::raw('candidates_decision.*'),
            DB::raw('candidates_decision.created_by as decision_date'),
            DB::raw('interview_candidates.id as interview_candidate_id'),
            DB::raw('interview_candidates.*'),
            DB::raw('interview_decision.id as interview_decision_id'),
            DB::raw('interview_decision.decision')
        )
            ->leftJoin('interview_candidates', 'candidates_decision.candidate_id', '=', 'interview_candidates.id')
            ->leftJoin('interview_decision', 'candidates_decision.decision_id', '=', 'interview_decision.id')
            ->get();

        $candidates->map(function ($item) {
            $decision_name = DB::table('users')
                ->select(
                    DB::raw('users.name as decision_by_name')

                )->where('users.id', $item->decision_by)->get();

            $item->decision_by_name = json_encode($decision_name);
            $item->decision_by_name = str_replace('[{"decision_by_name":"', '', $item->decision_by_name);
            $item->decision_by_name = str_replace('"}]', '', $item->decision_by_name);
            return $item;
        });

        return $candidates;
    }
}