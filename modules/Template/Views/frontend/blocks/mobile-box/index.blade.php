@if($list_item)
    <div class="bravo-mobile-box">
        <div class="container">
            <div class="row">
                <div class="col-md-8 bravo-mobile-box-title">
                    <div class="title">
                        {{$title}}
                    </div>
                    <div class="all-app">
                        @foreach($list_item as $k=>$item)
                        <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                            <div class="app-item">
                                <div class="image">
                                    @if(!empty($style) and $style == 'style2')
                                        <span class="number-circle">{{$k+1}}</span>
                                    @else
                                        <img src="{{$image_url}}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="content">
                                    <div class="sub-title">
                                        {{$item['title']}}
                                    </div>
                                    <div class="desc">
                                        {!! clean($item['sub_title']) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2 bravo-scanner">
                    <img src="{{get_file_url($scanner_image ?? "","full")}}" class=" ">

                    <div class="desc">
                        Scan QR Code to Download
                    </div>
                </div>
                <div class="col-md-2 bravo-mobile">
                    <img src="{{get_file_url($mobile_image ?? "","full")}}" class="w100">
                </div>
            </div>
        </div>
    </div>
@endif
