@extends('layouts.app')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/ion_rangeslider/css/ion.rangeSlider.min.css') }}" />
@endsection
@section('content')
    <div class="bravo_detail_location">
        <section class="our-listing pb30-991"
            style="background: url('{{ get_file_url($row->banner_image_id, 'full') }}');background-size: cover;
            display: flex;
            align-items: center;
            height: 450px;
            background-position: center;">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-lg-12">
                        @include('hotel.layouts.search.filter-search-mobile')
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb_content style2">
                            <h2 class="breadcrumb_title">{{ $translation->name }}</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/institutional') }}">{{ __('Institutional') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $translation->name }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dn db-lg mt30 mb0 tac-767">
                            <div id="main2">
                                <span id="open2" class="fa fa-filter filter_open_btn style2">
                                    {{ __('Show Filter') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    {{-- <div class="col-xl-4">
                        <div class="sidebar_listing_grid1 dn-lg bgc-f4">
                            <div class="sidebar_listing_list">
                                <div class="sidebar_advanced_search_widget">
                                    <ul class="sasw_list mb0">
                                        @include('Hotel::frontend.layouts.form-search.sidebar')
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="listing_filter_row dif db-767">
                                {{-- <div class="col-sm-12 col-md-4 col-lg-4 col-xl-5">
                                    <div class="left_area tac-xsd mb30-767">
                                        @include('Hotel::frontend.layouts.search.loop.result-count')
                                    </div>
                                </div> --}}
                                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-7">
                                    <div class="listing_list_style tac-767">
                                        @include('Hotel::frontend.layouts.search.orderby')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @php $layout = request()->query('layout') @endphp
                            @if ($rows->total() > 0)
                                @foreach ($rows as $row)
                                    @if ($layout == 'list')
                                        <div class="item-listting col-lg-12">
                                            @include('Hotel::frontend.layouts.search.loop-list')
                                        </div>
                                    @else
                                        <div class="item-listting col-lg-6 col-md-6">
                                            @include('Hotel::frontend.layouts.search.loop-grid')
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-lg-12">
                                    <div class="border rounded p-3 bg-white">
                                        {{ __('Hotel not found') }}
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12 mt20">
                                <div class="mbp_pagination">
                                    {{ $rows->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('footer')
    {!! App\Helpers\MapEngine::scripts() !!}

    <script type="text/javascript" src="{{ asset('libs/ion_rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/sticky/jquery.sticky.js') }}"></script>
@endsection
