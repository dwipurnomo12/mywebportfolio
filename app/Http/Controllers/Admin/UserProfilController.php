<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = User::first();
        return view('admin.profile.index',[
            'profile'  => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        $profile = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'profile_photo_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ], [
            'name.required'             => 'Form Nama Wajib Diisi !',
            'email.required'            => 'Form Email Wajib Diisi !',
            'profile_photo_path.image'  => 'Foto profil harus berupa gambar',
            'profile_photo_path.mimes'  => 'Format gambar yang diizinkan: jpeg, png, jpg, gif',
            'profile_photo_path.max'    => 'Ukuran gambar maksimum adalah 2MB',
        ]);
    
        if ($request->hasFile('profile_photo_path')) {
            if ($profile->profile_photo_path) {
                Storage::disk('public')->delete($profile->profile_photo_path);
            }
    
            $path = 'profile/';
            $file = $request->file('profile_photo_path');
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $profile_photo_path = $file->storeAs($path, $fileName, 'public');
        } else {
            $profile_photo_path = $profile->profile_photo_path;
        }
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $profile_photo_path,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Terupdate',
            'data' => $profile
        ]);
    }
    
}
