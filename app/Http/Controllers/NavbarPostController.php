<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavbarPostController extends Controller
{
    public function index()
    {
        return view('partials.navbarpost',[
            'kategoris' => Kategori::all()
        ]);
    }
}
