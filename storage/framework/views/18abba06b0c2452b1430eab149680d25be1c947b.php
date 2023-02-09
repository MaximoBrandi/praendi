<?php $__env->startSection('main'); ?>
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix pt-25 gray-bg">
            <div class="container">
                <div class="trending-main">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Top -->
                            <div class="slider-active">

                                <?php $__currentLoopData = $posts->sortByDesc('created_at')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-slider">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img width="750" height="645" src="<?php echo e($post->image); ?>" alt="">
                                                <div class="trend-top-cap">
                                                    <span class="bgr" data-animation="fadeInUp" data-delay=".2s" data-duration="1000ms"><?php echo e($post->category); ?></span>
                                                    <h2><a href="/post/<?php echo e($post->id); ?>" data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms"><?php echo e($post->title); ?></a></h2>
                                                    <p data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms">by <?php echo e($post->user->name); ?>   -   <?php echo e($post->created_at); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Big slide posts -->

                            </div>
                        </div>
                        <!-- Right content -->
                        <div class="col-lg-4">
                            <!-- Trending Top -->
                            <div class="row">
                                <!-- Single -->

                                <?php if(($posts->where('category', 'qui'))->first->title !== null): ?>
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="<?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->image); ?>" width="380" height="350" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgb"><?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->category); ?></span>
                                                    <h2><a href="/post/<?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->id); ?>"><?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->title); ?></a></h2>
                                                    <p>by <?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->user->name); ?>   -   <?php echo e($posts->where('category', 'qui')->sortByDesc('name')->first()->created_at); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="<?php echo e($posts->sortByDesc('reads')->first()->image); ?>" width="380" height="630" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgg"><?php echo e($posts->sortByDesc('reads')->first()->category); ?></span>
                                                    <h2><a href="/post/<?php echo e($posts->sortByDesc('reads')->first()->id); ?>"><?php echo e($posts->sortByDesc('reads')->first()->title); ?></a></h2>
                                                    <p>by <?php echo e($posts->sortByDesc('reads')->first()->user->name); ?>   -   <?php echo e($posts->sortByDesc('reads')->first()->created_at); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Single -->

                                <?php if(($posts->where('category', 'qui'))->first->title !== null): ?>
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="trending-top mb-30">
                                            <div class="trend-top-img">
                                                <img src="<?php echo e($posts->sortByDesc('reads')->first()->image); ?>" width="380" height="250" alt="">
                                                <div class="trend-top-cap trend-top-cap2">
                                                    <span class="bgg"><?php echo e($posts->sortByDesc('reads')->first()->category); ?></span>
                                                    <h2><a href="/post/<?php echo e($posts->sortByDesc('reads')->first()->id); ?>"><?php echo e($posts->sortByDesc('reads')->first()->title); ?></a></h2>
                                                    <p>by <?php echo e($posts->sortByDesc('reads')->first()->user->name); ?>   -   <?php echo e($posts->sortByDesc('reads')->first()->created_at); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

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
                                <h3>Trending  News</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">

                                <?php $__currentLoopData = $posts->where('multimedia', true)->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-recent">
                                        <div class="what-img">
                                            <img src="<?php echo e($post->image); ?>" alt="">
                                        </div>
                                        <div class="what-cap">
                                            <h4><a href="/post/<?php echo e($post->id); ?>" > <h4><a href="/post/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h4></a></h4>
                                            <P><?php echo e($post->created_at); ?></P>
                                            <a class="popup-video btn-icon" href="/post/<?php echo e($post->id); ?>"><span class="flaticon-play-button"></span></a>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

                                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="weekly3-single">
                                                    <div class="weekly3-img">
                                                        <img src="<?php echo e($post->image); ?>" alt="">
                                                    </div>
                                                    <div class="weekly3-caption">
                                                        <h4><a href="/post/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h4>
                                                        <p><?php echo e($post->created_at); ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('popularposts'); ?>
    <?php $__currentLoopData = $posts->sortByDesc('reads')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="whats-right-single mb-20">
            <div class="whats-right-img">
                <img src="<?php echo e($post->image); ?>" width="85" height="80" alt="">
            </div>
            <div class="whats-right-cap">
                <h4><a href="/post/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></h4>
                <p><?php echo e($post->user->title); ?>  |  <?php echo e($post->created_at); ?></p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/maximoprandi/Documentos/Projects/Personal/praendi/resources/views/index.blade.php ENDPATH**/ ?>