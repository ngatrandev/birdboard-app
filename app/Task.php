<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;
    
    //
    protected $guarded = [];

    protected $touches = ['project'];
    //khi task update thì project cũng update ở timestamp

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}

    

