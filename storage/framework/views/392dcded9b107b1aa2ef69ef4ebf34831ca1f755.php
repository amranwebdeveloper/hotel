<?php if(!empty($list_item)): ?>
    <div class="bravo-offer-slider">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="owl-carousel">
                        <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item['short_offer']==0): ?>
                            <div class="item-loop">
                                <div class="thumb-image ">
                                    <a target="_blank" href="<?php echo e($item['link_more']); ?>">
                                        <img src="<?php echo e(get_file_url($item['background_image'],'full') ?? ""); ?>" class="img-responsive" alt="">
                                    </a>
                                </div>
                                <div class="slider-text">
                                    <?php if(!empty($item['featured_text'])): ?>
                                        <div class="featured-text"><?php echo e($item['featured_text']); ?></div>
                                    <?php endif; ?>
                                    <?php if(!empty($item['featured_icon'])): ?>
                                        <div class="featured-icon"><i class="<?php echo e($item['featured_icon']); ?>"></i></div>
                                    <?php endif; ?>
                                    <a target="_blank" href="<?php echo e($item['link_more']); ?>">
                                        <h2 class="item-title"><?php echo e($item['title']); ?></h2>
                                        <p class="item-sub-title"><?php echo $item['desc']; ?></p>
                                    </a>
                                    <a href="<?php echo e($item['link_more']); ?>" class="btn btn-default"><?php echo e($item['link_title']); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item['short_offer']==1): ?>
                        <div class="short_offer">
                            <div class="short_offer_text">
                                <a target="_blank" href="<?php echo e($item['link_more']); ?>">
                                    <h2 class="item-title"><?php echo e($item['title']); ?></h2> 
                                </a>
                                <a href="<?php echo e($item['link_more']); ?>" class="btn btn-default"><?php echo e($item['link_title']); ?></a>
                            </div>
                            <div class="short_offer_image ">
                                <a target="_blank" href="<?php echo e($item['link_more']); ?>">
                                    <img src="<?php echo e(get_file_url($item['background_image'],'full') ?? ""); ?>" class="img-responsive" alt="">
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Template/Views/frontend/blocks/offer-slider/index.blade.php ENDPATH**/ ?>