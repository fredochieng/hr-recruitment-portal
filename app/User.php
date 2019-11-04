<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers()
    {
        $users = DB::table('users')->select(
            DB::raw('users.id as user_id'),
            DB::raw('users.name as user_name'),
            DB::raw('users.email'),
            DB::raw('users.created_at as user_created_at'),
            DB::raw('model_has_roles.role_id'),
            DB::raw('model_has_roles.model_id'),
            DB::raw('roles.id as roles_role_id'),
            DB::raw('roles.name as role_name')
        )
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->orderBy('users.id', 'asc')
            ->get();

        return $users;
    }

    public function isHR()
    {
        return $this->hasRole('HR');
    }
    public function isPanelist()
    {
        return $this->hasRole('Panelist');
    }
    public function isFunctionlHead()
    {
        return $this->hasRole('FunctionlHead');
    }
    public function isHRDirector()
    {
        return $this->hasRole('HRDirector');
    }
}