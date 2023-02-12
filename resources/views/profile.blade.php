<?php
use Illuminate\Support\Facades\Storage;
?>

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <title>
        Praendi
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    </head>

    <body class="g-sidenav-show bg-gray-200">

    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <div class="row d-flex align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
                        <div class="logo">
                            <a href="/"><img src="/assets/img/logo/Logo50.png" alt=""></a>
                        </div>
                    </div>
                    <!-- Ad -->
                    <!-- <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="header-banner f-right ">
                            <img src="/assets/img/gallery/header_card.png" alt="">
                        </div>
                    </div> -->
                </div>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" class="form-control">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <input class="btn bg-gradient-primary w-100 my-1 mb-1" type="submit" value="Logout">
                    </form>
                    <a href="" class="nav-link text-body font-weight-bold px-0">
                    </a>
                </li>
                <li class="nav-item ps-3 dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell cursor-pointer"></i>
                </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        @if (Auth::user()->notifications)
                            @foreach (Auth::user()->notifications as $notification)
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            13 minutes ago
                                            </p>
                                        </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <p>Nothing to see here!</p>
                        @endif

                    </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                    <img src="{{'/storage/'.$profile->pfp}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    <h5 class="mb-1">
                        {{$profile->name}}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        @if ($profile->status)
                            {{$profile->status}}
                        @endif
                    </p>
                    </div>
                </div>
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
                        <p class="text-sm">
                            {{$profile->bio}}
                        </p>
                        <hr class="horizontal gray-light my-4">
                            <ul class="list-group">

                                @if (Auth::user()->profile->contacts)
                                    @foreach (Auth::user()->profile->contacts as $contact)
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">{{$contact->type}}</strong>{{$contact->content}}</li>
                                    @endforeach
                                @endif

                                @if (Auth::user()->profile->socials)
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    @foreach (Auth::user()->profile->socials as $social)
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

                                    @foreach (Auth::user()->comments->take(5) as $comment)
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

                                    @if (Auth::user()->caca)
                                        @foreach (Auth::user()->caca as $comment)
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

                            @if(Auth::user()->posts)
                                @foreach (Auth::user()->posts as $post)
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
                                                <button  onclick="location.href='/category/{{$post->category}}'" type="button" class="btn btn-outline-primary btn-sm mb-0">Read Post</button>
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

        <footer class="footer py-4">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="{{route('index')}}" class="font-weight-bold" target="_blank">Prændi™</a>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Prændi</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">Terms and conditions</a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        </footer>
    </div>
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
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidenav Type -->
            <div class="mt-3">
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
            </div>
        </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
    </body>

</html>
