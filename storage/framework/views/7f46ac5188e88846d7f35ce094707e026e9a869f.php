<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('libs/ion_rangeslider/css/ion.rangeSlider.min.css')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_detail_location">
        <section class="our-listing pb30-991"
            style="background: url('<?php echo e(get_file_url($row->banner_image_id, 'full')); ?>');background-size: cover;
            display: flex;
            align-items: center;
            height: 450px;
            background-position: center;">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb_content style2">
                            <h2 class="breadcrumb_title"><?php echo e($translation->name); ?></h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Homepage')); ?></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(url('/hotel-category')); ?>"><?php echo e(__('Category')); ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($translation->name); ?></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dn db-lg mt30 mb0 tac-767">
                            <div id="main2">
                                <span id="open2" class="fa fa-filter filter_open_btn style2">
                                    <?php echo e(__('Show Filter')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="listing_filter_row dif db-767">
                                

                            <?php if($rows->total() > 0): ?>

                                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-7">
                                    <div class="listing_list_style tac-767">
                                        <?php echo $__env->make('Hotel::frontend.layouts.search.orderby', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>


                            </div>
                        </div>

                        <div class="row">
                            <?php $layout = request()->query('layout') ?>
                            <?php if($rows->total() > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($layout == 'list'): ?>
                                        <div class="item-listting col-lg-12">
                                            <?php echo $__env->make('Hotel::frontend.layouts.search.loop-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="item-listting col-lg-6 col-md-6">
                                            <?php echo $__env->make('Hotel::frontend.layouts.search.loop-grid', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="col-lg-12">
                                    <div class="border rounded p-3 bg-white">
                                        <?php echo e(__('Hotel not found')); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-lg-12 mt20">
                                <div class="mbp_pagination">
                                    <?php echo e($rows->appends(request()->query())->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>


    <script type="text/javascript" src="<?php echo e(asset('libs/ion_rangeslider/js/ion.rangeSlider.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('libs/sticky/jquery.sticky.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/category/detail.blade.php ENDPATH**/ ?>