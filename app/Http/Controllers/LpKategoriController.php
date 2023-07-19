<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class LpKategoriController extends Controller
{
    public function index(Kategori $kategori)
    {
        return view('kategori', [
            'kategori'  => $kategori->kategori,
            'deskripsi' => $kategori->deskripsi,
            'posts'     => $kategori->posts()->orderByDesc('created_at')->paginate(12),
            'kategoris' => Kategori::all()
        ]);
    }
}
