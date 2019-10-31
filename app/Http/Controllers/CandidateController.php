<?php

namespace App\Http\Controllers;

use App\Models\CandidateRatings\CandidateRating;
use Illuminate\Http\Request;
use App\Models\Candidates\Candidate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;
use DB;
use Carbon\Carbon;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function manageCandidate(Request $request, $candidate_id)
    {
        $data['candidates'] = Candidate::getCandidateDetails()->where('candidate_id', '=', $candidate_id)->first();
        //dd($data['candidates']);
        $candidate_decision = Candidate::getDecisions()->where('candidate_id', $candidate_id)
            ->where('decision_by', $data['candidates']->funct_head_id)->first();

        if ($candidate_decision) {
            $data['function_head_decision'] = 'Y';
        } else {
            $data['function_head_decision'] = 'N';
        }

        // dd($data['function_head_decision']);

        $data['candidate_ratings'] = CandidateRating::getRatings($candidate_id);

        //dd($data['candidate_ratings']);
        $data['count'] = (count($data['candidate_ratings']));

        if ($data['candidates']->interviewed == 'PENDING') {
            $data['label_color'] = 'yellow';
        } elseif ($data['candidates']->interviewed == 'ONGOING') {
            $data['label_color'] = 'aqua';
        } elseif ($data['candidates']->interviewed == 'CLOSED') {
            $data['label_color'] = 'green';
        }

        if ($data['candidates']->session_started == 'NO') {
            $data['session_label_color'] = 'yellow';
        } elseif ($data['candidates']->session_started == 'YES') {
            $data['session_label_color'] = 'aqua';
        } elseif ($data['candidates']->session_started == 'CLOSED') {
            $data['session_label_color'] = 'green';
        }

        // Check if the panelist has already rated the candidate 
        if ($data['candidates']->panelist_id == Auth::id() && $data['candidates']->rating_candidate_id == $candidate_id) {
            $data['rated'] = 'Y';
            $data['rating_status'] = 'SUBMITTED';
            $data['rating_status_color'] = 'green';
        } else {
            $data['rated'] = 'N';
            $data['rating_status'] = 'PENDING';
            $data['rating_status_color'] = 'yellow';
        }

        return view('candidates.manage')->with($data);
    }

    public function addRatings(Request $request)
    {
        $candidate_id = $request->input('candidate_id');
        $full_marks = $request->input('full_marks');
        $rating_marks = $request->input('rating_marks');
        $total_marks = $request->input('total_marks');
        $overall_rating_id = $request->input('overall_rating_id');
        $recommendation_id = $request->input('recommendation_id');
        $panelist_id = Auth::id();

        $rating_marks = json_encode($rating_marks, true);

        $ratings = new CandidateRating();
        $ratings->candidate_id = $candidate_id;
        $ratings->panelist_id = $panelist_id;
        $ratings->ratings = $rating_marks;
        $ratings->total_marks = $total_marks;
        $ratings->full_marks = $full_marks;
        $ratings->overall_rating = $overall_rating_id;
        $ratings->recommendations = $recommendation_id;

        $ratings->save();

        $now = Carbon::now('Africa/Nairobi');

        Log::info("RATINGS FOR CANDIDATE OF ID " . $candidate_id .  " SUBMITTED BY PANELIST ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Log::info('Ratings are as follows' . $rating_marks);
        Toastr::success('Ratings submitted successfully');
        return back();
    }

    public function offerLetter(Request $request)
    {
        $candidate_id = $request->input('candidate_id');
        $interview_id = $request->input('interview_id');

        $save_decision = array(
            'int_id' => $interview_id, 'candidate_id' => $candidate_id, 'decision_id' => 1, 'decision_by' => Auth::id()
        );
        $save_decision = DB::table('candidates_decision')->insertGetId($save_decision);

        $now = Carbon::now('Africa/Nairobi');

        Log::info("INTERVIEW DECISION FOR CANDIDATE OF ID " . $candidate_id .  " SUBMITTED BY FUNCTIONAL HEAD/HR DIRECTOR ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Decision submitted successfully');
        return back();
    }

    public function secondInterview(Request $request)
    {
        $candidate_id = $request->input('candidate_id');
        $interview_id = $request->input('interview_id');

        $save_decision = array(
            'int_id' => $interview_id, 'candidate_id' => $candidate_id, 'decision_id' => 2, 'decision_by' => Auth::id()
        );
        $save_decision = DB::table('candidates_decision')->insertGetId($save_decision);

        $now = Carbon::now('Africa/Nairobi');

        Log::info("INTERVIEW DECISION FOR CANDIDATE OF ID " . $candidate_id .  " SUBMITTED BY FUNCTIONAL HEAD/HR DIRECTOR ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Decision submitted successfully');
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
    public function destroy(Request $request, $id)
    {
        $now = Carbon::now('Africa/Nairobi');
        $candidate_id = $request->input('candidate_id');

        $data = Candidate::find($candidate_id)->delete();

        Log::critical("CANDIDATE OF ID " . $candidate_id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Candidate deleted successfully');
        return back();
    }
}