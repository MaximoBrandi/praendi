<?php $__env->startSection('content'); ?>
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
                                <li><a href="/category/<?php echo e($post->category); ?>"><i class="fa fa-user"></i> <?php echo e($post->category); ?></a></li>
                                <li><a href="/profile/<?php echo e($post->user->id); ?>"><i class="fa fa-user"></i> <?php echo e($post->user->profile->name); ?></a></li>
                                <li><a href="javascript:;"><i class="fa fa-comments"></i> <?php echo e($post->comments->count()); ?> Comments</a></li>
                            </ul>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $paginatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="<?php echo e($post->image); ?>" width="750px" height="375px" alt="">
                            <a href="/category/<?php echo e($post->category); ?>" class="blog_item_date">
                                <h3><?php echo e($post->category); ?></h3>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="/post/<?php echo e($post->id); ?>">
                                <h2><?php echo e($post->title); ?></h2>
                            </a>
                            <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                he earth it first without heaven in place seed it second morning saying.</p>
                            <ul class="blog-info-link">
                                <li><a href="javascript:;"><i class="fa fa-calendar"></i> <?php echo e($post->created_at->day); ?>  <?php echo e(date("F", mktime(0, 0, 0, $post->created_at->month, 1))); ?> <?php echo e($post->created_at->year); ?></a></li>
                                <li><a href="/profile/<?php echo e($post->user->id); ?>"><i class="fa fa-user"></i> <?php echo e($post->user->profile->name); ?></a></li>
                                <li><a href="javascript:;"><i class="fa fa-comments"></i> <?php echo e($post->comments->count()); ?> Comments</a></li>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/maximoprandi/Documentos/Projects/Personal/praendi/resources/views/category.blade.php ENDPATH**/ ?>