{{-- GUNEY --}}
@extends('layouts.app')
@push('css')
    <link href="{{ asset('dist/frontend/module/hotel/css/hotel.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
@endpush
@section('content')
    <div class="bravo_detail_hotel">
        @include('Layout::parts.bc')
        @include('Hotel::frontend.layouts.details.hotel-banner')
        <div class="bravo_content hotel-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-md-12">
                        <div class="g-header">
                            <div class="left">
                                @if($row->star_rate)
                                    <div class="star-rate">
                                        @for ($star = 1 ;$star <= $row->star_rate ; $star++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </div>
                                @endif
                                <h1>{!! clean($translation->title) !!}</h1>

                                @if(!empty($row->institutional_hotel->name))
                                    @php $institute =  $row->institutional_hotel->translateOrOrigin(app()->getLocale()) @endphp
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="icon">
                                                <i class="icofont-beach"></i>
                                            </div>
                                            <div class="info">
                                                <p class="value">
                                                    {{__("Hotel Type")}}: {{$institute->name ?? ''}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="right">
                                <div class="social">
                                    <div class="social-share">
                <span class="social-icon">
                    <i class="icofont-share"></i>
                </span>
                                        <ul class="share-wrapper">
                                            <li>
                                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Facebook")}}">
                                                    <i class="fa fa-facebook fa-lg"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter" href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Twitter")}}">
                                                    <i class="fa fa-twitter fa-lg"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                                        <i class="fa fa-heart-o"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($row->duration) or !empty($row->category_hotel->name) or !empty($row->max_people) or !empty($row->location->name))
                    <div class="g-hotel-feature" id="hotelNav">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-md-12">
                                <ul class="tabs akb-bg-none">
                                    <li class="tab ">
                                        <a href="#generalfeatures" class="active">{{ __('General features') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#rooms" class="">{{ __('Rooms_new') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#FacilityActivities" class="">{{ __('Facility Activities') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#PoolandBeach" class="">{{ __('Pool and Beach') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#ConceptFeatures" class="">{{ __('Concept Features') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#ImportantNotes" class="">{{ __('Important notes') }}</a>
                                    </li>
                                    <li class="tab ">
                                        <a href="#Reviews" class="">{{ __('Reviews') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        @php $review_score = $row->review_data @endphp
                        @include('Hotel::frontend.layouts.details.hotel-detail')
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo_content" id="rooms">
        @include('Hotel::frontend.layouts.details.hotel-rooms')
        </div>
        <div class="campaign" id="campaign">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-sale-discount"></i>
                            {{ __('Institutions') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        @if (!empty($row->institutions) && count($row->institutions) > 0)
                            <div class="sidebar_institutional_widget">
                                <ul class="mb0">
                                    @foreach ($row->institutions as $key => $institutional)
                                        <li class="{{ count($row->institutions) - 1 != $key ? 'mb25' : '' }}">
                                            <a data-toggle="modal" data-target="#modal-{{$institutional->slug}}">
                                                @if ($institutional->icon_image_id)
                                                    <img class="mr5" src="{{ \Modules\Media\Helpers\FileHelper::url($institutional->icon_image_id) }}" alt="{{ $institutional->name }}">
                                                @endif
                                            </a><br>
                                            {{ $institutional->name }}
                                            {{ $institutional->title }}<br>
                                            <a class="" data-toggle="modal" data-target="#modal-{{$institutional->slug}}">
                                                <i class="fa fa-info-circle"></i> {{__("Campaign Terms")}}
                                            </a>
                                            <div class="modal fade" id="modal-{{$institutional->slug}}">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">{{ $institutional->name }}</h4>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            @if ($institutional->icon_image_id)
                                                                <img class="mr5" src="{{ \Modules\Media\Helpers\FileHelper::url($institutional->icon_image_id) }}" alt="{{ $institutional->name }}">
                                                            @endif
                                                            {{ $institutional->title }}
                                                            {!! $institutional->content !!}
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <span class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign" id="FacilityActivities">
            <div class="container">
                @if(isset($row->general_features))
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-5-star-hotel"></i>
                            {{ __('General features') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        {!! $row->general_features !!}
                        <div class="g-all-attribute is_pc">
                            @php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            @endphp
                            @if(!empty($terms_ids) and !empty($attributes))
                                @foreach($attributes as $key => $attribute )
                                    @if(($attribute['parent']->slug) == 'general-features')
                                        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
                                        @if(empty($attribute['parent']['hide_in_single']))
                                            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                @endif
                <hr>
                @if(isset($row->facility_activities))
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-runner-alt-1"></i>
                            {{ __('Facility Activities') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        {!! $row->facility_activities !!}
                        <div class="g-all-attribute is_pc">
                            @php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            @endphp
                            @if(!empty($terms_ids) and !empty($attributes))
                                @foreach($attributes as $key => $attribute )
                                    @if(($attribute['parent']->slug) == 'facility-activities')
                                        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
                                        @if(empty($attribute['parent']['hide_in_single']))
                                            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    @endif
                    @if(isset($row->pool_and_beach))
                <div class="row" id="PoolandBeach">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-beach-bed"></i>
                            {{ __('Pool and Beach') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        {!! $row->pool_and_beach !!}
                        <div class="g-all-attribute is_pc">
                            @php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            @endphp
                            @if(!empty($terms_ids) and !empty($attributes))
                                @foreach($attributes as $key => $attribute )
                                    @if(($attribute['parent']->slug) == 'pool-and-beach')
                                        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
                                        @if(empty($attribute['parent']['hide_in_single']))
                                            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    @endif
                    @if(isset($row->honeymoon))
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30"><i class="icofont-love"></i>
                            {{ __('Honeymoon') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        {!! $row->honeymoon !!}
                        <div class="g-all-attribute is_pc">
                            @php
                                $terms_ids = $row->terms->pluck('term_id');
                                $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
                            @endphp
                            @if(!empty($terms_ids) and !empty($attributes))
                                @foreach($attributes as $key => $attribute )
                                    @if(($attribute['parent']->slug) == 'honeymoon')
                                        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
                                        @if(empty($attribute['parent']['hide_in_single']))
                                            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
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
                        <br>Features marked with * are paid.
                    </div>
                </div>
                        <hr>
                    @endif
                    @if(isset($row->concept_features))
                        <div class="row" id="ConceptFeatures">
                            <div class="col-md-3 ">
                                <h4 class="title mb30"> <i class="icofont-checked"></i>
                                    {{ __('Concept Features') }}</h4>
                            </div>
                            <div class="col-md-9 ">
                                {!! $row->concept_features !!}
                            </div>
                        </div>
                        <hr>
                    @endif
                    @if(isset($row->important_notes))
                        <div class="row" id="ImportantNotes">
                            <div class="col-md-3 ">
                                <h4 class="title mb30"><i class="icofont-book-alt"></i>
                                    {{ __('Important Notes') }}</h4>
                            </div>
                            <div class="col-md-9 ">
                                {!! $row->important_notes !!}
                            </div>
                        </div>
                    @endif
            </div>
        </div>
        <div class="campaign" id="campaign">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ">
                        <h4 class="title mb30">{{ __('Rules') }}</h4>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="key">{{__("Check In")}}</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="value">	{{$row->check_in_time}} </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="key">{{__("Check Out")}}</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="value">	{{$row->check_out_time}} </div>
                            </div>
                        </div>
                        @if($translation->policy)
                            <div class="key">{{__("Hotel Policies")}}</div>
                            @foreach($translation->policy as $key => $item)
                                <div class="item @if($key > 1) d-none @endif">
                                    <div class="strong">{{$item['title']}}</div>
                                    <div class="context">{!! $item['content'] !!}</div>
                                </div>
                            @endforeach
                            @if( count($translation->policy) > 2)
                                <div class="btn-show-all">
                                    <span class="text">{{__("Show All")}}</span>
                                    <i class="fa fa-caret-down"></i>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo_content">
            <div class="container">
                <div class="bravo-hr"></div>
                <div id="Reviews">
                @include('Hotel::frontend.layouts.details.hotel-review')
                </div>
                @include('Hotel::frontend.layouts.details.hotel-form-enquiry-mobile')

{{--                @include('Tour::frontend.layouts.details.vendor')--}}
                @include('Hotel::frontend.layouts.details.hotel-form-enquiry')
{{--                @if (!empty($row->categories) && count($row->categories) > 0)--}}
{{--                    <div class="sidebar_category_widget">--}}
{{--                        <h4 class="title mb30">{{ __('Categories') }}</h4>--}}
{{--                        <ul class="mb0">--}}
{{--                            @foreach ($row->categories as $key => $category)--}}
{{--                                <li class="{{ count($row->categories) - 1 != $key ? 'mb25' : '' }}"><a--}}
{{--                                        href="{{ $category->getDetailUrl() }}">--}}
{{--                                        @if ($category->image_id)--}}
{{--                                            <img class="mr5"--}}
{{--                                                 src="{{ \Modules\Media\Helpers\FileHelper::url($category->image_id) }}"--}}
{{--                                                 alt="{{ $category->name }}">--}}
{{--                                        @endif {{ $category->name }}--}}
{{--                                    </a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
                @include('Hotel::frontend.layouts.details.hotel-related-list')

            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            @if($row->map_lat && $row->map_lng)
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat}}, {{$row->map_lng}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {
                            iconUrl:"{{get_file_url(setting_item("hotel_icon_marker_map"),'full') ?? url('images/icons/png/pin.png') }}"
                        }
                    });
                }
            });
            @endif
        })
    </script>
    <script>
        var bravo_booking_data = {!! json_encode($booking_data) !!}
        var bravo_booking_i18n = {
			no_date_select:'{{__('Please select Start and End date')}}',
            no_guest_select:'{{__('Please select at least one guest')}}',
            load_dates_url:'{{route('space.vendor.availability.loadDates')}}',
            name_required:'{{ __("Name is Required") }}',
            email_required:'{{ __("Email is Required") }}',
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/hotel/js/single-hotel.js?_ver='.config('app.asset_version')) }}"></script>

@endpush
