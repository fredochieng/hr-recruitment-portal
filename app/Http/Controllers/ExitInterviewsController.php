<?php

namespace App\Http\Controllers;

use App\Models\ExitInterviews\ExitInterview;
use App\Models\Countries\Country;
use App\Models\Departments\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ExitInterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['exit_interviews'] = ExitInterview::getExitInterviews();
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('exit_interviews.index')->with($data);
    }

    public function deletedExitInterviews()
    {
        $data['exit_interviews'] = ExitInterview::getExitInterviews()->where('deleted_at', '!=', '');

        return view('exit_interviews.deleted')->with($data);
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
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $exit_interview = new ExitInterview();
        $exit_interview->employee_name = strtoupper($request->input('employee_name'));
        $exit_interview->employee_no = strtoupper($request->input('employee_no'));
        $exit_interview->country_id = $request->input('country_id');
        $exit_interview->department_id = $request->input('department_id');
        $exit_interview->current_position = strtoupper($request->input('current_position'));
        $exit_interview->start_date = $request->input('start_date');
        $exit_interview->exit_date = $request->input('exit_date');
        $exit_interview->supervisor = strtoupper($request->input('supervisor'));
        $exit_interview->interviewed_by = $user_id;

        $exit_interview->save();
        //$exit_interview_id = $exit_interview->id();

        $now = Carbon::now('Africa/Nairobi');

        // Log::info("NEW EXIT INTERVIEW OF ID " . $exit_interview_id .  " CREATED BY USER ID: " . $user_id . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Exit interview created successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($exit_interview_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $data = ExitInterview::find($exit_interview_id)->delete();

        Log::critical("EXIT INTERVIEW OF ID " . $exit_interview_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Exit interview deleted successfully');
        return back();
    }
}