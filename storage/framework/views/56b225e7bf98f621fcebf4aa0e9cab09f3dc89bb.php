<?php $__env->startSection('main'); ?>
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        <?php if(isset($postsSearch)): ?>
                            <?php $__currentLoopData = $postsSearch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="<?php echo e($post->image); ?>" width="750px" height="375px" alt="">
                                        <a href="/post/<?php echo e($post->id); ?>" class="blog_item_date">
                                            <h3><?php echo e($post->created_at->day); ?></h3>
                                            <p><?php echo e(date("F", mktime(0, 0, 0, $post->created_at->month, 1))); ?></p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="/post/<?php echo e($post->id); ?>">
                                            <h2><?php echo e($post->title); ?></h2>
                                        </a>
                                        <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                            he earth it first without heaven in place seed it second morning saying.</p>
                                        <ul class="blog-info-link">
                                            <li><a href="#"><i class="fa fa-user"></i> <?php echo e($post->category); ?></a></li>
                                            <li><a href="#"><i class="fa fa-user"></i> <?php echo e($post->user->name); ?></a></li>
                                            <li><a href="#"><i class="fa fa-comments"></i> <?php echo e($post->comments->count()); ?> Comments</a></li>
                                        </ul>
                                    </div>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <?php $__currentLoopData = $paginatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="<?php echo e($post->image); ?>" width="750px" height="375px" alt="">
                                        <a href="/post/<?php echo e($post->id); ?>" class="blog_item_date">
                                            <h3><?php echo e($post->created_at->day); ?></h3>
                                            <p><?php echo e(date("F", mktime(0, 0, 0, $post->created_at->month, 1))); ?></p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="/post/<?php echo e($post->id); ?>">
                                            <h2><?php echo e($post->title); ?></h2>
                                        </a>
                                        <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                            he earth it first without heaven in place seed it second morning saying.</p>
                                        <ul class="blog-info-link">
                                            <li><a href="#"><i class="fa fa-user"></i> <?php echo e($post->category); ?></a></li>
                                            <li><a href="#"><i class="fa fa-user"></i> <?php echo e($post->user->name); ?></a></li>
                                            <li><a href="#"><i class="fa fa-comments"></i> <?php echo e($post->comments->count()); ?> Comments</a></li>
                                        </ul>
                                    </div>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">

                                <?php if(isset($postsSearch)): ?>
                                    <?php echo e($postsSearch->links()); ?>

                                <?php else: ?>
                                    <?php echo e($paginatedPosts->links()); ?>

                                <?php endif; ?>

                            </ul>
                        </nav>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget newsletter_widget">
                            <form method="post" action="<?php echo e(route('category')); ?>">
                                <div class="form-group">
                                    <?php echo csrf_field(); ?>
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

                                <?php $__currentLoopData = $posts->groupBy('category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="/category/<?php echo e($post[0]->category); ?>" class="d-flex">
                                            <p><?php echo e($post[0]->category); ?></p>
                                            <p>(<?php echo e($post->count()); ?>)</p>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>

                            <?php $__currentLoopData = $posts->sortByDesc('created_at')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="media post_item">
                                    <img src="<?php echo e($post->image); ?>" width="80px" height="80px" alt="post">
                                    <div class="media-body">
                                        <a href="/post/<?php echo e($post->id); ?>">
                                            <h3><?php echo e($post->title); ?></h3>
                                        </a>
                                        <p><?php echo e($post->created_at); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </aside>

                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>

                            <form method="post" action="<?php echo e(route('category')); ?>">
                                <?php echo csrf_field(); ?>
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

<?php echo $__env->make('layouts.mainl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/maximoprandi/Documentos/Projects/Personal/praendi/resources/views/category.blade.php ENDPATH**/ ?>