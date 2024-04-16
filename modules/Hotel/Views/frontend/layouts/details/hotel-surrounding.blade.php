@if(!empty($location_category) and !empty($translation->surrounding))
	<div class="g-surrounding">
		<div class="location-title">
			<h3 class="mb-4">{{__("What's Nearby")}}</h3>
			@foreach($location_category as $category)
                @if(!empty($category))
{{--                    <h6 class="font-weight-bold mb-3"><i class="{{clean($category->icon_class)}} "></i> {{$category->location_category_translations->name??$category->name}}</h6>--}}
                    @if(!empty($translation->surrounding[$category->id]))
                        @foreach($translation->surrounding[$category->id] as $item)
                            <div class="row mb-1">
                                <div class="col-lg-10">Distance to {{$item['name']}} </div>
                                <div class="col-lg-2">{{$item['value']}}{{$item['type']}}</div>
                                @if(!empty($item['content']))
                                    <div class="col-lg-12"{{$item['content']}}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                @endif
			@endforeach
		</div>
	</div>
	<div class="bravo-hr"></div>
@endif
