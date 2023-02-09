<div class="single-slider">
    <div class="trending-top mb-30">
        <div class="trend-top-img">
            <img src="{{ $post->image }}" alt="">
            <div class="trend-top-cap">
                <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms">{{ $post->category }}</span>
                <h2><a href="latest_news.html" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms">{{ $post->name }}</a></h2>
                <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">by {{ $post->user->name }}   -   {{ $post->created_at }}</p>
            </div>
        </div>
    </div>
</div>
