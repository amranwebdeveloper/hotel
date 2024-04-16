<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('dist/frontend/module/hotel/css/hotel.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/fotorama/fotorama.css")); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_detail_hotel">
        <?php echo $__env->make('Layout::parts.bc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_content hotel-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-md-12">
                        <div class="g-header">
                            <div class="left">
                                <?php if($row->star_rate): ?>
                                    <div class="star-rate">
                                        <?php for($star = 1 ;$star <= $row->star_rate ; $star++): ?>
                                            <i class="fa fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                                <h1><?php echo clean($translation->title); ?></h1>

                                <?php if(!empty($row->institutional_hotel->name)): ?>
                                    <?php $institute =  $row->institutional_hotel->translateOrOrigin(app()->getLocale()) ?>
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="icon">
                                                <i class="icofont-beach"></i>
                                            </div>
                                            <div class="info">
                                                <p class="value">
                                                    <?php echo e(__("Hotel Type")); ?>: <?php echo e($institute->name ?? ''); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="right">
                                <div class="social">
                                    <div class="social-share">
                <span class="social-icon">
                    <i class="icofont-share"></i>
                </span>
                                        <ul class="share-wrapper">
                                            <li>
                                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Facebook")); ?>">
                                                    <i class="fa fa-facebook fa-lg"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter" href="https://twitter.com/share?url=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Twitter")); ?>">
                                                    <i class="fa fa-twitter fa-lg"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                                        <i class="fa fa-heart-o"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!empty($row->duration) or !empty($row->category_hotel->name) or !empty($row->max_people) or !empty($row->location->name)): ?>
                    <div class="g-hotel-feature" id="hotelNav">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-md-12">
                                <ul class="tabs akb-bg-none">
                                    <li class="tab ">
                                        <a href="#generalfeatures" class="active"><?php echo e(__('General features')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#rooms" class=""><?php echo e(__('Rooms_new')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#FacilityActivities" class=""><?php echo e(__('Facility Activities')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#PoolandBeach" class=""><?php echo e(__('Pool and Beach')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#ConceptFeatures" class=""><?php echo e(__('Concept Features')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#ImportantNotes" class=""><?php echo e(__('Important notes')); ?></a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#Reviews" class=""><?php echo e(__('Reviews')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <?php $review_score = $row->review_data ?>
                        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo_content" id="rooms">
        <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-rooms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="campaign" id="campaign">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-sale-discount"></i>
                            <?php echo e(__('Institutions')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <?php if(!empty($row->institutions) && count($row->institutions) > 0): ?>
                            <div class="sidebar_institutional_widget">
                                <ul class="mb0">
                                    <?php $__currentLoopData = $row->institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institutional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e(count($row->institutions) - 1 != $key ? 'mb25' : ''); ?>">
                                            <a data-toggle="modal" data-target="#modal-<?php echo e($institutional->slug); ?>">
                                                <?php if($institutional->icon_image_id): ?>
                                                    <img class="mr5" src="<?php echo e(\Modules\Media\Helpers\FileHelper::url($institutional->icon_image_id)); ?>" alt="<?php echo e($institutional->name); ?>">
                                                <?php endif; ?>
                                            </a><br>
                                            <?php echo e($institutional->name); ?>

                                            <?php echo e($institutional->title); ?><br>
                                            <a class="" data-toggle="modal" data-target="#modal-<?php echo e($institutional->slug); ?>">
                                                <i class="fa fa-info-circle"></i> <?php echo e(__("Campaign Terms")); ?>

                                            </a>
                                            <div class="modal fade" id="modal-<?php echo e($institutional->slug); ?>">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo e($institutional->name); ?></h4>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <?php if($institutional->icon_image_id): ?>
                                                                <img class="mr5" src="<?php echo e(\Modules\Media\Helpers\FileHelper::url($institutional->icon_image_id)); ?>" alt="<?php echo e($institutional->name); ?>">
                                                            <?php endif; ?>
                                                            <?php echo e($institutional->title); ?>

                                                            <?php echo $institutional->content; ?>

                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <span class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Close")); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign" id="FacilityActivities">
            <div class="container">
                <?php if(isset($row->general_features)): ?>
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-5-star-hotel"></i>
                            <?php echo e(__('General features')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <?php echo $row->general_features; ?>

                        <div class="g-all-attribute is_pc">
                            <?php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            ?>
                            <?php if(!empty($terms_ids) and !empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($attribute['parent']->slug) == 'general-features'): ?>
                                        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
                                        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
                                            <div class="g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                <?php endif; ?>
                <hr>
                <?php if(isset($row->facility_activities)): ?>
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-runner-alt-1"></i>
                            <?php echo e(__('Facility Activities')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <?php echo $row->facility_activities; ?>

                        <div class="g-all-attribute is_pc">
                            <?php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            ?>
                            <?php if(!empty($terms_ids) and !empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($attribute['parent']->slug) == 'facility-activities'): ?>
                                        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
                                        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
                                            <div class="g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    <?php endif; ?>
                    <?php if(isset($row->pool_and_beach)): ?>
                <div class="row" id="PoolandBeach">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-beach-bed"></i>
                            <?php echo e(__('Pool and Beach')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <?php echo $row->pool_and_beach; ?>

                        <div class="g-all-attribute is_pc">
                            <?php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            ?>
                            <?php if(!empty($terms_ids) and !empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($attribute['parent']->slug) == 'pool-and-beach'): ?>
                                        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
                                        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
                                            <div class="g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    <?php endif; ?>
                    <?php if(isset($row->honeymoon)): ?>
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-love"></i>
                            <?php echo e(__('Honeymoon')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <?php echo $row->honeymoon; ?>

                        <div class="g-all-attribute is_pc">
                            <?php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            ?>
                            <?php if(!empty($terms_ids) and !empty($attributes)): ?>
                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($attribute['parent']->slug) == 'honeymoon'): ?>
                                        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
                                        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
                                            <div class="g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    <?php endif; ?>
                    <?php if(isset($row->concept_features)): ?>
                        <div class="row" id="ConceptFeatures">
                            <div class="col-md-3 ">
                                <h4 class="title mb30"> <i class="icofont-checked"></i>
                                    <?php echo e(__('Concept Features')); ?></h4>
                            </div>
                            <div class="col-md-9 ">
                                <?php echo $row->concept_features; ?>

                            </div>
                        </div>
                        <hr>
                    <?php endif; ?>
                    <?php if(isset($row->important_notes)): ?>
                        <div class="row" id="ImportantNotes">
                            <div class="col-md-3 ">
                                <h4 class="title mb30"><i class="icofont-book-alt"></i>
                                    <?php echo e(__('Important Notes')); ?></h4>
                            </div>
                            <div class="col-md-9 ">
                                <?php echo $row->important_notes; ?>

                            </div>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
        <div class="campaign" id="campaign">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><?php echo e(__('Rules')); ?></h4>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="key"><?php echo e(__("Check In")); ?></div>
                            </div>
                            <div class="col-lg-8">
                                <div class="value">	<?php echo e($row->check_in_time); ?> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="key"><?php echo e(__("Check Out")); ?></div>
                            </div>
                            <div class="col-lg-8">
                                <div class="value">	<?php echo e($row->check_out_time); ?> </div>
                            </div>
                        </div>
                        <?php if($translation->policy): ?>
                            <div class="key"><?php echo e(__("Hotel Policies")); ?></div>
                            <?php $__currentLoopData = $translation->policy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item <?php if($key > 1): ?> d-none <?php endif; ?>">
                                    <div class="strong"><?php echo e($item['title']); ?></div>
                                    <div class="context"><?php echo $item['content']; ?></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if( count($translation->policy) > 2): ?>
                                <div class="btn-show-all">
                                    <span class="text"><?php echo e(__("Show All")); ?></span>
                                    <i class="fa fa-caret-down"></i>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo_content">
            <div class="container">
                <div class="bravo-hr"></div>
                <div id="Reviews">
                <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-form-enquiry-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-form-enquiry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

















                <?php echo $__env->make('Hotel::frontend.layouts.details.hotel-related-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        jQuery(function ($) {
            <?php if($row->map_lat && $row->map_lng): ?>
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>],
                zoom:<?php echo e($row->map_zoom ?? "8"); ?>,
                ready: function (engineMap) {
                    engineMap.addMarker([<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>], {
                        icon_options: {
                            iconUrl:"<?php echo e(get_file_url(setting_item("hotel_icon_marker_map"),'full') ?? url('images/icons/png/pin.png')); ?>"
                        }
                    });
                }
            });
            <?php endif; ?>
        })
    </script>
    <script>
        var bravo_booking_data = <?php echo json_encode($booking_data); ?>

        var bravo_booking_i18n = {
			no_date_select:'<?php echo e(__('Please select Start and End date')); ?>',
            no_guest_select:'<?php echo e(__('Please select at least one guest')); ?>',
            load_dates_url:'<?php echo e(route('space.vendor.availability.loadDates')); ?>',
            name_required:'<?php echo e(__("Name is Required")); ?>',
            email_required:'<?php echo e(__("Email is Required")); ?>',
        };
    </script>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/fotorama/fotorama.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/sticky/jquery.sticky.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/hotel/js/single-hotel.js?_ver='.config('app.asset_version'))); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/detail.blade.php ENDPATH**/ ?>