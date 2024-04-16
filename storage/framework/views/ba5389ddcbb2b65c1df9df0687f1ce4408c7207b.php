<?php if(!empty($location_category) and !empty($translation->surrounding)): ?>
	<div class="g-surrounding">
		<div class="location-title">
			<h3 class="mb-4"><?php echo e(__("What's Nearby")); ?></h3>
			<?php $__currentLoopData = $location_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($category)): ?>

                    <?php if(!empty($translation->surrounding[$category->id])): ?>
                        <?php $__currentLoopData = $translation->surrounding[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row mb-1">
                                <div class="col-lg-10">Distance to <?php echo e($item['name']); ?> </div>
                                <div class="col-lg-2"><?php echo e($item['value']); ?><?php echo e($item['type']); ?></div>
                                <?php if(!empty($item['content'])): ?>
                                    <div class="col-lg-12"<?php echo e($item['content']); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	<div class="bravo-hr"></div>
<?php endif; ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/details/hotel-surrounding.blade.php ENDPATH**/ ?>