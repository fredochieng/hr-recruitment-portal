<?php

namespace App\Models\Home;

use App\Models\Interviews\Interview;
use DB;

use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    public static function openInterviewsCount()
    {
        $open_interviews = Interview::getInterviews()->where('interview_status', 1)->count();
        return $open_interviews;
    }

    public static function closedInterviewsCount()
    {
        $closed_interviews = Interview::getInterviews()->where('interview_status', 2)->count();
        return $closed_interviews;
    }

    public static function seniorRolesInterviewsCount()
    {
        $senior_roles_interviews = Interview::getInterviews()->where('job_type_id', 1)->count();
        return $senior_roles_interviews;
    }

    public static function juniorRolesInterviewsCount()
    {
        $junior_roles_interviews = Interview::getInterviews()->where('job_type_id', 2)->count();
        return $junior_roles_interviews;
    }
}