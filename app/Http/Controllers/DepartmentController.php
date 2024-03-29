<?php

namespace App\Http\Controllers;

use App\Models\Countries\Country;
use App\Models\Departments\Department;
use App\Models\InviteMails\InviteMail;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kamaln7\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['countries'] = Country::getCountries();
        $data['departments'] = Department::getDepartments();
        return view('departments.index')->with($data);
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
        $department = new Department();
        $department->country_id = $request->input('country_id');
        $department->department_name = ucwords($request->input('department_name'));
        $department->save();

        $just_saved_dept_id = $department->id;

        $user = new  User();
        $user->name = strtoupper($request->input('name'));
        $user->email = $request->input('email');
        $user->dept_id = $just_saved_dept_id;
        $password = strtolower(str_random(8));
        $user->password = Hash::make($password);
        $user->save();

        $just_saved_user_id = $user->id;

        $invite_mail = new InviteMail();
        $invite_mail->panelist_name = $user->name;
        $invite_mail->panelist_email = $user->email;
        $invite_mail->message = "You have been added as a functional head for department " . ucwords($request->input('department_name')) .
            " You can login to Wananchi HR Recruitment Portal using your email address " . $user->email . " and your password is " . $password;

        $invite_mail->save();

        $user_role = array(
            'model_id' => $just_saved_user_id,
            'role_id' => 3
        );
        $save_user_role = DB::table('model_has_roles')->insertGetId($user_role);

        Toastr::success('Department added successfully');
        return back();
    }

    public function manageDepartment($department_id = null)
    {
        $data['departments'] = Department::getDepartments()->where('department_id', $department_id)->first();
        //dd($data['departments']);
        return view('departments.manage')->with($data);
    }

    public function updateFunctionalHead(Request $request)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $now = Carbon::now('Africa/Nairobi');

        $update_funct_head = User::where("id", $user_id)->update([
            'name' => strtoupper($name),
            'email' => $email
        ]);

        Log::info("FUNCTIONAL HEAD OF ID " . $user_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Functional head updated successfully');
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
    { }

    public function updateDepartment(Request $request)
    {
        $departrment_id = $request->input('department_id');
        $now = Carbon::now('Africa/Nairobi');
        $update_interview = Department::where("id", $departrment_id)->update([
            'department_name' => strtoupper($request->input('department_name')),
            'country_id' => $request->input('country_id')
        ]);

        Log::info("DEPARTMENT OF ID " . $departrment_id .  " UPDATED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);
        Toastr::success('Department updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now('Africa/Nairobi');

        $data = Department::find($id)->delete();

        Log::critical("DEPARTMENT OF ID " . $id .  " DELETED BY USER ID: " . Auth::id() . " NAME " . Auth::user()->name . " AT " . $now);

        Toastr::success('Department deleted successfully');
        return back();
    }
}