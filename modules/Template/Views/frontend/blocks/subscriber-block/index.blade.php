<div class="mailchimp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12  col-md-4">
                <div class="media ">
                    <img class=" " alt="{{$title}}" src="{{get_file_url($background_image ?? "","full")}}">
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="newsletter-content">
                    <h4 class="media-heading">{{$title}}</h4>
                    <form action="{{route('newsletter.subscribe')}}" class="subcribe-form bravo-subscribe-form bravo-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control email-input" placeholder="{{__('Your Email')}}">
                            <button type="submit" class="btn-submit">{{__('Subscribe')}}
                                <i class="fa fa-spinner fa-pulse fa-fw"></i>
                            </button>
                        </div>
                        <div class="form-mess"></div>
                    </form>
                    <p>{!! clean($sub_title) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
