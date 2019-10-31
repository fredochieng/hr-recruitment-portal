<?php

namespace App\Http\Controllers;

use App\Models\CandidateRatings\CandidateRating;
use App\Models\Interviews\Interview;
use App\Models\Countries\Country;
use App\Models\Departments\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;
use App\Models\Candidates\Candidate;
use App\Models\InterviewPanelists\InterviewPanelist;
use App\Models\InviteMails\InviteMail;
use App\Models\JobPosting\JobPosting;
use App\User;
use Illuminate\Support\Facades\Hash;

class InterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['interviews'] = Interview::getInterviews();
        return view('interviews.index')->with($data);
    }

    public function openInterviews()
    {
        $status = 1;
        $data['interviews'] = Interview::getInterviews()->where('interview_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.open')->with($data);
    }

    public function ongoingInterviews()
    {
        $status = 4;
        $data['interviews'] = Interview::getInterviews()->where('interview_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.ongoing')->with($data);
    }

    public function closedInterviews()
    {
        $status = 2;
        $data['interviews'] = Interview::getInterviews()->where('interview_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.closed')->with($data);
    }

    public function deletedInterviews()
    {
        $status = 3;
        $data['interviews'] = Interview::getInterviews()->where('interview_status', '=', $status);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.deleted')->with($data);
    }

    public function seniorInterviews()
    {
        $opening_type = 1;
        $data['interviews'] = Interview::getInterviews()->where('opening_type', '=', $opening_type);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.senior')->with($data);
    }

    public function staffInterviews()
    {
        $opening_type = 2;
        $data['interviews'] = Interview::getInterviews()->where('opening_type', '=', $opening_type);
        // Array of all countries, departments, job types passed through Country, Department & JobType Models from the database
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();

        return view('interviews.staff')->with($data);
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
        $now = Carbon::now('Africa/Nairobi');
        $job_opening_id = $request->input('job_opening_id');
        $interview_name = strtoupper($request->input('interview_name'));
        $funct_head_id = $request->input('functional_head_id');
        $interview_date = $request->input('interview_date');
        $interview_start_time = $request->input('interview_start_time');

        $interview = new Interview();
        $interview->job_opening_id = $job_opening_id;
        $interview->interview_name = $interview_name;
        $interview->funct_head_id = $funct_head_id;
        $interview->interview_date = $interview_date;
        $interview->interview_time = $interview_start_time;
        $interview->created_by = Auth::id();

        $interview->save();

        Log::info("INTERVIEW FOR JOB OPENING ID " . $job_opening_id .  " CREATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Job interview created successfully');
        return back();
    }

    public function manageInterview($interview_id)
    {
        $data['interviews'] = Interview::getInterviews()->where('interview_id', '=', $interview_id)
            ->first();

        $data['functional_head'] = Interview::getInterviewFunctionHead()->where('interview_id', '=', $interview_id)
            ->first();

        $data['candidates'] = Candidate::getcandidates()->where('int_id', '=', $interview_id);

        $data['ratings'] = CandidateRating::getInterviewRatings($interview_id);
        // $data['ratings'] = CandidateRating::getRatings()->where('interview_id', '=', $interview_id);

        if (count($data['ratings']) > 0) {
            $data['ratings_available'] = 'Y';
        } else {
            $data['ratings_available'] = 'N';
        }

        $data['average_ratings'] = CandidateRating::getAverageRatings()->where('interview_id', '=', $interview_id);

        //dd($data['average_ratings']);

        $data['selected_candidates'] = Interview::getSelectedCandidates()->where('int_id', $interview_id);
        //dd($data['ratings']);

        return view('interviews.manage')->with($data);
    }

    public function updateInterview(Request $request, $interview_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $update_interview = Interview::where("id", $interview_id)->update([
            'interview_date' => strtoupper($request->input('interview_date')),
            'interview_time' => $request->input('interview_start_time')
        ]);

        Log::info("INTERVIEW OF ID " . $interview_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Interview opening updated successfully');
        return back();
    }

    public function addPanelist(Request $request, $interview_id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $name = ucwords($request->input('panelist_name'));
        $email = $request->input('panelist_email');
        $password = strtolower(str_random(8));

        $interview = Interview::getInterviews()->where('interview_id', $interview_id)->first();

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);

        $existing = User::where('email', $email)->first();
        if (empty($existing)) {
            $user->save();
            $just_saved_user_id = $user->id;

            $user_role = array(
                'model_id' => $just_saved_user_id,
                'role_id' => 2
            );
            $save_user_role = DB::table('model_has_roles')->insertGetId($user_role);

            // Will be replaced with InterviewPanelist Model
            $interview_panelists = array(
                'int_id' => $interview_id,
                'panelists' => $just_saved_user_id
            );
            $save_interview_panelist = DB::table('interview_panelists')->insertGetId($interview_panelists);

            $invite_mail = new InviteMail();
            $invite_mail->panelist_name = $name;
            $invite_mail->panelist_email = $email;
            $invite_mail->message = "You have been invited to be a panelist for interview " . $interview->interview_name . " for job opening " . $interview->opening_name .  " You can login to Wananchi HR Recruitment Portal using your email address " . $email . " and your password is " . $password;

            $invite_mail->save();

            Log::info("PANELIST: NAME: " . $name . " EMAIL: " . $email . " FOR INTERVIEW OF ID " . $interview_id .  " ADDED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
            Toastr::success('Interview panelist successfully');
            return back();
        } else {
            $panelist_id = $existing->id;
            $panelist_email = $existing->email;
            $panelist_name = $existing->name;
            // Will be replaced with InterviewPanelist Model
            $interview_panelists = array(
                'int_id' => $interview_id,
                'panelists' => $panelist_id
            );
            $save_interview_panelist = DB::table('interview_panelists')->insertGetId($interview_panelists);

            $invite_mail = new InviteMail();
            $invite_mail->panelist_name = $panelist_name;
            $invite_mail->panelist_email = $panelist_email;
            $invite_mail->message =  "You have been invited to be a panelist for interview " . $interview->interview_name . " for job opening " . $interview->opening_name .  " You can login to Wananchi HR Recruitment Portal using your email address " . $email . " and your password";

            $invite_mail->save();
            Toastr::warning('Panelist already exists and an invite has been sent');
            return back();
        }
    }

    public function addCandidates(Request $request)
    {
        $interview_id = $request->input('interview_id');
        $names = $request->input('name');
        $emails = $request->input('email');
        $phones = $request->input('phone');
        $cvs = $request->input('cv');
        $interview_times = $request->input('interview_time');

        $data = array();
        if ($request->hasfile('cv')) {
            foreach ($request->file('cv') as $file) {
                $str = rand();
                $result = md5($str);
                $name = $result . $file->getClientOriginalName();
                $file->move('uploads/cvs/', str_replace(' ', '_', $name));
                $cv_files[] = 'uploads/cvs/' . str_replace(' ', '_', $name);
            }
        }

        if (count($names) > count($emails))
            $count = count($emails);
        else $count = count($names);

        for ($i = 0; $i < $count; $i++) {
            $data = array(
                'int_id' => $interview_id,
                'name' => strtoupper($names[$i]),
                'email' => strtolower($emails[$i]),
                'phone' => $phones[$i],
                'cv' => $cv_files[$i],
                'interview_time' => strtoupper($interview_times[$i])
            );

            $insertData[] = $data;
        }

        Candidate::insert($insertData);

        Toastr::success('Candidates added successfully');
        return back();
    }

    public function startSession(Request $request)
    {
        $interview_id = $request->input('interview_id');

        $now = Carbon::now('Africa/Nairobi');
        $start_session = Interview::where("id", $interview_id)->update([
            'interview_status' => 4,
            'started_at' => $now
        ]);

        // Update job status as well as Ongoing
        $job_opening = Interview::getInterviews()->where('interview_id', $interview_id)->first();

        $update_job_status = JobPosting::where('id', $job_opening->job_opening_id)->update([
            'opening_status' => 4
        ]);

        Log::info("SESSION FOR INTERVIEW " . $interview_id .  " STARTED BY PANELIST ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Interview session started successfully');
        return back();
    }

    public function closeSession(Request $request)
    {
        $interview_id = $request->input('interview_id');

        $now = Carbon::now('Africa/Nairobi');
        $end_session = Interview::where("id", $interview_id)->update([
            'interview_status' => 2,
            'ended_at' => $now
        ]);

        // Update job status as well as Closed
        $job_opening = Interview::getInterviews()->where('interview_id', $interview_id)->first();

        $update_job_status = JobPosting::where('id', $job_opening->job_opening_id)->update([
            'opening_status' => 2
        ]);

        Log::info("SESSION FOR INTERVIEW " . $interview_id .  " ENDED BY HR ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Interview session started successfully');
        return back();
    }

    public function startCandidateSession(Request $request)
    {
        $candidate_id = $request->input('candidate_id');

        $now = Carbon::now('Africa/Nairobi');
        $start_session = Candidate::where("id", $candidate_id)->update([
            'interviewed' => 'ONGOING',
            'started_at' => $now

        ]);

        Log::info("INTERVIEW SESSION FOR CANDIDATE " . $candidate_id .  " STARTED BY PANELIST ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Interview session for candidate started successfully');
        return back();
    }

    public function closeCandidateSession(Request $request)
    {
        $candidate_id = $request->input('candidate_id');
        $interview_id = $request->input('interview_id');
        $now = Carbon::now('Africa/Nairobi');

        // Check whether all the interview panelist have submitted their ratings
        $expected_panelist_count = InterviewPanelist::getPanelists()->where('int_id', $interview_id)->count();
        $submitted_ratings_count = CandidateRating::getRatings($candidate_id)->count();
        if ($expected_panelist_count == $submitted_ratings_count) {
            $end_session = Candidate::where("id", $candidate_id)->update([
                'interviewed' => 'CLOSED',
                'ended_at' => $now
            ]);

            Log::info("INTERVIEW SESSION FOR CANDIDATE " . $candidate_id .  " CLOSED BY HR OF ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

            Toastr::success('Interview session for candidate closed successfully');
            return back();
        } else {
            $remaining_panelists = $expected_panelist_count - $submitted_ratings_count;
            if ($remaining_panelists == 1) {
                $message = $remaining_panelists . ' panelist has not yet submitted his/her ratings';
            } elseif ($remaining_panelists < 0) {
                $end_session = Candidate::where("id", $candidate_id)->update([
                    'interviewed' => 'CLOSED',
                    'ended_at' => $now
                ]);

                Log::info("INTERVIEW SESSION FOR CANDIDATE " . $candidate_id .  " CLOSED BY HR OF ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

                Toastr::success('Interview session for candidate closed successfully');
                return back();
            } else {
                $message = $remaining_panelists . ' panelists have not yet submitted their ratings';
            }
            Toastr::error($message);
            return back();
        }

        // $panelists = json_decode(json_encode($panelists, true));
        // $panelist_ids = array_column($panelists, 'panelists');

        // $candidate_ratings = DB::table('candidate_ratings')->select(
        //     DB::raw('candidate_ratings.candidate_id'),
        //     DB::raw('candidate_ratings.panelist_id')
        // )
        //     ->where('candidate_id', $candidate_id)
        //     ->get();

        // $candidate_ratings = json_decode(json_encode($candidate_ratings, true));
        // $submitted_ratings_ids = array_column($candidate_ratings, 'panelist_id');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Interview $interview)
    {
        $interview_id = $request->input('interview_id');
        $now = Carbon::now('Africa/Nairobi');
        $delete_interview = Interview::where("id", $interview_id)->update([
            'interview_status' => 3,
            'deleted_by' => Auth::id()
        ]);
        $data = Interview::find($interview_id)->delete();

        Log::critical("JOB INTERVIEW OF ID " . $interview_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Job interview deleted successfully');
        return back();
    }
}