<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.update-password.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'passwordNew'       => 'required|same:konfirmasiPassword'
        ],[
            'current_password.required' => 'Isikan Password Lama !',
            'passwordNew.required'      => 'Isikan Password baru !',
            'passwordNew.same'          => 'Password Baru dan Konfirmasi Password tidak cocok'
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['current_password' => 'Password lama tidak cocok'], 422);
        }
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('passwordNew') && $errors->has('konfirmasiPassword')) {
                $errors->add('passwordNew', 'Password Baru dan Konfirmasi Password tidak cocok');
            }
            return response()->json($validator->errors(), 422);
        } else {
            $changePassword = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->passwordNew)
            ]);
        
            return response()->json([
                'success'   => true,
                'message'   => 'Password Berhasil Terupdate',
                'data'      => $changePassword
            ]);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
