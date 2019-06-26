<?php

namespace App\Observers;

use App\Project;
use App\Activity;

class ProjectObserver
{
    
    public function created(Project $project)
    {
        //tự tạo activity khi project được create
        //phải viết Project::observer trong func boot bên AppServiceProvider
        $project->recordActivity('created');
    }

    public function updating(Project $project)
    {
        $project->old = $project->getOriginal();
    }
   
    public function updated(Project $project)
    {
        //
        $project->recordActivity('updated');
    }
    
}
