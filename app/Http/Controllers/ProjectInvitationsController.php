<?php

namespace App\Http\Controllers;


use App\Project;
use App\Http\Requests\ProjectInvitationRequest;
use App\User;
class ProjectInvitationsController extends Controller
{
    

    public function store(Project $project, ProjectInvitationRequest $request)
    {
        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        if(request()->wantsJson()) {
            return ['message' => '/projects/'. $project->id];
        }


        return redirect()->route('projects.show', $project->id)->with('autofocus', true);
    }
}
