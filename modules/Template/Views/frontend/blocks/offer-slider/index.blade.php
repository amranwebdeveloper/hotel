@if(!empty($list_item))
    <div class="bravo-offer-slider">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="owl-carousel">
                        @foreach($list_item as $key=>$item)
                            @if($item['short_offer']==0)
                            <div class="item-loop">
                                <div class="thumb-image ">
                                    <a target="_blank" href="{{$item['link_more']}}">
                                        <img src="{{ get_file_url($item['background_image'],'full') ?? "" }}" class="img-responsive" alt="">
                                    </a>
                                </div>
                                <div class="slider-text">
                                    @if(!empty($item['featured_text']))
                                        <div class="featured-text">{{$item['featured_text']}}</div>
                                    @endif
                                    @if(!empty($item['featured_icon']))
                                        <div class="featured-icon"><i class="{{$item['featured_icon']}}"></i></div>
                                    @endif
                                    <a target="_blank" href="{{$item['link_more']}}">
                                        <h2 class="item-title">{{$item['title']}}</h2>
                                        <p class="item-sub-title">{!! $item['desc'] !!}</p>
                                    </a>
                                    <a href="{{$item['link_more']}}" class="btn btn-default">{{$item['link_title']}}</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    @foreach($list_item as $key=>$item)
                        @if($item['short_offer']==1)
                        <div class="short_offer">
                            <div class="short_offer_text">
                                <a target="_blank" href="{{$item['link_more']}}">
                                    <h2 class="item-title">{{$item['title']}}</h2> 
                                </a>
                                <a href="{{$item['link_more']}}" class="btn btn-default">{{$item['link_title']}}</a>
                            </div>
                            <div class="short_offer_image ">
                                <a target="_blank" href="{{$item['link_more']}}">
                                    <img src="{{ get_file_url($item['background_image'],'full') ?? "" }}" class="img-responsive" alt="">
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                {{-- @foreach($list_item as $key=>$item)
                    @php $size = 3 ; if($key == 0) $size = 6; @endphp
                @endforeach --}}
            </div>
        </div>
    </div>
@endif
