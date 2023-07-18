<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LpProjectsController extends Controller
{
    public function projects()
    {
        $project = Project::latest();
        return view('projects', [
            'projects'      => $project->paginate(9),
            'kategoris'     => Kategori::all()
        ]);
    }

    public function detailProject($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view('detail-project', [
            'project'       => $project,
            'kategoris'     => Kategori::all()
        ]);
    }
}
