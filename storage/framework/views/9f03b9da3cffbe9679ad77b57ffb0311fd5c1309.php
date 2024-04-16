
<section class="container ">
    <div class="hotel-features" id="generalfeatures">
        <div class="row">
            <div class="col-md-9">
                <div class="comments">
                    <h6><?php echo e(__("User Comments")); ?></h6>
                    <div class="comment-title">
                        <div class="comments-number">
                            <?php if($row->getReviewEnable()): ?>
                                <?php if($review_score): ?>
                                        <div class="score">
                                            <?php echo e($review_score['score_total']); ?><span>/10</span>
                                        </div>
                                        <div class="right">
                                            <span class="head-rating"><?php echo e($review_score['score_text']); ?></span>
                                        </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="comment-detail-title">
                            <span class="text-rating"><?php echo e(__(":number Approved Guest reviews",['number'=>$review_score['total_review']])); ?></span>
                            <a href="#bravo-reviews"><?php echo e(__("All Comments")); ?> <i class="icofont-long-arrow-down"></i></a>
                        </div>
                    </div>
                    <div class="comments-detail">
                        <ul>
                        <?php if($review_list): ?>
                            <?php
                            $array = array();
                            foreach ($review_list as $item) {
                                if(!empty($metaReviews = $item->getReviewMeta())){
                                    $temp_array = array();
                                    foreach ($metaReviews as $key) {
                                        $temp_array[$key['name']] = $key['val'];
                                    }
                                    $array[] = $temp_array;
                                }
                            }

                            $averages = array();

                            foreach ($array as $rating) {
                                foreach ($rating as $key => $value) {
                                    if (!isset($averages[$key])) {
                                        $averages[$key] = array("count" => 0, "total" => 0);
                                    }
                                    $averages[$key]["count"]++;
                                    $averages[$key]["total"] += $value;
                                }
                            }

                            foreach ($averages as $key => $value) {
                                $average = $value["total"] / $value["count"];
                                echo "<li>";
                                     echo "<div class='comments-detail-icon'> </div>";
                                     echo "<div class='comments-detail-text'> $key - $average</div>";
                                echo "</li>";
                            }

                        ?>
                        <?php endif; ?>

                        </ul>
                    </div>
                    <div class="highlights">
                        <div class="g-all-attribute is_pc">
                            <?php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            ?>
                            <?php if(!empty($terms_ids) and !empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($attribute['parent']->slug) == 'highlights'): ?>
                                        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
                                        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
                                            <div class="g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
                                                <h3><?php echo e($translate_attribute->name); ?></h3>
                                                <?php $terms = $attribute['child'] ?>
                                                <div class="list-attributes">
                                                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $translate_term = $term->translateOrOrigin(app()->getLocale()) ?>
                                                        <div class="item <?php echo e($term->slug); ?> term-<?php echo e($term->id); ?>">
                                                            <?php if(!empty($term->image_id)): ?>
                                                                <?php $image_url = get_file_url($term->image_id, 'full'); ?>
                                                                <img src="<?php echo e($image_url); ?>" class="img-responsive" alt="<?php echo e($translate_term->name); ?>">
                                                            <?php else: ?>
                                                                <i class="<?php echo e($term->icon ?? "icofont-check-circled icon-default"); ?>"></i>
                                                            <?php endif; ?>
                                                            <?php echo e($translate_term->name); ?>

                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <a href="javascript:;" class="show-all-item" data-target="hotel-properties" style="display: none;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">See all</font></font><svg class="c-icon__svg c-icon--sm" style="transform: rotate(90deg);height: 10px"> <use xlink:href="/themes/tbweb/assets/images/sprite.svg#arrow-right"></use> </svg> </a> </div> </div>
            </div>
            <div class=" col-md-3 pl-md-0 ">
                <div class="location-information" id="location-information">
                    <h6><?php echo e(__("Location Information")); ?></h6>
                    <div class="location-maps " style="">
                        <img src="<?php echo e(URL('/')); ?>/uploads/demo/hotel/detail-maps.jpg" alt="">
                        <a href="#mapModal" data-toggle="modal" class="show-map maps"><i class="icofont-ui-map"></i><?php echo e(__("Show on map")); ?></a>

                        <div class="modal fade" id="mapModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo e($translation->address); ?></h4>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body g-location">
                                        <div class="location-map">
                                            <div id="map_content"></div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <span class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Close")); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="address" style="">
                       <?php if($translation->address): ?>
                           <?php echo clean($translation->title); ?> at <i class="fa fa-map-marker"></i> <?php echo e($translation->address); ?>

                       <?php endif; ?>
                   </div>
                    <div class="distance" id="distance-items">
                        <?php if ($__env->exists("Hotel::frontend.layouts.details.hotel-surrounding")) echo $__env->make("Hotel::frontend.layouts.details.hotel-surrounding", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/details/hotel-detail.blade.php ENDPATH**/ ?>