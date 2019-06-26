<?php

namespace App;

trait RecordsActivity
{

    public $old = [];

    public function recordActivity($type)
    {
        $this->activity()->create([
            'user_id'=> auth()->user()->id,
            'project_id'=>class_basename($this)==='Project'? $this->id : $this->project_id,
            'description'=>$type,
            'changes'=> $this->activityChanges()
        ]);
    }

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            //wasChanged = updated là default func khi có data thay đổi.
            return [
                'before' => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }
    }

    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject')->latest();
        //morphMany- ngoài class Project còn các class khác có nhiều activity
        //đối với Project có thể dùng hasMany vì là central class
    }
}
