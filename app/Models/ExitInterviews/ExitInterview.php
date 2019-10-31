<?php

namespace App\Models\ExitInterviews;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class ExitInterview extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'exit_interviews';

    public static function getExitInterviews()
    {
        $exit_interviews = DB::table('exit_interviews')->select(
            DB::raw('exit_interviews.*'),
            DB::raw('exit_interviews.id as exit_interview_id'),
            DB::raw('exit_interviews.created_at as exit_interview_created_at'),
            DB::raw('users.id'),
            DB::raw('users.name as interviewed_by_name'),
            DB::raw('countries.id'),
            DB::raw('countries.country_name'),
            DB::raw('departments.id'),
            DB::raw('departments.department_name')
        )
            ->leftJoin('users', 'exit_interviews.interviewed_by', '=', 'users.id')
            ->leftJoin('countries', 'exit_interviews.country_id', '=', 'countries.id')
            ->leftJoin('departments', 'exit_interviews.department_id', '=', 'departments.id')
            ->orderBy('exit_interviews.id', 'desc')
            ->get();
        return $exit_interviews;
    }
}