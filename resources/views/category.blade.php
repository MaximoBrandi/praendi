@extends('layouts.mainl')

@section('main')
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
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

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                {{ $paginatedPosts->links() }}
                            </ul>
                        </nav>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
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

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''"
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
