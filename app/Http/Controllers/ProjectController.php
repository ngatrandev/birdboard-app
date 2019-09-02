<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Activity;
use App\User;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $projects = auth()->user()->accessibleProjects();
        $ownProject = auth()->user()->project()->pluck('title', 'id');
        //khi pluck cặp giá trị (key-value)
        //giá trị 1 là value (title), giá trị 2 là key (id)
        $shareProject = auth()->user()->shareProjects()->pluck('title', 'id');
        $ownProjectCount = $ownProject ->count();//đếm số lượng project
        $shareProjectCount = $shareProject ->count();
        return view('projects.index', compact('projects', 'ownProject', 'shareProject', 'user', 'ownProjectCount', 'shareProjectCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

       $project = auth()->user()->project()->create($data);

        if(request('tasks')) {
            foreach (request('tasks') as $task) {
                if($task['body']) {
                    $project->addTask($task['body']);
                } else {};
                 //để tránh trường hợp body = "" nhưng lại create task 
                 //lúc này bị lỗi bên trong và không execute đoạn code bên dưới
            }
        }
       
        
        //return về view show khi send req từ Vue
        if(request()->wantsJson()) {
            return ['message' => '/projects/'. $project->id];
        }



     return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        // abort_unless(
        //     auth()->user()->id==$project->user_id||
        //     auth()->user()->role=="administrator"||
        //     $project->members->contains(auth()->user()),403,
        //     'You are not premission to load this page');
        //thay abort bằng policy
            $this->authorize('update',$project);

        $activities = Activity::whereProjectId($project->id)->latest()->get();

        $userColl1 = $project->user()->get();//user tạo project
        $userColl2 = $project->members;//user được invite vào project
        $joinedEmails = $userColl1->merge($userColl2)->pluck('email');
        //tạo 1 array email từ các user dùng pluck() rất đơn giản

        $allUsers = User::all();
        $allEmails = $allUsers->pluck('email');
        
        
        
    
        return view('projects.show', compact('project', 'activities', 'joinedEmails', 'allEmails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $this->authorize('update',$project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        //
        $this->authorize('update',$project);

        request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if(!request('notes')) {
            $project->update(request(['title', 'body']));
        }

        if(request()->wantsJson()) {
            return ['message' => '/projects/'. $project->id];
        }

        $project->update(request(['title', 'body', 'notes']));
        //khi update dùng chung 1 method trong controller dù notes ở form khác với (title+body)

        return redirect()->route('projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $this->authorize('manage',$project);

        $project->delete();
        return redirect('/projects');
    }
}
