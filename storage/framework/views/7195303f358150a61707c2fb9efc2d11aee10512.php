<div class="mailchimp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12  col-md-4">
                <div class="media ">
                    <img class=" " alt="<?php echo e($title); ?>" src="<?php echo e(get_file_url($background_image ?? "","full")); ?>">
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="newsletter-content">
                    <h4 class="media-heading"><?php echo e($title); ?></h4>
                    <form action="<?php echo e(route('newsletter.subscribe')); ?>" class="subcribe-form bravo-subscribe-form bravo-form">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control email-input" placeholder="<?php echo e(__('Your Email')); ?>">
                            <button type="submit" class="btn-submit"><?php echo e(__('Subscribe')); ?>

                                <i class="fa fa-spinner fa-pulse fa-fw"></i>
                            </button>
                        </div>
                        <div class="form-mess"></div>
                    </form>
                    <p><?php echo clean($sub_title); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Template/Views/frontend/blocks/subscriber-block/index.blade.php ENDPATH**/ ?>