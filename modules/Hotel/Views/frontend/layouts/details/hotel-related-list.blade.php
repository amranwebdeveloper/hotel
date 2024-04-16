@if(count($hotel_related) > 0)
    <div class="bravo-list-hotel-related-widget  bravo-box-category-hotel">
        <h3 class="heading">{{__("Related Hotel")}}</h3>
        <div class="list-item owl-carousel">
            @foreach($hotel_related as $k=>$item)
                @php
                    $translation_item = $item->translateOrOrigin(app()->getLocale());
                @endphp
                <div class="item-loop {{ $wrap_class ?? '' }}">
                    @if ($item->is_featured == '1')
                        <div class="featured">
                            {{ __('Featured') }}
                        </div>
                    @endif
                    <div class="thumb-image ">
                        <a @if (!empty($blank)) target="_blank" @endif href="{{ $item->getDetailUrl() }}">
                            @if ($item->image_url)
                                @if (!empty($disable_lazyload))
                                    <img src="{{ $item->image_url }}" class="img-responsive" alt="">
                                @else
                                    {!! get_image_tag($item->image_id, 'medium', ['class' => 'img-responsive', 'alt' => $translation_item->title]) !!}
                                @endif
                            @endif
                        </a>
                        @if ($item->star_rate)
                            <div class="star-rate">
                                <div class="list-star">
                                    <ul class="booking-item-rating-stars">
                                        @for ($star = 1; $star <= $item->star_rate; $star++)
                                            <li><i class="fa fa-star"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="service-wishlist {{ $item->isWishList() }}" data-id="{{ $item->id }}"
                             data-type="{{ $item->type }}">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    <div class="item-title">
                        <a @if (!empty($blank)) target="_blank" @endif href="{{ $item->getDetailUrl() }}">
                            @if ($item->is_instant)
                                <i class="fa fa-bolt d-none"></i>
                            @endif
                            {!! clean($translation_item->title) !!}
                        </a>
                        @if ($item->discount_percent)
                            <div class="sale_info">{{ $item->discount_percent }}</div>
                        @endif
                    </div>
                    <div class="location">
                        @if (!empty($item->location->name))
                            @php $location =  $item->location->translateOrOrigin(app()->getLocale()) @endphp
                            {{ $location->name ?? '' }}
                        @endif
                    </div>
                    @if (setting_item('hotel_enable_review'))
                        <?php
                        $reviewData = $item->getScoreReview();
                        $score_total = $reviewData['score_total'];
                        ?>
                        <div class="service-review">
            <span class="rate">
                @if ($reviewData['total_review'] > 0)
                    {{ $score_total }}/10
                @endif <span class="rate-text">{{ $reviewData['review_text'] }}</span>
            </span>
                            <span class="review">
                @if ($reviewData['total_review'] > 1)
                                    {{ __(':number Reviews', ['number' => $reviewData['total_review']]) }}
                                @else
                                    {{ __(':number Review', ['number' => $reviewData['total_review']]) }}
                                @endif
            </span>
                        </div>
                    @endif
                    <div class="info">
                        <div class="g-price">
                            <div class="prefix">
                                <span class="fr_text">{{ __('from') }}</span>
                            </div>
                            <div class="price">
                <span class="text-price">{{ $item->display_price }} <span
                        class="unit">{{ __('/night') }}</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="fp_footer">
                        @if (!empty(($category = $item->categories->first())))
                            <ul class="fp_meta float-left mb0">
                                @if ($category->image_id)
                                    <li class="list-inline-item"><a href="{{ $category->getDetailUrl() }}"><img
                                                src="{{ \Modules\Media\Helpers\FileHelper::url($category->image_id) }}"
                                                alt="{{ $category->name }}"></a></li>
                                @endif
                                <li class="list-inline-item"><a href="{{ $category->getDetailUrl() }}">{{ $category->name }}</a>
                                </li>
                            </ul>
                        @endif
                        {{-- <ul class="fp_meta float-right mb0">
                            <li class="list-inline-item"><a class="service-wishlist icon {{ $item->isWishList() }}"
                                    data-id="{{ $item->id }}" data-type="hotel"><i
                                        class="@if ($item->hasWishList) fa fa-heart @else fa fa-heart-o @endif"></i></a>
                            </li>
                        </ul> --}}
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endif
