<?php

namespace App\Http\Controllers;

use App\Models\Reports\Report;
use Illuminate\Http\Request;
use App\Models\Countries\Country;
use App\Models\Departments\Department;
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
        return view('reports.jobs.jobs')->with($data);
    }
    public function interviews()
    {
        return view('reports.interviews.interviews');
    }
    public function exit_interviews()
    {
        return view('reports.exit_interviews.exit_interviews');
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
}