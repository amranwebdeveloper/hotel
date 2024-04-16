<?php if(count($hotel_related) > 0): ?>
    <div class="bravo-list-hotel-related-widget  bravo-box-category-hotel">
        <h3 class="heading"><?php echo e(__("Related Hotel")); ?></h3>
        <div class="list-item owl-carousel">
            <?php $__currentLoopData = $hotel_related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $translation_item = $item->translateOrOrigin(app()->getLocale());
                ?>
                <div class="item-loop <?php echo e($wrap_class ?? ''); ?>">
                    <?php if($item->is_featured == '1'): ?>
                        <div class="featured">
                            <?php echo e(__('Featured')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="thumb-image ">
                        <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($item->getDetailUrl()); ?>">
                            <?php if($item->image_url): ?>
                                <?php if(!empty($disable_lazyload)): ?>
                                    <img src="<?php echo e($item->image_url); ?>" class="img-responsive" alt="">
                                <?php else: ?>
                                    <?php echo get_image_tag($item->image_id, 'medium', ['class' => 'img-responsive', 'alt' => $translation_item->title]); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                        <?php if($item->star_rate): ?>
                            <div class="star-rate">
                                <div class="list-star">
                                    <ul class="booking-item-rating-stars">
                                        <?php for($star = 1; $star <= $item->star_rate; $star++): ?>
                                            <li><i class="fa fa-star"></i></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="service-wishlist <?php echo e($item->isWishList()); ?>" data-id="<?php echo e($item->id); ?>"
                             data-type="<?php echo e($item->type); ?>">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    <div class="item-title">
                        <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($item->getDetailUrl()); ?>">
                            <?php if($item->is_instant): ?>
                                <i class="fa fa-bolt d-none"></i>
                            <?php endif; ?>
                            <?php echo clean($translation_item->title); ?>

                        </a>
                        <?php if($item->discount_percent): ?>
                            <div class="sale_info"><?php echo e($item->discount_percent); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="location">
                        <?php if(!empty($item->location->name)): ?>
                            <?php $location =  $item->location->translateOrOrigin(app()->getLocale()) ?>
                            <?php echo e($location->name ?? ''); ?>

                        <?php endif; ?>
                    </div>
                    <?php if(setting_item('hotel_enable_review')): ?>
                        <?php
                        $reviewData = $item->getScoreReview();
                        $score_total = $reviewData['score_total'];
                        ?>
                        <div class="service-review">
            <span class="rate">
                <?php if($reviewData['total_review'] > 0): ?>
                    <?php echo e($score_total); ?>/10
                <?php endif; ?> <span class="rate-text"><?php echo e($reviewData['review_text']); ?></span>
            </span>
                            <span class="review">
                <?php if($reviewData['total_review'] > 1): ?>
                                    <?php echo e(__(':number Reviews', ['number' => $reviewData['total_review']])); ?>

                                <?php else: ?>
                                    <?php echo e(__(':number Review', ['number' => $reviewData['total_review']])); ?>

                                <?php endif; ?>
            </span>
                        </div>
                    <?php endif; ?>
                    <div class="info">
                        <div class="g-price">
                            <div class="prefix">
                                <span class="fr_text"><?php echo e(__('from')); ?></span>
                            </div>
                            <div class="price">
                <span class="text-price"><?php echo e($item->display_price); ?> <span
                        class="unit"><?php echo e(__('/night')); ?></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="fp_footer">
                        <?php if(!empty(($category = $item->categories->first()))): ?>
                            <ul class="fp_meta float-left mb0">
                                <?php if($category->image_id): ?>
                                    <li class="list-inline-item"><a href="<?php echo e($category->getDetailUrl()); ?>"><img
                                                src="<?php echo e(\Modules\Media\Helpers\FileHelper::url($category->image_id)); ?>"
                                                alt="<?php echo e($category->name); ?>"></a></li>
                                <?php endif; ?>
                                <li class="list-inline-item"><a href="<?php echo e($category->getDetailUrl()); ?>"><?php echo e($category->name); ?></a>
                                </li>
                            </ul>
                        <?php endif; ?>
                        
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/details/hotel-related-list.blade.php ENDPATH**/ ?>