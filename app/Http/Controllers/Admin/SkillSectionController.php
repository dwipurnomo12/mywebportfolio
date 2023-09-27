<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkillSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::all();
        return view('admin.section-skill.index', [
            'skills'    => $skills
        ]);
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
        $validator = Validator::make($request->all(), [
            'skill' => 'required|string|max:255',
            'logo'  => 'required|image|mimes:svg|max:2048',
        ], [
            'skill.required'    => 'Tambahkan Nama Skill',
            'logo.required'     => 'Wajib Tambahkan Logo'
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
    
        $skill = $request->input('skill');
        $logo = $request->file('logo');
    
        $path = '/skill-logo';
        $fileName = $logo->getClientOriginalName();
        $logo->storeAs($path, $fileName, 'public');
    
        $newSkill = new Skill();
        $newSkill->skill = $skill;
        $newSkill->logo = $path . '/' . $fileName;
        $newSkill->save();
    
        return response()->json([
            'logo' => asset(('storage' . $newSkill->logo))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        unlink('.'.Storage::url($skill->logo));
        $skill->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil dihapus'
        ]);  
    }
}
