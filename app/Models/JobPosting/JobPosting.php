<?php

namespace App\Models\JobPosting;

use App\Models\InterviewPanelists\InterviewPanelist;
use App\Models\Interviews\Interview;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class JobPosting extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'job_openings';


    // Get all job postings from the database

    public static function getJobPostings()
    {
        $user = Auth::user();
        $user_id = $user->id;

        ~$user_role = $user->getRoleNames()->first();
        if ($user_role == "HR" || $user_role == "HR Director") {
            $compare_field = "job_openings.id";
            $compare_operator = ">=";
            $compare_value = 1;

            $job_postings = DB::table('job_openings')
                ->select(
                    DB::raw('job_openings.*'),
                    DB::raw('job_openings.id as job_opening_id'),
                    DB::raw('job_openings.created_at as posting_created_at'),
                    DB::raw('job_types.id'),
                    DB::raw('job_types.id as job_type_id'),
                    DB::raw('job_types.type_name'),
                    DB::raw('status.id'),
                    DB::raw('status.status_name'),
                    DB::raw('status.label_color'),
                    DB::raw('countries.*'),
                    DB::raw('countries.id as country_id'),
                    DB::raw('departments.*'),
                    DB::raw('departments.id as department_id'),
                    DB::raw('users.id'),
                    DB::raw('users.name')
                )
                ->leftJoin('job_types', 'job_openings.opening_type', '=', 'job_types.id')
                ->leftJoin('status', 'job_openings.opening_status', '=', 'status.id')
                ->leftJoin('countries', 'job_openings.country_id', '=', 'countries.id')
                ->leftJoin('departments', 'job_openings.department_id', '=', 'departments.id')
                ->leftJoin('users', 'job_openings.created_by', '=', 'users.id')
                ->where($compare_field, $compare_operator, $compare_value)
                ->orderBy('job_openings.id', 'desc')->get();
        } elseif ($user_role == "Panelist") {

            $panelist = InterviewPanelist::getPanelists()->where('panelists', $user_id);

            $panelist = DB::table('interview_panelists')->select(
                DB::raw('interview_panelists.int_id'),
                DB::raw('interview_panelists.panelists')
            )->where('panelists', $user_id)->get();

            $interview_id = array();

            foreach ($panelist as $key => $value) {
                $interview_id[] = $value->int_id;
            }

            $interviews = DB::table('interviews')->select(
                DB::raw('interviews.id'),
                DB::raw('interviews.job_opening_id')
            )
                ->whereIn('id', $interview_id)->get();

            $job_opening_id = array();

            foreach ($interviews as $key => $value) {
                $job_opening_id[] = $value->job_opening_id;
            }

            $compare_field = "job_openings.id";
            $compare_value = $job_opening_id;

            $job_postings = DB::table('job_openings')
                ->select(
                    DB::raw('job_openings.*'),
                    DB::raw('job_openings.id as job_opening_id'),
                    DB::raw('job_openings.created_at as posting_created_at'),
                    DB::raw('job_types.id'),
                    DB::raw('job_types.id as job_type_id'),
                    DB::raw('job_types.type_name'),
                    DB::raw('status.id'),
                    DB::raw('status.status_name'),
                    DB::raw('status.label_color'),
                    DB::raw('countries.*'),
                    DB::raw('countries.id as country_id'),
                    DB::raw('departments.*'),
                    DB::raw('departments.id as department_id'),
                    DB::raw('users.id'),
                    DB::raw('users.name')
                )
                ->leftJoin('job_types', 'job_openings.opening_type', '=', 'job_types.id')
                ->leftJoin('status', 'job_openings.opening_status', '=', 'status.id')
                ->leftJoin('countries', 'job_openings.country_id', '=', 'countries.id')
                ->leftJoin('departments', 'job_openings.department_id', '=', 'departments.id')
                ->leftJoin('users', 'job_openings.created_by', '=', 'users.id')
                ->whereIn($compare_field, $compare_value)
                ->orderBy('job_openings.id', 'desc')->get();
        } elseif ($user_role == "Functional Head") {

            $departments = DB::table('departments')->select(
                DB::raw('departments.id as department_id'),
                DB::raw('departments.functional_heads')
            )
                ->get();

            $group = [];
            $functional_head = array();
            foreach ($departments as $key => $value) {

                $value->functional_heads = str_replace('"', '', $value->functional_heads);
                $value->functional_heads = explode(',', $value->functional_heads);


                // $month = $user_id;
                // if (!isset($value->functional_heads[$value[0]])) {
                //     $value->functional_heads[$value[0]] = array();
                // }
                // if (!isset($value->functional_heads[$value[0]][$month])) {
                //     $value->functional_heads[$value[0]][$month] = 0;
                // }
                // $value->functional_heads[$value[0]][$month] += 1;
            }
            echo "<pre>";
            print_r($departments);
            exit;
        }

        return $job_postings;
    }
}