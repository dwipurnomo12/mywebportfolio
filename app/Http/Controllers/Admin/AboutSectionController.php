<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('admin.section-about.index', [
            'about'   => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $about = About::find($id);
        $validator = Validator::make($request->all(), [
            'h1'        => 'required',
            'h4'        => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'mimes:svg',
            'cv'        => 'mimes:pdf',
        ], [
            'h1.required'           => 'Wajib Diisi !',
            'h4.required'           => 'Wajib Diisi !',
            'deskripsi.required'    => 'Wajib Diisi !',
            'gambar.mimes'           => 'Gunakan gambar format SVG !',
            'cv.mimes'              => 'Gunakan file berformat PDF !'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if($request->hasFile('gambar'))
        {
            if($about->gambar){
                Storage::disk('public')->delete($about->gambar);
            }

            $path     = 'gambar/';
            $file     = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $gambar   = $file->storeAs($path, $fileName, 'public');
        } else {
            $validator = Validator::make($request->all(), [
            'h1'        => 'required',
            'h4'        => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'nullable|mimes:svg',
        ], [
            'h1.required'           => 'Wajib Diisi !',
            'h4.required'           => 'Wajib Diisi !',
            'deskripsi.required'    => 'Wajib Diisi !',
            'gambar.mimes'          => 'Gunakan gambar format SVG !',
        ]);
            $gambar   = $about->gambar;
        }

        if($request->hasFile('cv'))
        {
            if($about->cv){
                Storage::disk('public')->delete($about->cv);
            }

            $path     = 'cv/';
            $file     = $request->file('cv');
            $fileName = $file->getClientOriginalName();
            $cv   = $file->storeAs($path, $fileName, 'public');
        } else {
            $validator = Validator::make($request->all(), [
            'h1'        => 'required',
            'h4'        => 'required',
            'deskripsi' => 'required',
            'cv'        => 'nullable|mimes:pdf',
        ], [
            'h1.required'           => 'Wajib Diisi !',
            'h4.required'           => 'Wajib Diisi !',
            'deskripsi.required'    => 'Wajib Diisi !',
            'cv.mimes'              => 'Gunakan cv format PDF !',
        ]);
            $cv   = $about->cv;
        }

        $request->merge([
            'gambar'    => $gambar,
            'cv'        => $cv
        ]);

        $about->update([
            'h1'        => $request->h1,
            'h4'        => $request->h4,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $request->hasFile('gambar') ? $path . $fileName : $about->gambar,
            'cv'        => $request->hasFile('cv') ? $path . $fileName : $about->cv,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Terupdate',
            'data'      => $about,
            'image_url' => asset('storage/' . $about->gambar)
        ]);
    }

}
