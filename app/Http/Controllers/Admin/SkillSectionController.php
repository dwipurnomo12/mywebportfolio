<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        $skill = $request->input('skill');
        $logo = $request->file('logo');

        $path       = '/skill-logo';
        $fileName   = $logo->getClientOriginalName();
        $logo->storeAs($path, $fileName, 'public');

        $newSkill = new Skill();
        $newSkill->skill = $skill;
        $newSkill->logo  = $path . '/' . $fileName;
        $newSkill->save();

        return response()->json([
            'logo'  => asset(('storage' . $newSkill->logo))
        ]);
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
    public function update(Request $request, string $id)
    {
        //
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
