<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('index', ['posts' =>  Post::all()]);
    }

    public function category()
    {

        return view('category', ['posts' =>  Post::all(), 'paginatedPosts' =>  Post::Paginate(5)]);
    }

    public function categorySearch($id)
    {
        return view('category', ['category' => $id, 'posts' =>  Post::all(), 'paginatedPosts' =>  Post::Where('category', $id)->Paginate(5)]);
    }
}
