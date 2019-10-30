<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\JobPosting\JobPosting;
use App\Models\Countries\Country;
use App\Models\Departments\Department;
use App\Models\JobTypes\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Kamaln7\Toastr\Facades\Toastr;

class JobPostingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['job_postings'] = JobPosting::getJobPostings();
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('jobs.index')->with($data);
    }

    public function openJobs()
    {
        $status = 1;
        $data['job_postings'] = JobPosting::getJobPostings()->where('opening_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('jobs.open')->with($data);
    }

    public function ongoingJobs()
    {
        $status = 4;
        $data['job_postings'] = JobPosting::getJobPostings()->where('opening_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('jobs.ongoing')->with($data);
    }

    public function closedJobs()
    {
        $status = 2;
        $data['job_postings'] = JobPosting::getJobPostings()->where('opening_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('jobs.closed')->with($data);
    }

    public function deletedJobs()
    {
        $status = 3;
        $data['job_postings'] = JobPosting::getJobPostings()->where('opening_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        $data['job_types'] = JobType::getJobTypes();
        return view('jobs.deleted')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function departmentsSelector()
    {
        //Function to get the departments based on the selected country
        $country_id = Input::get('country_id');
        $departments = Department::where('country_id', '=', $country_id)->get();
        return response()->json($departments);
    }
    public function store(Request $request)
    {
        $now = Carbon::now('Africa/Nairobi');
        $job_posting = new JobPosting();
        $user_id = Auth::user()->id;

        $opening_name = strtoupper($request->input('opening_name'));
        $country_id = $request->input('country_id');
        $department_id = $request->input('department_id');
        $posting_type_id = $request->input('posting_type_id');
        $no_of_candidates = $request->input('no_of_candidates');

        $last_ticket = JobPosting::orderBy('id', 'desc')->first();

        if (!$last_ticket) {
            $number = 0;
        } else {
            $last_ticket = $last_ticket->opening_ticket;
            $number = substr($last_ticket, -3);
        }
        $next_number = sprintf('%03d', intval($number) + 1);

        $job_posting->opening_ticket = 'WGK-JOB-' . $next_number;
        $job_posting->opening_name = $opening_name;
        $job_posting->opening_type = $posting_type_id;
        $job_posting->country_id = $country_id;
        $job_posting->department_id = $department_id;
        $job_posting->no_of_candidates = $no_of_candidates;
        $job_posting->created_by = $user_id;

        $job_posting->save();
        $job_opening_id = $job_posting->id;

        Log::info("NEW JOB OPENING OF ID " . $job_opening_id .  " CREATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Job opening created successfully');
        return back();
    }

    public function manageJobPostings($job_opening_id = null)
    {
        $data['job_postings'] = JobPosting::getJobPostings()->where('job_opening_id', '=', $job_opening_id)->first();

        $data['job_types'] = JobType::getJobTypes();
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        // Check interview for the job opening
        $job_interview = DB::table('interviews')->where('job_opening_id', '=', $job_opening_id)->orderBy('id', 'desc')->first();
        if (empty($job_interview)) {
            $data['interview_status'] = 'Not Created Yet';
            $data['label_color'] = 'yellow';
        } else {

            $interview_status = $job_interview->interview_status;
            $interview_status = DB::table('status')->where('id', '=', $interview_status)->first();
            $data['interview_status'] = $interview_status->status_name;
            $data['label_color'] = $interview_status->label_color;
        }
        $data['interview_name'] =  $data['job_postings']->opening_ticket . '- INTERVIEW';

        $department_id = $data['job_postings']->department_id;
        $functional_heads =  $data['departments']->where('id', '=', $department_id)->first();

        $func_heads = $functional_heads->functional_heads;

        if (!empty($func_heads)) {

            $functional_heads = explode(';',  $func_heads);

            $functional_heads = array_filter(array_map('trim', $functional_heads));
            $functional_heads = str_replace('["', '', $functional_heads);
            $functional_heads = str_replace('"]', '', $functional_heads);
            $functional_heads = str_replace('","', ',', $functional_heads);

            foreach ($functional_heads as $key => $value) {
                $functional_heads = ($value);
            }

            $functional_heads = explode(',', $functional_heads);

            $data['functional_heads'] = DB::table('users')
                ->select(
                    DB::raw('users.id'),
                    DB::raw('users.name'),
                    DB::raw('users.email')
                )
                ->whereIn('id', $functional_heads)->get();
            $data['func_heads'] = 'Y';
        } else {
            $data['functional_heads'] = DB::table('users')
                ->select(
                    DB::raw('users.id'),
                    DB::raw('users.name'),
                    DB::raw('users.email')
                )
                ->where('id', 0)->get();
            $data['func_heads'] = 'N';
        }

        // dd($data['functional_heads']);

        return view('jobs.manage')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function update()
    { }

    public function updateJobPosting(Request $request, $job_opening_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $update_job = JobPosting::where("id", $job_opening_id)->update([
            'opening_name' => strtoupper($request->input('opening_name')),
            'opening_type' => $request->input('posting_type_id'),
            'country_id' => $request->input('country_id'),
            'department_id' => $request->input('department_id'),
            'no_of_candidates' => $request->input('no_of_candidates'),
        ]);

        Log::info("JOB OPENING OF ID " . $job_opening_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Job opening updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPosting $jobPosting, $job_opening_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $delete_job = JobPosting::where("id", $job_opening_id)->update([
            'opening_status' => 3,
            'deleted_by' => Auth::id()
        ]);
        $data = JobPosting::find($job_opening_id)->delete();

        Log::critical("JOB OPENING OF ID " . $job_opening_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Job opening deleted successfully');
        return back();
    }
}