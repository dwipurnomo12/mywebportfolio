<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Jorenvh\Share\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LpPostsController extends Controller
{
    public function posts()
    {
        $posts = Post::latest();
        return view('posts', [
            'posts'         => $posts->where('status_id', 2)->paginate(12),
            'kategoris'     => Kategori::all()
        ]);
    }

    public function detailPost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->views += 1;
        $post->save();

        $comments = $post->comments;

        $shareComponent = new Share;
        $shareComponent->page(url($post), 'Your share text comes here')
            ->facebook()
            ->twitter()
            ->linkedin('Extra linkedin summary can be passed here')
            ->whatsapp()
            ->getRawLinks();

        return view('post', [
            'post'              => $post,
            'comments'          => $comments,
            'shareComponent'    => $shareComponent,
            'populerPost'       => Post::orderBy('views', 'desc')->take(5)->get(),
            'kategoris'         => Kategori::all()
        ]);
    }

}
