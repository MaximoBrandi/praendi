<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Comment;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('index', ['posts' =>  Post::all()]);
    }

    public function category(){
        $data=['posts' =>  Post::all(), 'paginatedPosts' =>  Post::Paginate(5)];

        if(isset($_GET['query'])){
            $query = $_GET['query'];
            $data['search'] = str_replace('_', ' ', $query);
            $query = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($query, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

            $data['postsSearch'] = Post::search($query)->Paginate(5);
            $data['search'] = str_replace(' ', '_', $query);
        }

        return view('category', $data);
    }

    public function categorySearch($id){
        $data=['posts' =>  Post::all()];

        $id = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($id, FILTER_UNSAFE_RAW,  FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

        $data['paginatedPosts'] = Post::Where('category', $id)->Paginate(5);
        $data['category'] = $id;

        if(isset($_GET['query'])){
            $query = $_GET['query'];
            $data['search'] = str_replace('_', ' ', $query);
            $query = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($query, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

            $data['postsSearch'] = Post::search($query)->Paginate(5);
            $data['search'] = str_replace(" ", '_', $query);
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
                $data['postsSearch'] = Post::search(preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($request->search, FILTER_UNSAFE_RAW,  FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)))->Paginate(5);
            }
        }

        return view('category', $data);
    }

    public function categorySearchPOST($id, Request $request){
        $data=['posts' =>  Post::all()];

        $id = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($id, FILTER_UNSAFE_RAW,  FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

        $search = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($request->search, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

        $data['paginatedPosts'] = Post::Where('category', $id)->Paginate(5);
        $data['category'] = $id;

        $validate = $request->validate([
            'email' => ['email', 'nullable'],
            'search' => ['required', 'string', 'max:60'],
        ]);

        if($validate){
            if($request->search){
                $data['postsSearch'] = Post::search($search)->Paginate(5);
                $data['search'] = preg_replace(' ', '_', $search);
            }
        }

        return view('category', $data);
    }

    public function post($id){
        $id = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($id, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));

        $data = ['posts' => Post::all(), 'postID' => Post::find($id)];

        if($id > 1){
            $data['LastPost'] = Post::find($id-1);
        }
        if($id < $data['posts']->count()){
            $data['UpcomingPost'] = Post::find($id+1);
        }

        return view('post', $data);
    }

    public function login(){
        return view('authenticat.login');
    }

    public function auth(){
        return view('authenticat.login');
    }

    public function register(){
        return view('authenticat.register');
    }

    public function profile(){
        if(Auth::user()){
            if(Auth::user()->profile){


                return view('profile', ['profile' => Auth::user()->profile]);
            }else{
                return view('createprofile');
            }
        }else{
            return redirect()->back($status = 302);
        }
    }

    public function createprofile(Request $request){
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|dimensions:ratio=1/1|max:1024',
            'name' => ['required','string', 'max:255'],
            'bio' => ['required','string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $Profile = new Profile;
            $Profile->user_id = Auth::user()->id;

            if(isset($request->photo)){
                $Profile->pfp = $request->photo->storeAs(
                    'photo', Auth::user()->id
                );
            }

            if(isset($request->name)){
                $Profile->name = $request->name;
            }
            if(isset($request->bio)){
                $Profile->bio = $request->bio;
            }

            $Profile->save();

            return redirect('profile');
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function comment(Request $request, $id){
        $validate = $request->validate([
            'comment' => ['required', 'string', 'max:60'],
        ]);

        if($validate){
            if($request->comment){
                Comment::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $id,
                    'comment' => filter_var($request->comment, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
                ]);
            }
        }

        return redirect()->back();
    }

    public function postactions(Request $request){
        if((Comment::find($request->comment)->user->id) == Auth::user()->id){
            Comment::find($request->comment)->delete();
        }
    }
}
