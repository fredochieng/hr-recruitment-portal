<?php

namespace App\Http\Controllers;

use App\Models\Countries\Country;
use App\Models\Departments\Department;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = new  User();
        $user->name = strtoupper($request->input('name'));
        $user->email = $request->input('email');
        $password = strtolower(str_random(8));
        $user->password = Hash::make($password);
        $user->save();

        $just_saved_user_id = $user->id;
        $just_saved_user_id = (array) $just_saved_user_id;

        $id = json_encode($just_saved_user_id, true);
        print_r($id);
        exit;

        $department = new Department();
        $department->country_id = $request->input('country_id');
        $department->department_name = ucwords($request->input('department_name'));
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
    public function destroy($id)
    {
        //
    }
}