<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $guarded=[];

    protected $casts = [
        'changes' => 'array'
    //để col changes trong activity có dạng array
    ];

    public function subject() 
    {
        return $this->morphTo();
        // morphTo- Activity phụ thuộc vào nhiều class khác nhau như Project, Task...
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
