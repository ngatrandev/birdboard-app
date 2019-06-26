<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
   
    public function created(Task $task)
    {
        //
        $task->recordActivity('created_task');
    }

   public function updating(Task $task)
   {
       $task->old = $task->getOriginal();
   }
    public function updated(Task $task)
    {
        //
        $task->recordActivity('updated_task');
    }
}
