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
            $functional_heads = explode(';',  $item->functional_heads);
            //§dd($functional_heads);

            $functional_heads = array_filter(array_map('trim', $functional_heads));
            $functional_heads = str_replace('["', '', $functional_heads);
            $functional_heads = str_replace('"]', '', $functional_heads);
            $functional_heads = str_replace('","', ',', $functional_heads);

            foreach ($functional_heads as $key => $value) {
                $functional_heads = ($value);
            }

            $functional_heads = explode(',', $functional_heads);

            $data['functional_heads_data'] = DB::table('users')
                ->select(
                    DB::raw('users.id'),
                    DB::raw('users.name'),
                    DB::raw('users.email')
                )
                ->whereIn('id', $functional_heads)->get();

            $item->functional_heads_data = $data['functional_heads_data'];
            return $item;
        });
        return $departments;
    }

    public static function getFunctionalHeads()
    { }
}