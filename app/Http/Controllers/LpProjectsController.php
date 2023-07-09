<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LpProjectsController extends Controller
{
    public function projects()
    {
        $project = Project::latest();
        return view('projects', [
            'projects'  => $project->paginate(9)
        ]);
    }

    public function detailProject($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view('detail-project', [
            'project'   => $project
        ]);
    }
}
