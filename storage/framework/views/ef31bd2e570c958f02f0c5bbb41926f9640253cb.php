<?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $translate = $attribute->translateOrOrigin(app_get_locale()); ?>
    <div class="panel">
        <div class="panel-title"><strong><?php echo e(__('Attribute: :name',['name'=>$translate->name])); ?></strong></div>
        <div class="panel-body">
            <div class="terms-scrollable">
                <table>
                    <tr><th>Active</th><th>Terms</th><th>Paid</th></tr>
                <?php $__currentLoopData = $attribute->terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $term_translate = $term->translateOrOrigin(app_get_locale()); ?>
                    <tr class="term-item">
                        <td><input <?php if(!empty($selected_terms) and $selected_terms->contains($term->id)): ?> checked <?php endif; ?> type="checkbox" name="terms[]" value="<?php echo e($term->id); ?>"></td>
                        <td><?php echo e($term->id); ?>:<span class="term-name"><?php echo e($term_translate->name); ?></span></td>
                        <td>
                            <?php
                                $hotel_terms = \Modules\Hotel\Models\HotelTerm::where('target_id', $row->id)->where('term_id',$term->id)->first();
                            ?>
                            <?php if(!empty($hotel_terms->paid_service)): ?> <?php echo e($hotel_terms->paid_service); ?>  <?php endif; ?>
                            <select name="paid_service[]">
                              <option value="1" <?php if(!empty($hotel_terms->paid_service) and ($hotel_terms->paid_service==1)): ?> selected <?php endif; ?>> Yes</option>
                              <option value="0" <?php if(!empty($hotel_terms->paid_service) and ($hotel_terms->paid_service==0)): ?> selected <?php endif; ?>>No</option>
                            </select>
                        </td> 
                    </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/admin/hotel/attributes.blade.php ENDPATH**/ ?>