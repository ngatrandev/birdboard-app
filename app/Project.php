<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Project extends Model
{
    use RecordsActivity;
    //
    protected $guarded = [];

    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->hasMany('App\Task');
    }

    public function members()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
        //mỗi user có nhiều project và mỗi project có nhiều user nên dùng belongsToMany-
    }

    public function invite(User $user)
    {
        $this->members()->attach($user);
    }

}
