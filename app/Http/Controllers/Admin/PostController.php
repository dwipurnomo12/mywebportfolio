<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts'     =>  Post::orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create', [
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
            'slug'          => 'required|unique:projects',
            'body'          => 'required',
            'gambar'        => 'required|mimes:jpg,jpeg,png',
            'kategori_id'   => 'required'
        ], [
            'judul.required'    => 'Judul Wajib Diisi !',
            'slug.required'     => 'Slug Wajib Diisi !',
            'slug.unique'       => 'Slug sudah ada !',
            'body.required'     => 'body Wajib Diisi !',
            'gambar.required'   => 'Gambar Wajib Diisi !',
            'gambar.mimes'      => 'Format Gambar Wajib jpg,jpeg,png !',
            'kategori_id'       => 'Kategori Wajib Diisi !'
        ]);

        if($request->hasFile('gambar'))
        {
            $path       = 'post-gambar/';
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

        $request->merge([
            'user_id'   => auth()->user()->id,
            'excerpt'   => Str::limit(strip_tags($request->body), 100),
        ]);

        $post = Post::create([
            'judul'         =>  $request->judul,
            'slug'          =>  $request->slug,
            'body'          =>  $request->body,
            'gambar'        =>  $path . $fileName,
            'excerpt'       =>  $request->excerpt,
            'user_id'       =>  $request->user_id,
            'kategori_id'   => $request->kategori_id
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Disimpan !',
            'data'      => $post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', [
            'post'  => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post'      => $post,
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
            'slug'          => 'required',
            'body'          => 'required',
            'kategori_id'   => 'required'
        ], [
            'judul.required'        => 'Judul Wajib Diisi!',
            'slug.required'         => 'Slug Wajib Diisi!',
            'body.required'         => 'Isi Post Wajib Diisi!',
            'kategori_id.required'  => 'Kategori Wajib Diisi!'
        ]);

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        if($request->hasFile('gambar')){
            if($post->gambar){
                unlink('.' .Storage::url($post->gambar));
            }
            $path       = 'post-gambar/';
            $file       = $request->file('gambar');
            $extension  = $file->getClientOriginalExtension();
            $fileName   = uniqid().'.'.$extension;
            $gambar     = $file->storeAs($path, $fileName, 'public');
        } else {
            $validator = Validator::make($request->all(), [
                'judul'         => 'required',
                'slug'          => 'required',
                'body'          => 'required',
                'kategori_id'   => 'required'
            ], [
                'judul.required'        => 'Judul Wajib Diisi!',
                'slug.required'         => 'Slug Wajib Diisi!',
                'body.required'         => 'Isi Post Wajib Diisi!',
                'kategori_id.required'  => 'Kategori Wajib Diisi!'
            ]);
            $gambar = $post->gambar;
        }

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $post->update([
            'judul'         => $request->judul,
            'slug'          => $request->slug,
            'body'          => $request->body,
            'gambar'        => $gambar,
            'excerpt'       => Str::limit(strip_tags($request->body), 100),
            'user_id'       => auth()->user()->id,
            'kategori_id'   => $request->kategori_id
        ]);

        $post = Post::find($post->id);;
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Terupdate',
            'data'    => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        unlink('.'.Storage::url($post->gambar));
        $post->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil dihapus'
        ]);  
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
