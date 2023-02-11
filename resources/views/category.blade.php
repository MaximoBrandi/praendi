@extends('layouts.blog')

@section('content')
    <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="blog_left_sidebar">

            @if (isset($postsSearch))
                @foreach ($postsSearch as $post)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{$post->image}}" width="750px" height="375px" alt="">
                            <a href="/post/{{$post->id}}" class="blog_item_date">
                                <h3>{{$post->created_at->day}}</h3>
                                <p>{{date("F", mktime(0, 0, 0, $post->created_at->month, 1))}}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="/post/{{$post->id}}">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                he earth it first without heaven in place seed it second morning saying.</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> {{$post->category}}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> {{$post->comments->count()}} Comments</a></li>
                            </ul>
                        </div>
                    </article>
                @endforeach
            @else
                @foreach ($paginatedPosts as $post)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{$post->image}}" width="750px" height="375px" alt="">
                            <a href="/post/{{$post->id}}" class="blog_item_date">
                                <h3>{{$post->created_at->day}}</h3>
                                <p>{{date("F", mktime(0, 0, 0, $post->created_at->month, 1))}}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="/post/{{$post->id}}">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                he earth it first without heaven in place seed it second morning saying.</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> {{$post->category}}</a></li>
                                <li><a href="#"><i class="fa fa-user"></i> {{$post->user->name}}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> {{$post->comments->count()}} Comments</a></li>
                            </ul>
                        </div>
                    </article>
                @endforeach
            @endif

            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">

                    @if (isset($postsSearch))
                        {{ $postsSearch->links() }}
                    @else
                        {{ $paginatedPosts->links() }}
                    @endif

                </ul>
            </nav>
        </div>
    </div>
@endsection
