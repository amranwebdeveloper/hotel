@foreach ($attributes as $attribute)
    @php $translate = $attribute->translateOrOrigin(app_get_locale()); @endphp
    <div class="panel">
        <div class="panel-title"><strong>{{__('Attribute: :name',['name'=>$translate->name])}}</strong></div>
        <div class="panel-body">
            <div class="terms-scrollable">
                <table>
                    <tr><th>Active</th><th>Terms</th><th>Paid</th></tr>
                @foreach($attribute->terms as $term)
                    @php $term_translate = $term->translateOrOrigin(app_get_locale()); @endphp
                    <tr class="term-item">
                        <td><input @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"></td>
                        <td>{{$term->id}}:<span class="term-name">{{$term_translate->name}}</span></td>
                        <td>
                            @php
                                $hotel_terms = \Modules\Hotel\Models\HotelTerm::where('target_id', $row->id)->where('term_id',$term->id)->first();
                            @endphp
                            @if(!empty($hotel_terms->paid_service)) {{$hotel_terms->paid_service}}  @endif
                            <select name="paid_service[]">
                              <option value="1" @if(!empty($hotel_terms->paid_service) and ($hotel_terms->paid_service==1)) selected @endif> Yes</option>
                              <option value="0" @if(!empty($hotel_terms->paid_service) and ($hotel_terms->paid_service==0)) selected @endif>No</option>
                            </select>
                        </td> {{-- @if($term->paid_service==1) checked @endif @if(!empty($hotel_terms->paid_service) and ($hotel_terms->paid_service==1)) checked @endif --}}
                    </tr>

@endforeach
</table>
</div>
</div>
</div>
@endforeach
