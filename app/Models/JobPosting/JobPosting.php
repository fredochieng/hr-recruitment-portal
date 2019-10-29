<?php

namespace App\Models\JobPosting;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'job_openings';


    // Get all job postings from the database

    public static function getJobPostings()
    {
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
            ->orderBy('job_openings.id', 'desc')->get();
        return $job_postings;
    }
}