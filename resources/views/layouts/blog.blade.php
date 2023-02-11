@extends('layouts.mainl')

@section('main')

<section class="blog_area @yield('customSectionClass') section-padding">
    <div class="container">
        <div class="row">

            @yield('content')

            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget newsletter_widget">
                        <form method="post" action="{{route('category')}}">
                            <div class="form-group">
                                @csrf
                                <input name="search" type="text" class="form-control" placeholder='Search Keyword'
                                    onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Search Keyword'">
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Search</button>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">

                            @foreach ($posts->groupBy('category') as $post)
                                <li>
                                    <a href="/category/{{$post[0]->category}}" class="d-flex">
                                        <p>{{$post[0]->category}}</p>
                                        <p>({{$post->count()}})</p>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>

                        @foreach ($posts->sortByDesc('created_at')->take(5) as $post)
                            <div class="media post_item">
                                <img src="{{$post->image}}" width="80px" height="80px" alt="post">
                                <div class="media-body">
                                    <a href="/post/{{$post->id}}">
                                        <h3>{{$post->title}}</h3>
                                    </a>
                                    <p>{{$post->created_at}}</p>
                                </div>
                            </div>
                        @endforeach

                    </aside>

                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>

                        <form method="post" action="{{route('category')}}">
                            @csrf
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>

        </div>
    </div>
</section>
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
