<?php if($list_item): ?>
    <div class="bravo-how-it-works" style="background-image: linear-gradient(0deg,rgba(255, 255, 255, 0.2),rgba(255, 255, 255, 0.2)),url('<?php echo e(get_file_url($background_image ?? "","full")); ?>') !important">
        <div class="container">
            <div class="row">
                <div class="col-md-4 bravo-how-it-works-title">
                    <div class="title">
                        <?php echo e($title); ?>

                    </div>
                </div>
                <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                    <div class="col-md-4 ">
                        <div class="featured-item">
                            <div class="image">
                                <?php if(!empty($style) and $style == 'style2'): ?>
                                    <span class="number-circle"><?php echo e($k+1); ?></span>
                                <?php else: ?>
                                    <img src="<?php echo e($image_url); ?>" class="img-fluid">
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <h4 class="sub-title">
                                    <?php echo e($item['title']); ?>

                                </h4>
                                <div class="desc">
                                    <?php if(strlen($item['sub_title']) > 200): ?>
                                    <?php echo clean(substr($item['sub_title'],0,200)); ?>

                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                    <span class="read-more-content">  <?php echo clean(substr($item['sub_title'],200,strlen($item['sub_title']))); ?>

                                    <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                    <?php else: ?>
                                    <?php echo clean($item['sub_title']); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Template/Views/frontend/blocks/how-it-work/index.blade.php ENDPATH**/ ?>