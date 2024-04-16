<?php if($list_item): ?>
    <div class="bravo-box-category-hotel">
        <div class="container">
            <?php if($title): ?>
                <div class="title">
                    <?php echo e($title); ?>

                </div>
            <?php endif; ?>
            <?php if(!empty($desc)): ?>
                <div class="desc">
                    <?php echo e($desc); ?>

                </div>
            <?php endif; ?>
            <div class="list-item">
                        

                <div class="form-group">
                    <ul class="nav nav-tabs">
                     <?php $count=1; ?>
                    <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) )): ?>
                            <?php
                                $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );
                            ?>
                        <li class="nav-item">
                            <a class="nav-link  <?php if($count==1): ?> active <?php endif; ?>" data-toggle="tab" href="#<?php echo e($item_cat->slug); ?>"><?php echo e($translate->name); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php $count++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content" >
                        <?php $count=1; ?>
                        <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) )): ?>
                                <?php
                                    $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                    $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );
                                ?>

                        <div class="tab-pane <?php if($count==1): ?> active <?php endif; ?>" id="<?php echo e($item_cat->slug); ?>">
                            <a href="<?php echo e(url('/')); ?>/hotel-category/<?php echo e($item_cat->slug); ?>" class="category_url"> <?php echo e(__("Show More")); ?></a>
                            <div class="list-item owl-carousel">
                                <?php
                                    $hotels = \Modules\Hotel\Models\Hotel::where('status','publish')->where('category_id',$item_cat->id)->get();
                                ?>

                                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item-loop <?php echo e($wrap_class ?? ''); ?>">
                                        <?php if($row->is_featured == "1"): ?>
                                            <div class="featured">
                                                <?php echo e(__("Featured")); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="thumb-image ">
                                            <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($row->getDetailUrl()); ?>">
                                                <?php if($row->image_url): ?>
                                                    <?php if(!empty($disable_lazyload)): ?>
                                                        <img src="<?php echo e($row->image_url); ?>" class="img-responsive" alt="">
                                                    <?php else: ?>
                                                        <?php echo get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$row->title]); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </a>
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
                                            <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                        </div>
                                        <div class="item-title">
                                            <a <?php if(!empty($blank)): ?> target="_blank" <?php endif; ?> href="<?php echo e($row->getDetailUrl()); ?>">
                                                <?php if($row->is_instant): ?>
                                                    <i class="fa fa-bolt d-none"></i>
                                                <?php endif; ?>
                                                    <?php echo clean($row->title); ?>

                                            </a>
                                            <?php if($row->discount_percent): ?>
                                                <div class="sale_info"><?php echo e($row->discount_percent); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="location">
                                            <?php if(!empty($row->location->name)): ?>
                                                <?php $location =  $row->location->translateOrOrigin(app()->getLocale()) ?>
                                                <?php echo e($location->name ?? ''); ?>

                                            <?php endif; ?>
                                        </div>
                                        <?php if(setting_item('hotel_enable_review')): ?>
                                        <?php
                                        $reviewData = $row->getScoreReview();
                                        $score_total = $reviewData['score_total'];
                                        ?>
                                        <div class="service-review">
                                            <span class="rate">
                                                <?php if($reviewData['total_review'] > 0): ?> <?php echo e($score_total); ?>/10 <?php endif; ?> <span class="rate-text"><?php echo e($reviewData['review_text']); ?></span>
                                            </span>
                                            <span class="review">
                                                <?php if($reviewData['total_review'] > 1): ?>
                                                    <?php echo e(__(":number Reviews",["number"=>$reviewData['total_review'] ])); ?>

                                                <?php else: ?>
                                                    <?php echo e(__(":number Review",["number"=>$reviewData['total_review'] ])); ?>

                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                        <div class="info">
                                            <div class="g-price">
                                                <div class="prefix">
                                                    <span class="fr_text"><?php echo e(__("from")); ?></span>
                                                </div>
                                                <div class="price">
                                                    <span class="text-price"><?php echo e($row->display_price); ?> <span class="unit"><?php echo e(__("/night")); ?></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\hotel\modules/Hotel/Views/frontend/blocks/box-category-hotel/index.blade.php ENDPATH**/ ?>