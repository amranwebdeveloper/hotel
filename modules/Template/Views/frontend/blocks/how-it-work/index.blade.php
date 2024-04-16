@if($list_item)
    <div class="bravo-how-it-works" style="background-image: linear-gradient(0deg,rgba(255, 255, 255, 0.2),rgba(255, 255, 255, 0.2)),url('{{get_file_url($background_image ?? "","full")}}') !important">
        <div class="container">
            <div class="row">
                <div class="col-md-4 bravo-how-it-works-title">
                    <div class="title">
                        {{$title}}
                    </div>
                </div>
                @foreach($list_item as $k=>$item)
                    <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                    <div class="col-md-4 ">
                        <div class="featured-item">
                            <div class="image">
                                @if(!empty($style) and $style == 'style2')
                                    <span class="number-circle">{{$k+1}}</span>
                                @else
                                    <img src="{{$image_url}}" class="img-fluid">
                                @endif
                            </div>
                            <div class="content">
                                <h4 class="sub-title">
                                    {{$item['title']}}
                                </h4>
                                <div class="desc">
                                    @if(strlen($item['sub_title']) > 200)
                                    {!! clean(substr($item['sub_title'],0,200)) !!}
                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                    <span class="read-more-content">  {!! clean(substr($item['sub_title'],200,strlen($item['sub_title']))) !!}
                                    <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                    @else
                                    {!! clean($item['sub_title']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
