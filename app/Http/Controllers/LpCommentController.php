<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Egulias\EmailValidator\Parser\Comment;

class LpCommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'  => 'required',
            'email' => 'required|email',
            'body'  => 'required',
        ],[
            'nama.required'     => 'Ruas Nama Wajib Diisi !',
            'email.required'    => 'Ruas Email Wajib Diisi !',
            'body.required'     => 'Ruas Body Wajib Diisi !',
        ]);

        $post = Post::where('slug', $request->slug)->firstOrFail();
        $validatedData['post_id'] = $post->id;

        Comments::create($validatedData);
        return redirect()->back()->with('success', 'Komentar berhasil dikirim');
    }

    public function storeReply(Request $request)
    {
        $validatedData = $request->validate([
            'replyNama'  => 'required',
            'replyEmail' => 'required|email',
            'replyBody'  => 'required',
        ],[
            'replyNama.required'     => 'Ruas Nama Wajib Diisi !',
            'replyEmail.required'    => 'Ruas Email Wajib Diisi !',
            'replyBody.required'     => 'Ruas Body Wajib Diisi !',
        ]);

        $post = Post::where('slug', $request->slug)->firstOrFail();
        $validatedData['post_id'] = $post->id;
        $validatedData['comment_id'] = $request->comment_id;

        $commentReply = new CommentReply();
        $commentReply->nama         = $validatedData['replyNama'];
        $commentReply->email        = $validatedData['replyEmail'];
        $commentReply->body         = $validatedData['replyBody'];
        $commentReply->comment_id   = $validatedData['comment_id'];
        
        $commentReply->save();

        return redirect()->back()->with('success', 'Balasan komentar berhasil dikirim');
    }
}
