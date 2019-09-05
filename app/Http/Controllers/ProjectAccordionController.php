<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectAccordionController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        $project=$user->accessibleProjects()->pluck('body', 'title');

        return view('projects.accordion', compact('project'));
    }
}
