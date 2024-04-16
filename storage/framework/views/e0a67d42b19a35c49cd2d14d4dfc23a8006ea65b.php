<?php if($list_item): ?>
    <div class="bravo-hotel-category-thumbnail">
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
            <div class="row">
                <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $image_url = get_file_url($item['image_id'], 'full'); ?>
                        <?php if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) )): ?>
                            <?php
                                $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );

                                $hotels =  DB::table('bravo_hotel_category_relationships')->where('category_id',$item_cat->id)->get();
                            ?>
                            <div class="col-md-2 loop-item">
                                <div class="item">
                                    <a href="<?php echo e(url('/').'/hotel-category'); ?>/<?php echo e($item_cat->slug); ?>">
                                        <img src="<?php echo e($image_url); ?>" alt="<?php echo e($translate->name); ?>">
                                        <span class="text-title"><?php echo e($translate->name); ?>

                                            <span class="hotel-count"><?php if(count($hotels)>1): ?> <?php echo e(count($hotels)); ?> Hotels <?php elseif(count($hotels)==1): ?> 1 Hotel <?php else: ?> 0 Hotel <?php endif; ?>  </span>

                                        </span>
                                      </a>
                                </div>
                            </div>
                        <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-2 last loop-item">
                    <div class="item">
                        <a href="<?php echo e(url('/').'/hotel-category'); ?>">
                            <div class="icon">
                                <i class="icofont-rounded-double-right"></i>
                            </div>
                            <span class="last-text-title">See all</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\hotel\modules/Hotel/Views/frontend/blocks/hotel-category-thumbnail/index.blade.php ENDPATH**/ ?>