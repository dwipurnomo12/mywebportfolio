<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentReply;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.komentar.index', [
            'comments'     =>  Comments::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
       
        $validatedData = $request->validate([
            'body'  => 'required',
        ],[
            'body.required'     => 'Ruas Body Wajib Diisi !',
        ]);

        $commentReply = new CommentReply();
        $commentReply->nama         = 'Dwi Purnomo';
        $commentReply->email        = 'purnomodwi174@gmail.com';
        $commentReply->body         = $validatedData['body'];
        $commentReply->comment_id   = $id;
        $commentReply->user_id      = auth()->user()->id;

        $commentReply->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Balasan komentar berhasil disimpan',
            'comment'   => $commentReply, 
        ]);
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Comments::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteReply($id)
    {
        CommentReply::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);  
    }
}
