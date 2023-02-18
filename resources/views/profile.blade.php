@extends('layouts.profile')

@section('scripts')
    <script src="/assets/js/custom/account.js"></script>
@endsection

@section('main')
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{$profile->banner}}');">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{$profile->pfp}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    <h5 class="mb-1">
                        {{$profile->name}}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        @if ($profile->grade)
                            {{$profile->grade}}
                        @endif
                    </p>
                    </div>
                </div>
                @if (Auth::user()->id !== null && $profile->id !== Auth::user()->profile->id && Follow::where('followed_profile_id', $profile->id)->exists())
                    <div class="col-md-2 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;" onclick="alert()" aria-selected="true">

                                            <button onclick="followAccount('{{csrf_token()}}', {{$profile->id}})" class="nav-link mb-0 px-0 py-0">
                                                <i class="material-icons text-lg position-relative">person_add</i>
                                                <span id="followbutton" class="ms-1">Follow</span>
                                            </button>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Profile Information</h6>
                            </div>
                        </div>
                        </div>
                        <div class="card-body p-3">
                        <p style="white-space: pre-wrap;" class="text-sm">{{$profile->bio}}</p>
                        <hr class="horizontal gray-light my-4">
                            <ul class="list-group">

                                @if ($profile->contact)
                                    @foreach ($profile->contact as $contact)
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{$contact->type}}</strong>{{$contact->content}}</li>
                                    @endforeach
                                @endif

                                @if ($profile->social)
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    @foreach ($profile->social as $social)
                                        <a class="btn {{$social->btn}} btn-simple mb-0 ps-1 pe-2 py-0" href="{{$social->content}}">
                                            <i class="fab {{$social->icon}} fa-lg"></i>
                                        </a>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Comments</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">

                                    @foreach ($profile->user->comments->take(5) as $comment)
                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                            <div class="avatar me-3">
                                                <img src="{{'/storage/'.$profile->pfp}}" width="48px" height="48px" alt="kal" class="border-radius-lg shadow">
                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$profile->name}}</h6>
                                                <p class="mb-0 text-xs">{{$comment->comment}}</p>
                                            </div>
                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="/post/{{$comment->post->id}}">Go to post</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Feed</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">

                                    @if ($profile->caca)
                                        @foreach ($profile->caca as $comment)
                                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                                <div class="avatar me-3">
                                                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                                </div>
                                                <div class="d-flex align-items-start flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Sophie B.</h6>
                                                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                                                </div>
                                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                    <div class="mb-5 ps-3">
                        <h6 class="mb-1">Posts</h6>
                        <p class="text-sm">Posts writed by you</p>
                    </div>
                        <div class="row">

                            @if($profile->user->posts)
                                @foreach ($profile->user->posts as $post)
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        <div class="card card-blog card-plain">
                                            <div class="card-header p-0 mt-n4 mx-3">
                                            <a href="/post/{{$post->id}}" class="d-block shadow-xl border-radius-xl">
                                                <img src="{{$post->image}}" width="232" height="131px" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                            </a>
                                            </div>
                                            <div class="card-body p-3">
                                            <p style="cursor: pointer;" onclick="location.href='/category/{{$post->category}}'" class="mb-0 text-sm">{{$post->category}}</p>
                                            <a href="/post/{{$post->id}}">
                                                <h5>
                                                    {{$post->title}}
                                                </h5>
                                            </a>
                                            <p class="mb-4 text-sm">
                                                Caca y compota de pera
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button  onclick="location.href='/post/{{$post->id}}'" type="button" class="btn btn-outline-primary btn-sm mb-0">Read Post</button>
                                                <div class="avatar-group mt-2">
                                                    @foreach ($post->comments->take(5) as $comment)
                                                        <a href="/profile/{{$comment->user->id}}" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comment->user->profile->name}}">
                                                            <img alt="Image placeholder" src="/storage/{{$comment->user->profile->pfp}}">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm">Nothing to see here!</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Auth::user()->id !== null && $profile->user->id == Auth::user()->id)
    @section('toggle')
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                <i class="material-icons py-2">manage_accounts</i>
            </a>
            <div class="card shadow-lg">
                <div class="card-header pb-0 pt-3">
                    <div class="float-start">
                        <h5 class="mt-3 mb-0">Profile settings</h5>
                        <p>Share what do you want to share.</p>
                    </div>
                    <div class="float-end mt-4">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                <div class="card-body pt-sm-3 pt-0 overflow-auto">
                    <!-- Sidenav Type -->
                    <div class="mt-3">
                        <!-- Navbar Fixed -->
                        <form action="{{route('updateprofile')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="mt-3 d-flex">
                                <hr class="horizontal dark my-3">
                                <div class="input-group-outline">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input name="name" type="text" class="form-control">
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="mt-2 d-flex">
                                <div class="input-group ps-0 ms-auto my-auto">
                                    <label>Biography</label>
                                </div>
                            </div>
                            <div class="mt-2 d-flex">
                                <div class="input-group input-group-outline mb-3">
                                    <textarea style="white-space: pre-wrap;" name="bio" type="file" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="input-group-outline">
                                <label class="form-label">Grade/Speciality</label>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input name="grade" type="text" class="form-control">
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="mt-2 d-flex">
                                <div class="input-group ps-0 ms-auto my-auto">
                                    <label>Profile photo</label>
                                </div>
                            </div>
                            <div class="mt-2 d-flex">
                                <div class="input-group input-group-outline mb-3">
                                    <input name="photo" type="file" class="form-control">
                                </div>
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="mt-2 d-flex">
                                <div class="input-group ps-0 ms-auto my-auto">
                                    <label>Banner photo</label>
                                </div>
                            </div>
                            <div class="mt-2 d-flex">
                                <div class="input-group input-group-outline mb-3">
                                    <input name="banner" type="file" class="form-control">
                                </div>
                            </div>
                            <hr class="horizontal dark my-sm-4">
                            <input type="submit" value="Apply Changes"  class="btn bg-gradient-info w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
