
@php
    $terms_ids = $row->terms->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
@endphp
@if(!empty($terms_ids) and !empty($attributes))
    @foreach($attributes as $key => $attribute )
        @if(($attribute['parent']->slug) != 'highlights')
        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
        @if(empty($attribute['parent']['hide_in_single']))
            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
                <h3>{{ $translate_attribute->name }}</h3>
                @php $terms = $attribute['child'] @endphp
                <div class="list-attributes">
                    @foreach($terms as $term )
                        @php
                            $translate_term = $term->translateOrOrigin(app()->getLocale());
                            $hotel_terms = DB::table('bravo_hotel_term')->where('target_id', $row->id)->whereIn('term_id',$terms_ids)->groupBy('term_id')->get();
                        @endphp
                        @foreach($hotel_terms as  $hotel_term )

                            @if($hotel_term->term_id == $term->id)
                                <div class="item {{$term->slug}} term-{{$term->id}}">
                                    @if(!empty($term->image_id))
                                        @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                                        <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                                    @else
                                        <i class="{{ $term->icon ?? "icofont-check-circled icon-default" }}"></i>
                                    @endif
                                    {{$translate_term->name}} @if($hotel_term->paid_service==1) * @endif
                                </div>
                            @endif

                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif
        @endif
    @endforeach
@endif
