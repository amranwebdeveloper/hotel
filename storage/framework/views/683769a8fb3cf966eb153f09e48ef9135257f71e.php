<?php if($list_item): ?>
    <div class="bravo-featured-item <?php echo e($style ?? ''); ?>">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $image_url = get_file_url($item['icon_image'], 'full'); ?>
                    <div class="col-md-4">
                        <div class="featured-item">
                            <?php if($style == 'style4'): ?>
                            <a href="<?php echo e($item['target_link']); ?>" alt="<?php echo e($item['title']); ?>">
                                <div class="content">
                                    <h3 class="title">
                                        <?php echo e($item['title']); ?>

                                    </h3>
                                    <div class="desc"><?php echo clean($item['sub_title']); ?></div>
                                </div>
                                <div class="image">
                                    <?php if(!empty($style) and $style == 'style2'): ?>
                                        <span class="number-circle"><?php echo e($k + 1); ?></span>
                                    <?php else: ?>
                                        <img src="<?php echo e($image_url); ?>" class="img-fluid" alt="<?php echo e($item['title']); ?>">
                                    <?php endif; ?>
                                </div>
                            </a>
                            <?php else: ?>
                                <div class="image">
                                    <?php if(!empty($style) and $style == 'style2'): ?>
                                        <span class="number-circle"><?php echo e($k + 1); ?></span>
                                    <?php else: ?>
                                        <img src="<?php echo e($image_url); ?>" class="img-fluid" alt="<?php echo e($item['title']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="content">
                                    <h3 class="title">
                                        <?php echo e($item['title']); ?>

                                    </h3>
                                    <div class="desc"><?php echo clean($item['sub_title']); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\hotel\modules/Tour/Views/frontend/blocks/list-featured-item/index.blade.php ENDPATH**/ ?>