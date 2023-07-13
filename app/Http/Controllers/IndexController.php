<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'abouts'        => About::all(),
            'skills'        => Skill::all(),
            'projects'      => Project::latest()->take(3)->get(),
            'pendidikans'    => Pendidikan::all(),
            'pekerjaans'     => Pekerjaan::all()
        ]);
    }
}
