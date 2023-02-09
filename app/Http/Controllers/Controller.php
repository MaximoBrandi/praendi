<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Post;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('index', ['posts' =>  Post::all()]);
    }

    public function category(){
        $data=['posts' =>  Post::all(), 'paginatedPosts' =>  Post::Paginate(5)];

        return view('category', $data);
    }

    public function categorySearch($id){
        $data=['posts' =>  Post::all()];

        $validateId = $id->validate([
            'id' => ['required', 'string', 'max:20'],
        ]);

        if($validateId){
            $data['paginatedPosts'] = Post::Where('category', $id)->Paginate(5);
            $data['category'] = $id;
        }

        return view('category', $data);
    }

    public function categoryPOST(Request $request){
        $data=['posts' =>  Post::all(), 'paginatedPosts' =>  Post::Paginate(5)];

        $validate = $request->validate([
            'email' => ['email', 'nullable'],
            'search' => ['required', 'string', 'max:60'],
        ]);

        if($validate){
            if($request->search){
                $data['postsSearch'] = Post::search($request->search)->Paginate(5);
            }
        }

        return view('category', $data);
    }

    public function categorySearchPOST($id, Request $request){
        $data=['posts' =>  Post::all()];

        $validateId = $id->validate([
            'email' => ['email', 'nullable'],
            'id' => ['required', 'string', 'max:20'],
        ]);

        if($validateId){
            $data['paginatedPosts'] = Post::Where('category', $id)->Paginate(5);
            $data['category'] = $id;
        }

        $validate = $request->validate([
            'search' => ['required', 'string', 'max:60'],
        ]);

        if($validate){
            if($request->search){
                $data['postsSearch'] = Post::search($request->search)->Paginate(5);
            }
        }

        return view('category', $data);
    }
}
