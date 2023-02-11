@extends('layouts.mainl')

@section('main')
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix pt-25 gray-bg">
            <div class="container">
                <div class="trending-main">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Top -->
                            <div class="slider-active">

                                @foreach ($posts->sortByDesc('created_at')->take(3) as $post)
                                    <div class="single-slider">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img width="750" height="645" src="{{ $post->image }}" alt="">
                                                <div class="trend-top-cap">
                                                    <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms">{{ $post->category }}</span>
                                                    <h2><a href="/post/{{ $post->id }}" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms">{{ $post->title }}</a></h2>
                                                    <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">by {{ $post->user->name }}   -   {{ $post->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Big slide posts -->

                            </div>
                        </div>
                        <!-- Right content -->
                        <div class="col-lg-4">
                            <!-- Trending Top -->
                            <div class="row">
                                <!-- Single -->

                                @if (($posts->where('category', 'qui'))->first->title !== null)
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="{{$posts->where('category', 'qui')->sortByDesc('name')->first()->image}}" width="380" height="350" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgb">{{$posts->where('category', 'qui')->sortByDesc('name')->first()->category}}</span>
                                                    <h2><a href="/post/{{$posts->where('category', 'qui')->sortByDesc('name')->first()->id}}">{{$posts->where('category', 'qui')->sortByDesc('name')->first()->title}}</a></h2>
                                                    <p>by {{$posts->where('category', 'qui')->sortByDesc('name')->first()->user->name}}   -   {{$posts->where('category', 'qui')->sortByDesc('name')->first()->created_at}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="{{$posts->sortByDesc('reads')->first()->image}}" width="380" height="630" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgg">{{$posts->sortByDesc('reads')->first()->category}}</span>
                                                    <h2><a href="/post/{{$posts->sortByDesc('reads')->first()->id}}">{{$posts->sortByDesc('reads')->first()->title}}</a></h2>
                                                    <p>by {{$posts->sortByDesc('reads')->first()->user->name}}   -   {{$posts->sortByDesc('reads')->first()->created_at}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Single -->

                                @if (($posts->where('category', 'qui'))->first->title !== null)
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="{{$posts->sortByDesc('reads')->first()->image}}" width="380" height="250" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgg">{{$posts->sortByDesc('reads')->first()->category}}</span>
                                                    <h2><a href="/post/{{$posts->sortByDesc('reads')->first()->id}}">{{$posts->sortByDesc('reads')->first()->title}}</a></h2>
                                                    <p>by {{$posts->sortByDesc('reads')->first()->user->name}}   -   {{$posts->sortByDesc('reads')->first()->created_at}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->
        <!--  Recent Articles start -->
        <div class="recent-articles pt-80 pb-80">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Trending  Posts</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">

                                @foreach ($posts->where('multimedia', true)->sortBy('created_at') as $post)
                                    <div class="single-recent">
                                        <div class="what-img">
                                            <img src="{{ $post->image }}" alt="">
                                        </div>
                                        <div class="what-cap">
                                            <h4><a href="/post/{{ $post->id }}" > <h4><a href="/post/{{ $post->id }}">{{ $post->title }}</a></h4></a></h4>
                                            <P>{{ $post->created_at }}</P>
                                            <a class="popup-video btn-icon" href="/post/{{ $post->id }}"><span class="flaticon-play-button"></span></a>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Recent Articles End -->
        <!--   Weekly3-News start -->
        <div class="weekly3-news-area pt-80 pb-130">
            <div class="container">
                <div class="weekly3-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider-wrapper">
                                <!-- Slider -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="weekly3-news-active dot-style d-flex">

                                            @foreach ($posts as $post)
                                                <div class="weekly3-single">
                                                    <div class="weekly3-img">
                                                        <img src="{{ $post->image }}" alt="">
                                                    </div>
                                                    <div class="weekly3-caption">
                                                        <h4><a href="/post/{{ $post->id }}">{{ $post->title }}</a></h4>
                                                        <p>{{ $post->created_at }}</p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->
    </main>
@endsection

@section('popularposts')
    @foreach ($posts->sortByDesc('reads')->take(3) as $post)
        <div class="whats-right-single mb-20">
            <div class="whats-right-img">
                <img src="{{$post->image}}" width="85" height="80" alt="">
            </div>
            <div class="whats-right-cap">
                <h4><a href="/post/{{$post->id}}">{{$post->title}}</a></h4>
                <p>{{$post->user->title}}  |  {{$post->created_at}}</p>
            </div>
        </div>
    @endforeach
@endsection
