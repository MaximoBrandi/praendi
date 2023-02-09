<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function show(Post $post)
    {
        if(Cookie::get($post->id)!=''){
		Cookie::set($post->id, '1', 60);
		$post->incrementReadCount();
	}
        return view('post.show', compact($post));
    }
}
