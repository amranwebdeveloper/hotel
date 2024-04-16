{{-- GUNEY --}}
<section class="container ">
    <div class="hotel-features" id="generalfeatures">
        <div class="row">
            <div class="col-md-9">
                <div class="comments">
                    <h6>{{__("User Comments")}}</h6>
                    <div class="comment-title">
                        <div class="comments-number">
                            @if($row->getReviewEnable())
                                @if($review_score)
                                        <div class="score">
                                            {{$review_score['score_total']}}<span>/10</span>
                                        </div>
                                        <div class="right">
                                            <span class="head-rating">{{$review_score['score_text']}}</span>
                                        </div>
                                @endif
                            @endif
                        </div>
                        <div class="comment-detail-title">
                            <span class="text-rating">{{__(":number Approved Guest reviews",['number'=>$review_score['total_review']])}}</span>
                            <a href="#bravo-reviews">{{__("All Comments")}} <i class="icofont-long-arrow-down"></i></a>
                        </div>
                    </div>
                    <div class="comments-detail">
                        <ul>
                        @if($review_list)
                            @php
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

                        @endphp
                        @endif

                        </ul>
                    </div>
                    <div class="highlights">
                        <div class="g-all-attribute is_pc">
                            @php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            @endphp
                            @if(!empty($terms_ids) and !empty($attributes))
                                @foreach($attributes as $key => $attribute )
                                    @if(($attribute['parent']->slug) == 'highlights')
                                        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
                                        @if(empty($attribute['parent']['hide_in_single']))
                                            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
                                                <h3>{{ $translate_attribute->name }}</h3>
                                                @php $terms = $attribute['child'] @endphp
                                                <div class="list-attributes">
                                                    @foreach($terms as $term )
                                                        @php $translate_term = $term->translateOrOrigin(app()->getLocale()) @endphp
                                                        <div class="item {{$term->slug}} term-{{$term->id}}">
                                                            @if(!empty($term->image_id))
                                                                @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                                                                <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                                                            @else
                                                                <i class="{{ $term->icon ?? "icofont-check-circled icon-default" }}"></i>
                                                            @endif
                                                            {{$translate_term->name}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <a href="javascript:;" class="show-all-item" data-target="hotel-properties" style="display: none;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">See all</font></font><svg class="c-icon__svg c-icon--sm" style="transform: rotate(90deg);height: 10px"> <use xlink:href="/themes/tbweb/assets/images/sprite.svg#arrow-right"></use> </svg> </a> </div> </div>
            </div>
            <div class=" col-md-3 pl-md-0 ">
                <div class="location-information" id="location-information">
                    <h6>{{__("Location Information")}}</h6>
                    <div class="location-maps " style="">
                        <img src="{{ URL('/')}}/uploads/demo/hotel/detail-maps.jpg" alt="">
                        <a href="#mapModal" data-toggle="modal" class="show-map maps"><i class="icofont-ui-map"></i>{{__("Show on map")}}</a>

                        <div class="modal fade" id="mapModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{$translation->address}}</h4>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body g-location">
                                        <div class="location-map">
                                            <div id="map_content"></div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <span class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="address" style="">
                       @if($translation->address)
                           {!! clean($translation->title) !!} at <i class="fa fa-map-marker"></i> {{$translation->address}}
                       @endif
                   </div>
                    <div class="distance" id="distance-items">
                        @includeIf("Hotel::frontend.layouts.details.hotel-surrounding")
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--@if($translation->content)--}}
{{--    <div class="g-overview">--}}
{{--        <h3>{{__("Description")}}</h3>--}}
{{--        <div class="description">--}}
{{--            <?php echo $translation->content ?>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

