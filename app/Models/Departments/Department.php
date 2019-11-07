<?php

namespace App\Models\Departments;

use Illuminate\Database\Eloquent\Model;
use DB;

class Department extends Model
{
    protected $table = 'departments';

    public static function getDepartments()
    {
        $departments = DB::table('departments')
            ->select(
                DB::raw('departments.department_name'),
                DB::raw('departments.created_at as department_created_at'),
                DB::raw('departments.country_id'),
                DB::raw('departments.functional_heads'),
                DB::raw('countries.country_name'),
                DB::raw('departments.id as department_id'),
                DB::raw('countries.id as countryId')
            )
            ->join('countries', 'countries.id', '=', 'departments.country_id', 'left outer')
            ->orderBy('departments.id', 'asc')->get();

        $departments->map(function ($item) {

            $data['functional_heads_data'] = DB::table('users')
                ->select(
                    DB::raw('users.id as user_id'),
                    DB::raw('users.name'),
                    DB::raw('users.email'),
                    DB::raw('users.created_at as functional_head_created_at')
                )
                ->where('dept_id', $item->department_id)->get();

            $item->functional_heads_data = $data['functional_heads_data'];
            return $item;
        });
        // echo "<pre>";
        // print_r($departments);
        // exit;
        return $departments;
    }

    public static function getFunctionalHeads()
    { }
}