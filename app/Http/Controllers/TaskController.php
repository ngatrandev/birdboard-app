<?php

namespace App\Http\Controllers;

use App\Task;

use App\Project;

class TaskController extends Controller
{
   
    public function storeTask(Project $project)
    {
        $this->authorize('manage', $project);
        
        $data = request()->validate([
            'body'=>'required'
        ], ['The task field is required.']);

        $project->task()->create($data);

        return redirect()->route('projects.show', $project->id);
    }

    public function updateTask(Project $project, Task $task )
    {
        //do trên route có cả id của project và task nên viết cả 2 như trên
        $this->authorize('update', $project);
        request()->validate([
            'body'=>'required'
        ], ['There is nothing to update the task.']);
        $task->update([
            'body'=>request('body'),
            'completed'=> request()->has('completed')? 1 : 0
        ]);

        return redirect()->route('projects.show', $project->id);
    }

   
}
