
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <?php if(!empty($row->category_hotel->name)): ?>
                <?php $cat =  $row->category_hotel->translateOrOrigin(app()->getLocale()) ?>
                <div class="info">
                    <a class="value" href="<?php echo e(url('/').'/category'); ?>/<?php echo e($row->category_hotel->slug ?? ''); ?>"><i class="icofont-long-arrow-left"></i> <?php echo e(__("Back to search results")); ?> - <?php echo e($cat->name ?? ''); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pr-md-1 pb-md-1 pt-md-1">
            <?php if($row->video): ?>
                <iframe class="bravo_embed_video" src="<?php echo e(handleVideoUrl($row->video)); ?>" allowscriptaccess="always" frameBorder="0" allow="autoplay" width="100%" height="350px"></iframe>
            <?php endif; ?>
        </div>
        <div class="col-md-6 pl-md-0 pb-md-1 pt-md-1">
            <?php if($row->getGallery()): ?>
                <div class="g-gallery">
                    <div class="fotorama" data-width="100%" data-thumbwidth="80" data-thumbheight="80" data-thumbmargin="5" data-nav="thumbs" data-allowfullscreen="true">
                        <?php $__currentLoopData = $row->getGallery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($item['large']); ?>" data-thumb="<?php echo e($item['thumb']); ?>" data-alt="<?php echo e(__("Gallery")); ?>"></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="social">
                        <div class="social-share">
                            <span class="social-icon">
                                <i class="icofont-share"></i>
                            </span>
                            <ul class="share-wrapper">
                                <li>
                                    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Facebook")); ?>">
                                        <i class="fa fa-facebook fa-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter" href="https://twitter.com/share?url=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Twitter")); ?>">
                                        <i class="fa fa-twitter fa-lg"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                            <i class="fa fa-heart-o"></i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>














































<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/details/hotel-banner.blade.php ENDPATH**/ ?>