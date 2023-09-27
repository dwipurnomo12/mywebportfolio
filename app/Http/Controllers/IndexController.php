<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\About;
use App\Models\Email;
use App\Models\Skill;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'abouts'        => About::all(),
            'skills'        => Skill::all(),
            'projects'      => Project::latest()->take(3)->get(),
            'pendidikans'   => Pendidikan::all(),
            'pekerjaans'    => Pekerjaan::all(),
            'contact'       => Contact::first(),
            'posts'         => Post::where('status_id', 2)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'body'    => 'required',
        ]);

        $data = [
          'name'    => $request->name,
          'email'   => $request->email,
          'body'    => $request->body
        ];

        Mail::send('email', $data, function($message) use ($data) {
          $message->to($data['email'])
          ->subject('Kerjasama');
        });

        return back()->with(['message' => 'Email successfully sent!']);
    }
}
