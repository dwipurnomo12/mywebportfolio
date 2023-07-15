<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.project.index',[
            'projects'  => Project::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'slug'      => 'required|unique:projects',
            'deskripsi' => 'required',
            'gambar'    => 'required|mimes:jpg,jpeg,png'
        ], [
            'judul.required'    => 'Judul Wajib Diisi !',
            'slug.required'     => 'Slug Wajib Diisi !',
            'slug.unique'       => 'Slug sudah ada !',
            'deskripsi.required'=> 'Deskripsi Wajib Diisi !',
            'gambar.required'   => 'Gambar Wajib Diisi !',
            'gambar.mimes'      => 'Format Gambar Wajib jpg,jpeg,png !'
        ]);


        if($request->hasFile('gambar'))
        {
            $path       = 'project-gambar/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid().'.'.$extension;
            $gambar     = $file->storeAs($path, $fileName, 'public');
        } else {
            $gambar = null;
        }

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $project = Project::create([
            'judul'     =>  $request->judul,
            'slug'      =>  $request->slug,
            'deskripsi' =>  $request->deskripsi,
            'gambar'    =>  $path . $fileName,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Disimpan !',
            'data'      => $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.project.show', [
            'project'   => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', [
            'project'   => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'slug'      => 'required',
            'deskripsi' => 'required',
        ], [
            'judul.required'     => 'Judul Wajib Diisi!',
            'slug.required'      => 'Slug Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
        ]);

        if($request->slug != $project->slug){
            $rules['slug'] = 'required|unique:projects';
        }
    
        if ($request->hasFile('gambar')) {
            if ($project->gambar) {
                unlink('.'.Storage::url($project->gambar));
            }
    
            $path     = 'project-gambar/';
            $file     = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid().'.'.$extension;
            $gambar   = $file->storeAs($path, $fileName, 'public');
        } else {
            $validator = Validator::make($request->all(), [
                'judul'     => 'required',
                'slug'      => 'required',
                'deskripsi' => 'required',
            ], [
                'judul.required'     => 'Judul Wajib Diisi!',
                'slug.required'      => 'Slug Wajib Diisi!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            ]);

            $gambar = $project->gambar;
        }

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $project->update([
            'judul'     => $request->judul,
            'slug'      => $request->slug,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar,
        ]);

        $project = Project::find($project->id);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Terupdate',
            'data'    => $project,
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        unlink('.'.Storage::url($project->gambar));
        $project->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil dihapus'
        ]);  
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Project::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
