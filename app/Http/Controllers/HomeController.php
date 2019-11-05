<?php

namespace App\Http\Controllers;

use App\Models\Home\HomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Kamaln7\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['open_interviews_count'] = HomeModel::openInterviewsCount();
        $data['inprogress_interviews_count'] = HomeModel::inProgressInterviewsCount();
        $data['closed_interviews_count'] = HomeModel::closedInterviewsCount();
        $data['senior_interviews_count'] = HomeModel::seniorRolesInterviewsCount();
        $data['junior_interviews_count'] = HomeModel::juniorRolesInterviewsCount();
        $data['exit_interviews_count'] = HomeModel::exitInterviewsCount();
        $data['panelists_count'] = HomeModel::panelistCount();
        $data['departments_count'] = HomeModel::departmentsCount();
        $data['interviewed_candidates_count'] = HomeModel::interviewedCandidatesCount();
        Toastr::success('Welcome, ' . Auth::user()->name);
        return view('home')->with($data);
    }
}