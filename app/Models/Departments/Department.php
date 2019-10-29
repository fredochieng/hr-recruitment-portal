<?php

namespace App\Models\Departments;

use Illuminate\Database\Eloquent\Model;
use DB;

class Department extends Model
{
    protected $table = 'departments';

    public static function getDepartments()
    {
        $departments = DB::table('departments')->orderBy('id', 'asc')->get();
        return $departments;
    }
}
