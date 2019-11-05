<?php

namespace App\Models\Home;

use App\Models\CandidateRatings\CandidateRating;
use App\Models\Departments\Department;
use App\Models\ExitInterviews\ExitInterview;
use App\Models\InterviewPanelists\InterviewPanelist;
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

    public static function inProgressInterviewsCount()
    {
        $inprogresss_interviews = Interview::getInterviews()->where('interview_status', 4)->count();
        return $inprogresss_interviews;
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

    public static function exitInterviewsCount()
    {
        $exit_interviews = ExitInterview::getExitInterviews()->count();

        return $exit_interviews;
    }

    public static function panelistCount()
    {
        $panelists = InterviewPanelist::getPanelists()->count();

        return $panelists;
    }

    public static function departmentsCount()
    {
        $departments = Department::getDepartments()->count();

        return $departments;
    }

    public static function interviewedCandidatesCount()
    {
        $interviewed_candidates = CandidateRating::getAverageRatings()->count();

        return $interviewed_candidates;
    }
}