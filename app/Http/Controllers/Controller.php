<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Newsletter;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function cleanUnderScores($text){
    $tst = $text;
    $under = "--";
    $pos = 0;

        while(strpos($tst, $under) != false )
        {
        //$pos = strpos($tst, $under);
        $tst = str_replace("--", "-", $tst);
        }
    return $tst;
    }

    function clean_url($text){
    $code_entities_match = array( '&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,'---' ,'--','--','-','’','`','•');
    $code_entities_replace = array(' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ',' ',' ',' ',' ',' ',' ');
    $text = str_replace($code_entities_match, $code_entities_replace, $text);
    $text = trim($text," ");
    $text = $this->cleanUnderScores($text);
    return $text;
    }

    function name_cleaner($string){
    // Replace other special chars
    $specialCharacters = array(
    '#' => '',
    '’' => '',
    '`' => '',
    '\'' => '',
    '$' => '',
    '%' => '',
    '&' => '',
    '@' => '',
    '.' => '',
    '€' => '',
    '+' => '',
    '=' => '',
    '§' => '',
    '\\' => '',
    '/' => '',
    '`' => '',
    '•' => '',
    '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
    '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
    '/[“”«»„]/u'    =>   ' ', // Double quote
    '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );

    str_replace($specialCharacters, '', $string);

    // Remove all remaining other unknown characters
    // $string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
    // $string = preg_replace('/^[\-]+/', '', $string);
    // $string = preg_replace('/[\-]+$/', '', $string);
    // $string = preg_replace('/[\-]{2,}/', ' ', $string);
    $string = $this->clean_url($string);
    return $string;
    }

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

    public function profile($id = null){
        if(isset($id)){
            $id = preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($id, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
            $id = User::find($id)->profile->id;

            return view('profile', ['profile' => Profile::find($id)]);
        }else if(Auth::user()){
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
            'photo' => 'nullable|image|max:2048',
            'name' => ['nullable','string', 'max:255'],
            'bio' => ['nullable','string', 'max:255'],
        ]);

        $popo = array(
            0 => '/storage/photos/profile_banner/default-image-1.avif',
            1 => '/storage/photos/profile_banner/default-image-2.avif',
            2 => '/storage/photos/profile_banner/default-image-3.avif',
            3 => '/storage/photos/profile_banner/default-image-4.avif',
            4 => '/storage/photos/profile_banner/default-image-5.avif',
            5 => '/storage/photos/profile_banner/default-image-6.avif',
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $Profile = new Profile;
            $Profile->user_id = Auth::user()->id;
            $Profile->banner = $popo[array_rand($popo)];

            if(isset($request->photo)){
                Image::configure(['driver' => 'gd']);

                $compotadepera = Image::make($request->photo);

                if($compotadepera->width() < 300 || $compotadepera->height() < 300){
                    $resize = Image::make($request->photo)->resize(100, 100)->encode('avif', 70);
                }else{
                    $resize = Image::make($request->photo)->resize(300, 300)->encode('avif', 70);
                }

                // calculate md5 hash of encoded image
                $hash = md5($resize->__toString());

                // use hash as a name
                $path = "/assets/{$hash}.avif";

                // save it locally to ~/public/images/{$hash}.jpg
                $resize->save(public_path($path));

                // $url = "/images/{$hash}.jpg"
                $url = "/" . $path;

                Storage::put('/photos/profile_pictures/'.Auth::user()->id.'.avif', $resize->__toString());

                $Profile->pfp = '/storage/photos/profile_pictures/'.Auth::user()->id.'.avif';
            }

            if(isset($request->name)){
                $Profile->name = $this->name_cleaner(filter_var($request->name, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW));
            }else{
                do{
                    $name = 'Anonymus User '. rand(0,9999);
                }while(Profile::where('name', $name)->get()->first() !== null);

                $Profile->name = $name;
            }
            if(isset($request->bio)){
                $Profile->bio = $this->name_cleaner(filter_var($request->bio, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH));
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

    public function updateprofile(Request $request){
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'name' => ['nullable','string', 'max:255'],
            'bio' => ['nullable','string', 'max:255'],
            'grade' => ['nullable','string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $Profile = Profile::find(Auth::user()->profile->id);

            if(isset($request->photo)){
                Image::configure(['driver' => 'gd']);

                $compotadepera = Image::make($request->photo);

                if($compotadepera->width() < 300 || $compotadepera->height() < 300){
                    $resize = Image::make($request->photo)->resize(100, 100)->encode('avif', 70);
                }else{
                    $resize = Image::make($request->photo)->resize(300, 300)->encode('avif', 70);
                }

                // calculate md5 hash of encoded image
                $hash = md5($resize->__toString());

                // use hash as a name
                $path = "/assets/{$hash}.avif";

                // save it locally to ~/public/images/{$hash}.jpg
                $resize->save(public_path($path));

                // $url = "/images/{$hash}.jpg"
                $url = "/" . $path;

                Storage::put('/photos/profile_pictures/'.Auth::user()->id.'.avif', $resize->__toString());

                $Profile->pfp = '/storage/photos/profile_pictures/'.Auth::user()->id.'.avif';
            }

            if(isset($request->banner)){
                Image::configure(['driver' => 'gd']);

                $compotadepera = Image::make($request->banner);

                if($compotadepera->width() < 600 || $compotadepera->height() < 200){
                    $resize = Image::make($request->banner)->resize(1300, 300)->encode('avif', 70);
                }else{
                    $resize = Image::make($request->banner)->resize(650, 150)->encode('avif', 70);
                }

                // calculate md5 hash of encoded image
                $hash = md5($resize->__toString());

                // use hash as a name
                $path = "/assets/{$hash}.avif";

                // save it locally to ~/public/images/{$hash}.jpg
                $resize->save(public_path($path));

                // $url = "/images/{$hash}.jpg"
                $url = "/" . $path;

                Storage::put('/photos/profile_banner/'.Auth::user()->id.'.avif', $resize->__toString());

                $Profile->banner = '/storage/photos/profile_banner/'.Auth::user()->id.'.avif';
            }

            if(isset($request->name)){
                $Profile->name = $this->name_cleaner(filter_var($request->name, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW));
            }
            if(isset($request->bio)){
                $Profile->bio = $this->name_cleaner(filter_var($request->bio, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW));
            }
            if(isset($request->grade)){
                $Profile->grade = $this->name_cleaner(filter_var($request->grade, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW));
            }

            $Profile->save();

            return redirect('profile');
        }
    }

    public function searchprofile(Request $request){
        $search = Profile::search($this->name_cleaner($request->search));

        if($search->first()->name === $request->search){
            return $search->first()->user_id;
        }

        return json_encode($search->get()->toArray());
    }

    public function about(){
        return view('about', ['posts' => Post::all()]);
    }

    public function terms(){
        return view('terms', ['posts' => Post::all()]);
    }

    public function followaccount(Request $request){
        $validator = Validator::make($request->all(), [
            'account' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return 'boludo :v';
        }else{
            Follow::Create([
                'followed_profile_id' => preg_replace('/[^a-zA-Z0-9 ]/', '', filter_var($request->account, FILTER_UNSAFE_RAW,  FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)),
                'profile_id' => Auth::user()->id,
            ]);

            return 'ok';
        }
    }

    public function newsletter(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|max:256'
        ]);

        if ($validator->fails()) {
            return 'boludo :v';
        }else{
            Newsletter::Create([
                'email' => $request->email,
            ]);

            return 'ok';
        }
    }
}
