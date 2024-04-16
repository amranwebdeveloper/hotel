@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
<div class="hotel-card">
    <div class="item-loop-list {{$wrap_class ?? ''}}">
        @if($row->is_featured == "1")
            <div class="featured">
                {{__("Featured")}}
            </div>
        @endif
        <div class="thumb-image">
            <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                @if($row->image_url)
                    @if(!empty($disable_lazyload))
                        <img src="{{$row->image_url}}" class="img-responsive" alt="">
                    @else
                        {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$translation->title]) !!}
                    @endif
                @endif
            </a>
            <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                <i class="fa fa-heart"></i>
            </div>
        </div>
        <div class="g-info">
            @if($row->star_rate)
                <div class="star-rate">
                    <div class="list-star">
                        <ul class="booking-item-rating-stars">
                            @for ($star = 1 ;$star <= $row->star_rate ; $star++)
                                <li><i class="fa fa-star"></i></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            @endif
            <div class="item-title">
                <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                    @if($row->is_instant)
                        <i class="fa fa-bolt d-none"></i>
                    @endif
                        {!! clean($translation->title) !!} - 


                @if(!empty($row->location->name))
                    @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
                    <i class="icofont-paper-plane"></i>
                    {{$location->name ?? ''}}
                @endif




                </a>
            </div>
            @php
    $terms_ids = $row->terms->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
@endphp
@if(!empty($terms_ids) and !empty($attributes))
    @foreach($attributes as $key => $attribute )
        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
        @if(empty($attribute['parent']['hide_in_single']))
            @php $terms = $attribute['child'];
            $count=1;
            @endphp
            @foreach($terms as $term )

                @php $translate_term = $term->translateOrOrigin(app()->getLocale());
                if($count<6) {
                @endphp
                <span class="item {{$term->slug}} term-{{$term->id}}">
                    @if(!empty($term->image_id))
                        @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                        <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                    @else
                        <i class="{{ $term->icon ?? "icofont-check-circled icon-default" }}"></i>
                    @endif
                    {{$translate_term->name}}
                </span>
            @php
                }
            $terms = $attribute['child'];
            $count++;
            @endphp
            @endforeach
        @endif
    @endforeach
@endif

            {{-- @if(!empty($attribute = $row->getAttributeInListingPage()))
                @php
                    $translate_attribute =  $attribute->translateOrOrigin(app()->getLocale());
                    $termsByAttribute = $row->termsByAttributeInListingPage
                @endphp
                <div class="terms">
                    <div class="g-attributes">
                        <span class="attr-title"><i class="icofont-medal"></i> {{$translate_attribute->name ?? ""}}: </span>
                        @foreach($termsByAttribute as $term )
                            @php $translate_term = $term->translateOrOrigin(app()->getLocale()) @endphp
                            <span class="item {{$term->slug}} term-{{$term->id}}">{{$translate_term->name}}</span>
                        @endforeach
                    </div>
                </div>
            @endif --}}

        </div>
        <div class="g-rate-price">
            @if(setting_item('hotel_enable_review'))
                @php  $reviewData = $row->getScoreReview(); @endphp
                <div class="service-review-pc">
                    <div class="head">
                        <div class="left">
                            <span class="head-rating">{{$reviewData['review_text']}}</span>
                            <span class="text-rating">{{__(":number reviews",['number'=>$reviewData['total_review']])}}</span>
                        </div>
                        <div class="score">
                            {{$reviewData['score_total']}}<span>/10</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="g-price">
                <div class="prefix">
                    <span class="fr_text">{{__("from")}}</span>
                </div>
                <div class="price">
                    <span class="text-price">{{ $row->display_price }} <span class="unit">{{__("/night")}}</span></span>
                </div>
                @if(!empty($reviewData['total_review']))
                    <div class="text-review">
                        {{__(":number reviews",['number'=>$reviewData['total_review']])}}
                    </div>
                @endif

{{-- GUNEY

                @if (!empty($row->categories) && count($row->categories) > 0)
                    @php $category = $row->categories[0]; @endphp
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
--}}

            </div>

        </div>

            {{-- <ul class="fp_meta float-right mb0">
                <li class="list-inline-item"><a class="service-wishlist icon {{ $row->isWishList() }}"
                        data-id="{{ $row->id }}" data-type="hotel"><i class="@if ($row->hasWishList) fa fa-heart @else fa fa-heart-o @endif"></i></a>
                </li>
            </ul> --}}
    </div>
    <div class="item-loop-footer">
        <div class="item-loop-footer-left">
            <div class="item-loop-footer-features" data-toggle="tooltip" data-title="#kalitelitatil için bu oteli TatilBenim olarak öneriyoruz" data-original-title="" title=""><strong><i class="icofont-travelling"></i> Tatilbenim.com Öneriyor</strong></div>
            <div class="item-loop-footer-features"> 6 month postponement opportunity</div>
            <div class="item-loop-footer-features" data-toggle="tooltip" data-placement="bottom" data-title="Satın aldığınız rezervasyonunuzun 4'te 1'ini şimdi, kalanını 7 gün kalaya kadar ödeme fırsatını yakalayın." ><i class="icofont-pie-chart"></i> Pay 1 out of 4 now</div>
        </div>
        <div class="item-loop-footer-right">
            <a type="button" href="" title="Make a Reservation" class="btn btn-reservation">{{__("Make a Reservation")}}</a>
        </div>
    </div>
</div>
