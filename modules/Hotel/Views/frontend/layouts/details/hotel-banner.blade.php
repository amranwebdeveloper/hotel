{{-- GUNEY --}}
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            @if(!empty($row->category_hotel->name))
                @php $cat =  $row->category_hotel->translateOrOrigin(app()->getLocale()) @endphp
                <div class="info">
                    <a class="value" href="{{ url('/').'/category' }}/{{$row->category_hotel->slug ?? ''}}"><i class="icofont-long-arrow-left"></i> {{__("Back to search results")}} - {{$cat->name ?? ''}}</a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pr-md-1 pb-md-1 pt-md-1">
            @if($row->video)
                <iframe class="bravo_embed_video" src="{{ handleVideoUrl($row->video) }}" allowscriptaccess="always" frameBorder="0" allow="autoplay" width="100%" height="350px"></iframe>
            @endif
        </div>
        <div class="col-md-6 pl-md-0 pb-md-1 pt-md-1">
            @if($row->getGallery())
                <div class="g-gallery">
                    <div class="fotorama" data-width="100%" data-thumbwidth="80" data-thumbheight="80" data-thumbmargin="5" data-nav="thumbs" data-allowfullscreen="true">
                        @foreach($row->getGallery() as $key=>$item)
                            <a href="{{$item['large']}}" data-thumb="{{$item['thumb']}}" data-alt="{{__("Gallery")}}"></a>
                        @endforeach
                    </div>
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
            @endif
        </div>
    </div>
</div>
{{--@if($row->banner_image_id)--}}
{{--    <div class="bravo_banner" style="background-image: url('{{$row->getBannerImageUrlAttribute('full')}}')">--}}
{{--        <div class="container">--}}
{{--            <div class="bravo_gallery">--}}
{{--                <div class="btn-group">--}}
{{--                    @if($row->video)--}}
{{--                        <a href="#" class="btn btn-transparent has-icon bravo-video-popup" data-toggle="modal" data-src="{{ handleVideoUrl($row->video) }}" data-target="#myModal">--}}
{{--                            <i class="input-icon field-icon fa">--}}
{{--                                <svg height="18px" width="18px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">--}}
{{--                                    <g fill="#FFFFFF">--}}
{{--                                        <path d="M2.25,24C1.009,24,0,22.991,0,21.75V2.25C0,1.009,1.009,0,2.25,0h19.5C22.991,0,24,1.009,24,2.25v19.5--}}
{{--                                            c0,1.241-1.009,2.25-2.25,2.25H2.25z M2.25,1.5C1.836,1.5,1.5,1.836,1.5,2.25v19.5c0,0.414,0.336,0.75,0.75,0.75h19.5--}}
{{--                                            c0.414,0,0.75-0.336,0.75-0.75V2.25c0-0.414-0.336-0.75-0.75-0.75H2.25z">--}}
{{--                                        </path>--}}
{{--                                        <path d="M9.857,16.5c-0.173,0-0.345-0.028-0.511-0.084C8.94,16.281,8.61,15.994,8.419,15.61c-0.11-0.221-0.169-0.469-0.169-0.716--}}
{{--                                            V9.106C8.25,8.22,8.97,7.5,9.856,7.5c0.247,0,0.495,0.058,0.716,0.169l5.79,2.896c0.792,0.395,1.114,1.361,0.719,2.153--}}
{{--                                            c-0.154,0.309-0.41,0.565-0.719,0.719l-5.788,2.895C10.348,16.443,10.107,16.5,9.857,16.5z M9.856,9C9.798,9,9.75,9.047,9.75,9.106--}}
{{--                                            v5.788c0,0.016,0.004,0.033,0.011,0.047c0.013,0.027,0.034,0.044,0.061,0.054C9.834,14.998,9.845,15,9.856,15--}}
{{--                                            c0.016,0,0.032-0.004,0.047-0.011l5.788-2.895c0.02-0.01,0.038-0.027,0.047-0.047c0.026-0.052,0.005-0.115-0.047-0.141l-5.79-2.895--}}
{{--                                            C9.889,9.004,9.872,9,9.856,9z">--}}
{{--                                        </path>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </i>{{__("Hotel Video")}}--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                    <div class="modal-dialog modal-lg" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-body">--}}
{{--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                                <div class="embed-responsive embed-responsive-16by9">--}}
{{--                                    <iframe class="embed-responsive-item bravo_embed_video" src="" allowscriptaccess="always" allow="autoplay"></iframe>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

