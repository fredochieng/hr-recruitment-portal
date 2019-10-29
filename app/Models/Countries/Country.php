<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
    protected $table = 'countries';

    public static function getCountries()
    {
        $countries = DB::table('countries')->orderBy('id', 'asc')->get();
        return $countries;
    }
}
