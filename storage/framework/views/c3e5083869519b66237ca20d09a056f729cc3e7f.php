<?php
    $translation = $row->translateOrOrigin(app()->getLocale());
?>
<div class="hotel-card">
    <div class="item-loop-list <?php echo e($wrap_class ?? ''); ?>">
        <?php if($row->is_featured == "1"): ?>
            <div class="featured">
                <?php echo e(__("Featured")); ?>

            </div>
        <?php endif; ?>
        <div class="thumb-image">
            <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($row->getDetailUrl()); ?>">
                <?php if($row->image_url): ?>
                    <?php if(!empty($disable_lazyload)): ?>
                        <img src="<?php echo e($row->image_url); ?>" class="img-responsive" alt="">
                    <?php else: ?>
                        <?php echo get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$translation->title]); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </a>
            <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                <i class="fa fa-heart"></i>
            </div>
        </div>
        <div class="g-info">
            <?php if($row->star_rate): ?>
                <div class="star-rate">
                    <div class="list-star">
                        <ul class="booking-item-rating-stars">
                            <?php for($star = 1 ;$star <= $row->star_rate ; $star++): ?>
                                <li><i class="fa fa-star"></i></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <div class="item-title">
                <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($row->getDetailUrl()); ?>">
                    <?php if($row->is_instant): ?>
                        <i class="fa fa-bolt d-none"></i>
                    <?php endif; ?>
                        <?php echo clean($translation->title); ?> - 


                <?php if(!empty($row->location->name)): ?>
                    <?php $location =  $row->location->translateOrOrigin(app()->getLocale()) ?>
                    <i class="icofont-paper-plane"></i>
                    <?php echo e($location->name ?? ''); ?>

                <?php endif; ?>




                </a>
            </div>
            <?php
    $terms_ids = $row->terms->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
?>
<?php if(!empty($terms_ids) and !empty($attributes)): ?>
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
            <?php $terms = $attribute['child'];
            $count=1;
            ?>
            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $translate_term = $term->translateOrOrigin(app()->getLocale());
                if($count<6) {
                ?>
                <span class="item <?php echo e($term->slug); ?> term-<?php echo e($term->id); ?>">
                    <?php if(!empty($term->image_id)): ?>
                        <?php $image_url = get_file_url($term->image_id, 'full'); ?>
                        <img src="<?php echo e($image_url); ?>" class="img-responsive" alt="<?php echo e($translate_term->name); ?>">
                    <?php else: ?>
                        <i class="<?php echo e($term->icon ?? "icofont-check-circled icon-default"); ?>"></i>
                    <?php endif; ?>
                    <?php echo e($translate_term->name); ?>

                </span>
            <?php
                }
            $terms = $attribute['child'];
            $count++;
            ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

            

        </div>
        <div class="g-rate-price">
            <?php if(setting_item('hotel_enable_review')): ?>
                <?php  $reviewData = $row->getScoreReview(); ?>
                <div class="service-review-pc">
                    <div class="head">
                        <div class="left">
                            <span class="head-rating"><?php echo e($reviewData['review_text']); ?></span>
                            <span class="text-rating"><?php echo e(__(":number reviews",['number'=>$reviewData['total_review']])); ?></span>
                        </div>
                        <div class="score">
                            <?php echo e($reviewData['score_total']); ?><span>/10</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="g-price">
                <div class="prefix">
                    <span class="fr_text"><?php echo e(__("from")); ?></span>
                </div>
                <div class="price">
                    <span class="text-price"><?php echo e($row->display_price); ?> <span class="unit"><?php echo e(__("/night")); ?></span></span>
                </div>
                <?php if(!empty($reviewData['total_review'])): ?>
                    <div class="text-review">
                        <?php echo e(__(":number reviews",['number'=>$reviewData['total_review']])); ?>

                    </div>
                <?php endif; ?>



            </div>

        </div>

            
    </div>
    <div class="item-loop-footer">
        <div class="item-loop-footer-left">
            <div class="item-loop-footer-features" data-toggle="tooltip" data-title="#kalitelitatil için bu oteli TatilBenim olarak öneriyoruz" data-original-title="" title=""><strong><i class="icofont-travelling"></i> Tatilbenim.com Öneriyor</strong></div>
            <div class="item-loop-footer-features"> 6 month postponement opportunity</div>
            <div class="item-loop-footer-features" data-toggle="tooltip" data-placement="bottom" data-title="Satın aldığınız rezervasyonunuzun 4'te 1'ini şimdi, kalanını 7 gün kalaya kadar ödeme fırsatını yakalayın." ><i class="icofont-pie-chart"></i> Pay 1 out of 4 now</div>
        </div>
        <div class="item-loop-footer-right">
            <a type="button" href="" title="Make a Reservation" class="btn btn-reservation"><?php echo e(__("Make a Reservation")); ?></a>
        </div>
    </div>
</div>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/search/loop-list.blade.php ENDPATH**/ ?>