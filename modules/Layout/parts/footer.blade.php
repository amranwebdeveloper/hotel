@if (!is_api())
    <div class="bravo_footer">
        <div class="main-footer">
            <div class="container">
                <div class="row">
                    @if ($list_widget_footers = setting_item_with_lang('list_widget_footer'))
                        <?php $list_widget_footers = json_decode($list_widget_footers); ?>
                        @foreach ($list_widget_footers as $key => $item)
                            <div class="col-lg-{{ $item->size ?? '3' }} col-md-6">
                                <div class="nav-footer">
                                    <div class="title">
                                        {{ $item->title }}
                                    </div>
                                    <div class="context">
                                        {!! $item->content !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="copy-right">
			<div class="container context">
                <div class="copy-right-menu">
                    <div class="copy-right-menu-list">
                        <span class="bold">Contracts & KVKK</span>
                        @if($footer_bottom_menus = setting_item_with_lang("footer_bottom_menu"))
                            <?php $footer_bottom_menus = json_decode($footer_bottom_menus); ?>
                            @foreach($footer_bottom_menus as $key=>$item)
                                <a class="brlft" href="{!! $item->link  !!}"><span>{{$item->title}}</span></a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="row justify-content-end footer-logos">
                    <div class="col-7">
                        @if($bg = get_file_url(setting_item("footer_bottom_image"),"full"))
                            <img src="{{$bg}}" data-src="{{$bg}}" class="wd100" alt="ssl_img">
                        @endif
                    </div>
                </div>
                {{-- <div class="row">
                    <ul class="social-icons">
                        @if($footer_bottom_socials = setting_item_with_lang("footer_bottom_social"))
                            <?php $footer_bottom_socials = json_decode($footer_bottom_socials); ?>
                            @foreach($footer_bottom_socials as $key=>$item)
                                <li class="{{$item->title}}"><a class="{{$item->color}}" data-original-title="{{$item->title}}" target="_blank" rel="nofollow" title="" href="{!! $item->link !!}" data-toggle="tooltip"><i class="{!! $item->icon !!}"></i></a></li>
                            @endforeach
                        @endif
                    </ul>
                </div> --}}
				<div class="row copy-right">
					<div class="col-12">
						{!! setting_item_with_lang("footer_text_left") ?? ''  !!}
                        {!! setting_item_with_lang("footer_text_right") ?? ''  !!}
					</div>
				</div>
			</div>
		</div>
        <div class="footer-image">
            <img class="img-responsive preloading" alt="footerimg" data-src="https://d1vqfl8cu8qgdj.cloudfront.net/assets/img/footerb2b_b2c.png" src="https://d1vqfl8cu8qgdj.cloudfront.net/assets/img/footerb2b_b2c.png" width="1903" height="335">
        </div>
    </div>
@endif

@include('Layout::parts.login-register-modal')
@include('Layout::parts.chat')
@include('Popup::frontend.popup')
@if (Auth::check())
    @include('Media::browser')
@endif
<link rel="stylesheet" href="{{ asset('libs/flags/css/flag-icon.min.css') }}">

{!! \App\Helpers\Assets::css(true) !!}

{{-- Lazy Load --}}
<script src="{{ asset('libs/lazy-load/intersection-observer.js') }}"></script>
<script async src="{{ asset('libs/lazy-load/lazyload.min.js') }}"></script>
<script>
    // Set the options to make LazyLoad self-initialize
    window.lazyLoadOptions = {
        elements_selector: ".lazy",
        // ... more custom settings?
    };

    // Listen to the initialization event and get the instance of LazyLoad
    window.addEventListener('LazyLoad::Initialized', function(event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);
</script>
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('libs/vue/vue' . (!env('APP_DEBUG') ? '.min' : '') . '.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
@if (Auth::check())
    <script src="{{ asset('module/media/js/browser.js?_ver=' . config('app.asset_version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/daterange/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/daterange/daterangepicker.min.js') }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/functions.js?_ver=' . config('app.asset_version')) }}"></script>

@if (setting_item('tour_location_search_style') == 'autocompletePlace' ||
    setting_item('hotel_location_search_style') == 'autocompletePlace' ||
    setting_item('car_location_search_style') == 'autocompletePlace' ||
    setting_item('space_location_search_style') == 'autocompletePlace' ||
    setting_item('hotel_location_search_style') == 'autocompletePlace' ||
    setting_item('event_location_search_style') == 'autocompletePlace')
    {!! App\Helpers\MapEngine::scripts() !!}
@endif
<script src="{{ asset('libs/pusher.min.js') }}"></script>
<script src="{{ asset('js/home.js?_ver=' . config('app.asset_version')) }}"></script>

@if (!empty($is_user_page))
    <script src="{{ asset('module/user/js/user.js?_ver=' . config('app.asset_version')) }}"></script>
@endif
@if (setting_item('cookie_agreement_enable') == 1 and
    request()->cookie('booking_cookie_agreement_enable') != 1 and
    !is_api() and
    !isset($_COOKIE['booking_cookie_agreement_enable']))
    <div class="booking_cookie_agreement p-3 d-flex fixed-bottom">
        <div class="content-cookie">{!! clean(setting_item_with_lang('cookie_agreement_content')) !!}</div>
        <button class="btn save-cookie">{!! clean(setting_item_with_lang('cookie_agreement_button_text')) !!}</button>
    </div>
    <script>
        var save_cookie_url = '{{ route('core.cookie.check') }}';
    </script>
    <script src="{{ asset('js/cookie.js?_ver=' . config('app.asset_version')) }}"></script>
@endif

@if (setting_item('user_enable_2fa'))
    @include('auth.confirm-password-modal')
    <script src="{{ asset('/module/user/js/2fa.js') }}"></script>
@endif

{!! \App\Helpers\Assets::js(true) !!}

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp

@stack('js')
