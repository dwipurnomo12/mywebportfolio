<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'abouts'    => About::all(),
            'skills'    => Skill::all(),
            'projects'  => Project::latest()->take(3)->get()
        ]);
    }
}
