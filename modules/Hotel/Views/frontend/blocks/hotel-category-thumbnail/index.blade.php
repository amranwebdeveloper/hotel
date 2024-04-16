@if($list_item)
    <div class="bravo-hotel-category-thumbnail">
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
            <div class="row">
                @foreach($list_item as $k=>$item)
                    @php $image_url = get_file_url($item['image_id'], 'full'); @endphp
                        @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                            @php
                                $translate = $item_cat->translateOrOrigin(app()->getLocale());
                                $page_search = $item_cat->getLinkForPageSearch(false , [ 'cat_id[]' =>  $item_cat->id] );

                                $hotels =  DB::table('bravo_hotel_category_relationships')->where('category_id',$item_cat->id)->get();
                            @endphp
                            <div class="col-md-2 loop-item">
                                <div class="item">
                                    <a href="{{ url('/').'/hotel-category' }}/{{ $item_cat->slug }}">
                                        <img src="{{$image_url}}" alt="{{ $translate->name }}">
                                        <span class="text-title">{{ $translate->name }}
                                            <span class="hotel-count">@if(count($hotels)>1) {{count($hotels)}} Hotels @elseif(count($hotels)==1) 1 Hotel @else 0 Hotel @endif  </span>

                                        </span>
                                      </a>
                                </div>
                            </div>
                        @endif
                @endforeach
                <div class="col-md-2 last loop-item">
                    <div class="item">
                        <a href="{{ url('/').'/hotel-category' }}">
                            <div class="icon">
                                <i class="icofont-rounded-double-right"></i>
                            </div>
                            <span class="last-text-title">See all</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
