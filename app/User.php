<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function accessibleProjects()
    {
        return Project::where('user_id', $this->id)
        ->orWhereHas('members', function ($query) {
            $query->where('user_id', $this->id);
        })
        ->get();
       
        //trả về tất cả project mà user create hoặc được share
    }

    public function shareProjects()
    {
        return Project::WhereHas('members', function ($query) {
            $query->where('user_id', $this->id);
        })
        ->get();
       
        //trả về tất cả project mà user được share
    }
}
