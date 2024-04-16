@if($list_item)
    <div class="bravo-box-category-hotel">
        <div class="container">
            @if($title)
                <div class="title">
                    {{$title}}
                </div>
            @endif
            @if(!empty($desc))
                <div class="desc">
                    {{$desc}}
                </div>
            @endif
            <div class="list-item">
                        {{-- <div class="item">
                            <a href="{{ $page_search }}">
                                <span class="text-title">{{ $translate->name }}</span>
                            </a>
                        </div> --}}

                <div class="form-group">
                    <ul class="nav nav-tabs">
                     @php $count=1; @endphp
                    @foreach($list_item as $k=>$item)
                        @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                            @php
                                $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );
                            @endphp
                        <li class="nav-item">
                            <a class="nav-link  @if ($count==1) active @endif" data-toggle="tab" href="#{{$item_cat->slug}}">{{ $translate->name }}</a>
                        </li>
                        @endif
                        @php $count++; @endphp
                    @endforeach
                    </ul>
                    <div class="tab-content" >
                        @php $count=1; @endphp
                        @foreach($list_item as $k=>$item)
                            @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                                @php
                                    $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                    $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );
                                @endphp

                        <div class="tab-pane @if ($count==1) active @endif" id="{{$item_cat->slug}}">
                            <a href="{{url('/')}}/hotel-category/{{$item_cat->slug}}" class="category_url"> {{__("Show More")}}</a>
                            <div class="list-item owl-carousel">
                                @php
                                    $hotels = \Modules\Hotel\Models\Hotel::where('status','publish')->where('category_id',$item_cat->id)->get();
                                @endphp

                                @foreach($hotels as $row)
                                    <div class="item-loop {{$wrap_class ?? ''}}">
                                        @if($row->is_featured == "1")
                                            <div class="featured">
                                                {{__("Featured")}}
                                            </div>
                                        @endif
                                        <div class="thumb-image ">
                                            <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                                                @if($row->image_url)
                                                    @if(!empty($disable_lazyload))
                                                        <img src="{{$row->image_url}}" class="img-responsive" alt="">
                                                    @else
                                                        {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$row->title]) !!}
                                                    @endif
                                                @endif
                                            </a>
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
                                            <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                        </div>
                                        <div class="item-title">
                                            <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                                                @if($row->is_instant)
                                                    <i class="fa fa-bolt d-none"></i>
                                                @endif
                                                    {!! clean($row->title) !!}
                                            </a>
                                            @if($row->discount_percent)
                                                <div class="sale_info">{{$row->discount_percent}}</div>
                                            @endif
                                        </div>
                                        <div class="location">
                                            @if(!empty($row->location->name))
                                                @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
                                                {{$location->name ?? ''}}
                                            @endif
                                        </div>
                                        @if(setting_item('hotel_enable_review'))
                                        <?php
                                        $reviewData = $row->getScoreReview();
                                        $score_total = $reviewData['score_total'];
                                        ?>
                                        <div class="service-review">
                                            <span class="rate">
                                                @if($reviewData['total_review'] > 0) {{$score_total}}/10 @endif <span class="rate-text">{{$reviewData['review_text']}}</span>
                                            </span>
                                            <span class="review">
                                                @if($reviewData['total_review'] > 1)
                                                    {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                                                @else
                                                    {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                                                @endif
                                            </span>
                                        </div>
                                        @endif
                                        <div class="info">
                                            <div class="g-price">
                                                <div class="prefix">
                                                    <span class="fr_text">{{__("from")}}</span>
                                                </div>
                                                <div class="price">
                                                    <span class="text-price">{{ $row->display_price }} <span class="unit">{{__("/night")}}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                            @endif
                            @php $count++; @endphp
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
