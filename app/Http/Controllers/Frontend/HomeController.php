<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home',[
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(Post $post)
    {
        return view('Frontend.post',compact('post'));
    }
}
