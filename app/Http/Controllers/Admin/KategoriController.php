<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kategori.index');
    }

    /**
     * Fetch Data Kategori
     */
    public function fetchData()
    {
        $kategoris = Kategori::all();
        return response()->json([
            'success'   => true,
            'data'      => $kategoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori'      => 'required',
            'slug'          => 'required|unique:kategoris',
            'deskripsi'     => 'required',
        ], [
            'kategori.required'     => 'kategori Wajib Diisi !',
            'slug.required'         => 'Slug Wajib Diisi !',
            'slug.unique'           => 'Slug sudah ada !',
            'deskripsi.required'    => 'deskripsi Wajib Diisi !',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $kategori = Kategori::create([
            'kategori'      =>  $request->kategori,
            'slug'          =>  $request->slug,
            'deskripsi'     =>  $request->deskripsi,
            'user_id'       =>  auth()->user()->id
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Disimpan !',
            'data'      => $kategori
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);    
    }

     /**
     * Eloquent Sluggable
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->kategori);
        return response()->json(['slug' => $slug]);
    }
}
