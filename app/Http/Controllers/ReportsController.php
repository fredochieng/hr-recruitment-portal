<?php

namespace App\Http\Controllers;

use App\Models\CandidateRatings\CandidateRating;
use App\Models\Candidates\Candidate;
use App\Models\Reports\Report;
use Illuminate\Http\Request;
use App\Models\Countries\Country;
use App\Models\Departments\Department;
use App\Models\ExitInterviews\ExitInterview;
use App\Models\Interviews\Interview;
use App\Models\JobPosting\JobPosting;
use App\Models\JobTypes\JobType;
use DB;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function jobs()
    {
        $data['job_status'] = DB::table('status')->orderBy('id', 'asc')->get();
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('reports.jobs.index')->with($data);
    }
    public function interviews()
    {
        $data['interview_status'] = DB::table('status')->orderBy('id', 'asc')->get();
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('reports.interviews.index')->with($data);
    }

    public function addedCandidates()
    {
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('reports.candidates.added.index')->with($data);
    }

    public function ratedCandidates()
    {
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('reports.candidates.rated.index')->with($data);
    }

    public function selectedCandidates()
    {
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('reports.candidates.selected.index')->with($data);
    }

    public function exit_interviews()
    {
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('reports.exit_interviews.index')->with($data);
    }

    public function jobsReport(Request $request)
    {
        $status_id = $request->input('status_id');
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['status_id'] = $status_id;
        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['status_name'] = DB::table('status')->where('id', '=', $status_id)->pluck('status_name')->first();
        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['jobs'] = JobPosting::getJobPostings()
            ->where('opening_status', $status_id)
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->whereBetween('job_date', array($data['start_date'], $data['end_date']));

        $data['status_id'] = $status_id;
        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;

        // dd($data['jobs']);

        return view('reports.jobs.view')->with($data);
    }

    public function exportJobsReport(Request $request)
    {
        $status_id = $request->input('status_id');
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['status_id'] = $status_id;
        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['status_name'] = DB::table('status')->where('id', '=', $status_id)->pluck('status_name')->first();
        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['jobs'] = JobPosting::getJobPostings()
            ->where('opening_status', $status_id)
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->whereBetween('job_date', array($data['start_date'], $data['end_date']));

        $data_array[] = array('Opening Ticket', 'Opening Name', 'Opening Type', 'Country', 'Department', 'Created By', 'Status', 'Created At');
        $text_title_disp = "Job_Openings_Report" . $data['start_date'] . " to " . $data['end_date'];

        foreach ($data['jobs'] as $value) {
            if ($value->opening_status == 1) {
                $status = 'Open';
            } elseif ($value->opening_status == 2) {
                $status = 'Closed';
            } elseif ($value->opening_status == 4) {
                $status = 'Ongoing';
            } elseif ($value->opening_status == 3) {
                $status = 'Deleted';
            }

            $data_array[] = array(
                $value->opening_ticket,
                $value->opening_name,
                $value->type_name,
                $value->country_name,
                $value->department_name,
                $value->name,
                $status,
                $value->posting_created_at
            );
        }
        // dd($data_array);
        $GLOBALS['data_array'] = $data_array;
        \Excel::create(str_replace(' ', '_', $text_title_disp), function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->fromArray($GLOBALS['data_array']);
            });
        })->export('xlsx');
    }

    public function interviewsReport(Request $request)
    {
        $status_id = $request->input('status_id');
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['status_id'] = $status_id;
        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['status_name'] = DB::table('status')->where('id', '=', $status_id)->pluck('status_name')->first();
        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['interviews'] = Interview::getInterviews()
            ->where('opening_status', $status_id)
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->whereBetween('interview_created_date', array($data['start_date'], $data['end_date']));

        // echo "<pre>";
        // print_r($data['interviews']);
        // exit;

        $data['status_id'] = $status_id;
        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;


        return view('reports.interviews.view')->with($data);
    }

    public function exitInterviewsReport(Request $request)
    {
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['exit_interviews'] = ExitInterview::getExitInterviews()
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->whereBetween('exit_interview_created_date', array($data['start_date'], $data['end_date']));

        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;


        return view('reports.exit_interviews.view')->with($data);
    }

    public function addedCandidatesReport(Request $request)
    {
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');
        $interview_status = $request->input('interview_status');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['added_candidates'] = Candidate::getCandidateDetails()
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->where('interviewed', $interview_status)
            ->whereBetween('interview_date', array($data['start_date'], $data['end_date']));

        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;
        $data['interview_status'] = $interview_status;


        return view('reports.candidates.added.view')->with($data);
    }

    public function ratedCandidatesReport(Request $request)
    {
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');
        $interview_status = $request->input('interview_status');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['rated_candidates'] = CandidateRating::getAverageRatings()
            ->where('country_id', $country_id)
            ->where('department_id', $department_id)
            ->whereBetween('candidate_interview_date', array($data['start_date'], $data['end_date']));

        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;
        $data['interview_status'] = $interview_status;


        return view('reports.candidates.rated.view')->with($data);
    }

    public function selectedCandidatesReport(Request $request)
    {
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');
        $interview_status = $request->input('interview_status');

        $date_range = $request->input('date_range');
        $date_range = (array) $date_range;
        $date_range = str_replace(' - ', ',', $date_range);

        $data['country_id'] = $country_id;

        foreach ($date_range as $key => $value) {
            $date_range = $value;
        }

        $date_range = explode(',', $date_range);
        $data['start_date'] = date('Y-m-d', strtotime($date_range[0]));
        $data['end_date'] = date('Y-m-d', strtotime($date_range[1]));

        $data['country_name'] = Country::getCountries()->where('id', '=', $country_id)->pluck('country_name')->first();
        $data['department_name'] = Department::getDepartments()->where('department_id', '=', $department_id)->pluck('department_name')->first();

        $data['selected_candidates'] = Interview::getSelectedCandidates();
        // echo "<pre>";
        // print_r($data['selected_candidates']);
        // exit;
        // $data['rated_candidates'] = CandidateRating::getAverageRatings()
        //     ->where('country_id', $country_id)
        //     ->where('department_id', $department_id)
        //     ->whereBetween('candidate_interview_date', array($data['start_date'], $data['end_date']));

        $data['country_id'] = $country_id;
        $data['department_id'] = $department_id;
        $data['interview_status'] = $interview_status;


        return view('reports.candidates.selected.view')->with($data);
    }
}