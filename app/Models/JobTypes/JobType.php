<?php

namespace App\Models\JobTypes;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobType extends Model
{
    protected $table = 'job_types';

    public static function getJobTypes()
    {
        $job_types = DB::table('job_types')->orderBy('id', 'asc')->get();
        return $job_types;
    }
}
