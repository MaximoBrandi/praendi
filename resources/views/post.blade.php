@extends('layouts.blog')

@section('customSectionClass', ' single-post-area ')


@section('content')

    <div class="col-lg-8 posts-list">
        <div class="single-post">
           <div class="feature-img">
              <img class="img-fluid" src="{{$postID->image}}" alt="">
           </div>
           <div class="blog_details">
              <h2>Second divided from form fish beast made every of seas
                 all gathered us saying he our
              </h2>
              <ul class="blog-info-link mt-3 mb-4">
                 <li><a href="/category/{{$postID->category}}"><i class="fa fa-user"></i>{{$postID->category}}</a></li>
                 <li><a href="#comments"><i class="fa fa-comments"></i> {{$postID->comments->count()}} Comments</a></li>
                 <li><a href="javascript:;"><i class="fa fa-comments"></i>{{$postID->created_at->day}}  {{date("F", mktime(0, 0, 0, $postID->created_at->month, 1))}} {{$postID->created_at->year}}</a></li>
              </ul>
              <p class="excert">
                 MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                 should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                 fraction of the camp price. However, who has the willpower
              </p>
              <p>
                 MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                 should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                 fraction of the camp price. However, who has the willpower to actually sit through a
                 self-imposed MCSE training. who has the willpower to actually
              </p>
              <div class="quote-wrapper">
                 <div class="quotes">
                    MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                    should have to spend money on boot camp when you can get the MCSE study materials yourself at
                    a fraction of the camp price. However, who has the willpower to actually sit through a
                    self-imposed MCSE training.
                 </div>
              </div>
              <p>
                 MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                 should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                 fraction of the camp price. However, who has the willpower
              </p>
              <p>
                 MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                 should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                 fraction of the camp price. However, who has the willpower to actually sit through a
                 self-imposed MCSE training. who has the willpower to actually
              </p>
           </div>
        </div>
        <div class="navigation-top">
           <div class="d-sm-flex justify-content-between text-center">
                <ul class="like-info social-icons">
                    @if ($postID->user_liked())
                        <li style="margin-right:0px;"><a onclick="like({{$postID->id}}, '{{csrf_token()}}')" href="javascript:;"><i style="color:greenyellow;" class="fa fa-heart"></i></a></li>
                    @else
                        <li style="margin-right:0px;"><a onclick="like({{$postID->id}}, '{{csrf_token()}}')" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                    @endif

                    @if ($postID->likes->count() >= 2)
                        <li><p class="like-info">{{$postID->likes->sortByDesc('created_at')->first()->user->profile->name}} and {{$postID->likes->count()}} people like this</p></li>
                    @elseif($postID->likes->count() == 1)
                        <li><p class="like-info">{{$postID->likes->first()->user->profile->name}} liked this</p></li>
                    @else
                        <li><p class="like-info">No one leaved a like yet!</p></li>
                    @endif
                </ul>
                <ul class="social-icons">
                    @foreach ($postID->socials as $social)
                        <li><a href="{{$social->link}}"><i class="fab fa-{{$social->name}}"></i></a></li>
                    @endforeach
                </ul>
           </div>
           <div class="navigation-area">
              <div class="row">
                @if (isset($LastPost))
                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                        <div class="thumb">
                        <a href="/post/{{$LastPost->id}}">
                            <img class="img-fluid" src="{{$LastPost->image}}" width="120px" height="120px" alt="">
                        </a>
                        </div>
                        <div class="arrow">
                        <a href="/post/{{$LastPost->id}}">
                            <span class="lnr text-white ti-arrow-left"></span>
                        </a>
                        </div>
                        <div class="detials">
                        <p>Prev Post</p>
                        <a href="/post/{{$LastPost->id}}">
                            <h4>{{$LastPost->title}}</h4>
                        </a>
                        </div>
                    </div>
                @endif

                @if (isset($UpcomingPost))
                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        <div class="detials">
                        <p>Next Post</p>
                        <a href="/post/{{$UpcomingPost->id}}">
                            <h4>{{$UpcomingPost->title}}</h4>
                        </a>
                        </div>
                        <div class="arrow">
                        <a href="/post/{{$UpcomingPost->id}}">
                            <span class="lnr text-white ti-arrow-right"></span>
                        </a>
                        </div>
                        <div class="thumb">
                        <a href="/post/{{$UpcomingPost->id}}">
                            <img class="img-fluid" src="{{$UpcomingPost->image}}" width="120px" height="120px" alt="">
                        </a>
                        </div>
                    </div>
                @endif
              </div>
           </div>
        </div>

        <div class="blog-author">
           <div class="media align-items-center">
              <img width="70px" height="70px" style="border-radius:50%" src="{{$postID->user->profile->pfp}}" alt="">
              <div class="media-body">
                 <a href="/profile/{{$postID->user->id}}">
                    <h4>{{$postID->user->profile->name}}</h4>
                 </a>
                 <p>{{$postID->user->profile->bio}}</p>
              </div>
           </div>
        </div>

        <div class="comments-area" id="comments">
           <h4>{{$postID->comments->count()}} Comments</h4>

           @foreach ($postID->comments as $comment)
            <div class="comment-list">
                <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                    <div class="thumb">
                        <img src="{{$comment->user->profile->pfp}}" alt="">
                    </div>
                    <div class="desc">
                        <p class="comment">
                            {{$comment->comment}}
                        </p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                            <h5>
                                <a href="/profile/{{$comment->user->id}}">{{$comment->user->profile->name}}</a>
                            </h5>
                                <p style="white-space: pre-wrap;" class="date">{{$postID->created_at->day}}  {{date("F", mktime(0, 0, 0, $postID->created_at->month, 1))}} {{$postID->created_at->year}} - {{$postID->created_at->hour}}:{{$postID->created_at->minute}}</p>
                            </div>
                            <div class="reply-btn">
                                <a style="cursor: pointer" onclick="deleteComment({{$comment->id}}, '{{csrf_token()}}')" class="btn-reply text-uppercase">delete</a>
                            </div>
                            <div class="reply-btn">
                                <a style="cursor: pointer" onclick="deleteComment({{$comment->id}})" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
           @endforeach

        </div>

        <div class="comment-form">
            @if (Auth::user())
                <h4>Leave a Reply</h4>
                <form method="post" class="form-contact comment_form" action="/post/{{$postID->id}}" id="commentForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                placeholder="Write Comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                    </div>
                </form>
            @else
                <h4>Log-in to comment this post</h4>
            @endif
        </div>

     </div>
@endsection
