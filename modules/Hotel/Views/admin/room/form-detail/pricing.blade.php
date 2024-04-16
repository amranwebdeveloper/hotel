@if(is_default_lang())
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{__("Price")}} <span class="text-danger">*</span></label>
                <input type="number" required value="{{$row->price}}" min="1" placeholder="{{__("Price")}}" name="price" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{__("Number of room")}} <span class="text-danger">*</span></label>
                <input type="number" required value="{{$row->number ?? 1}}" min="1" max="100" placeholder="{{__("Number")}}" name="number" class="form-control">
            </div>
        </div>
    @if(is_default_lang())
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="control-label">{{__("Minimum day stay requirements")}}</label>
                    <input type="number" name="min_day_stays" class="form-control" value="{{$row->min_day_stays}}" placeholder="{{__("Ex: 2")}}">
                    <i>{{ __("Leave blank if you dont need to set minimum day stay option") }}</i>
                </div>
            </div>
        </div>
        <hr>
    @endif

        @if(is_default_lang())
            <hr>
    <div class="row">
        <div class="col-md-12">
            <h3 class="panel-body-title">{{__('Discount by number of night')}}</h3>
            <div class="form-group-item">
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-4">{{__("No of night")}}</div>
                        <div class="col-md-3">{{__('Discount')}}</div>
                        <div class="col-md-3">{{__('Type')}}</div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    @if(!empty($row->discount_by_night))
                        @foreach($row->discount_by_night as $key=>$item)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="number" min="0" name="discount_by_night[{{$key}}][from]" class="form-control" value="{{$item['from']}}" placeholder="{{__('From')}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" min="0" name="discount_by_night[{{$key}}][to]" class="form-control" value="{{$item['to']}}" placeholder="{{__('To')}}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" min="0" name="discount_by_night[{{$key}}][amount]" class="form-control" value="{{$item['amount']}}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="discount_by_night[{{$key}}][type]" class="form-control">
                                            <option @if($item['type'] ==  'fixed') selected @endif value="fixed">{{__("Fixed")}}</option>
                                            <option @if($item['type'] ==  'percent') selected @endif value="percent">{{__("Percent (%)")}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="number" min="0" __name__="discount_by_night[__number__][from]" class="form-control" value="" placeholder="{{__('From')}}">
                            </div>
                            <div class="col-md-2">
                                <input type="number" min="0" __name__="discount_by_night[__number__][to]" class="form-control" value="" placeholder="{{__('To')}}">
                            </div>
                            <div class="col-md-3">
                                <input type="number" min="0" __name__="discount_by_night[__number__][amount]" class="form-control" value="">
                            </div>
                            <div class="col-md-3">
                                <select __name__="discount_by_night[__number__][type]" class="form-control">
                                    <option value="fixed">{{__("Fixed")}}</option>
                                    <option value="percent">{{__("Percent")}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Number of beds")}} </label>
                <input type="number"  value="{{$row->beds ?? 1}}" min="1" max="10" placeholder="{{__("Number")}}" name="beds" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Room Size")}} </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="size" value="{{$row->size ?? 0}}" placeholder="{{__("Room size")}}" >
                    <div class="input-group-append">
                        <span class="input-group-text" >{!! size_unit_format() !!}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Max Adults")}} </label>
                <input type="number" min="1"  value="{{$row->adults ?? 1}}"  name="adults" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Max Children")}} </label>
                <input type="number" min="0"  value="{{$row->children ?? 0}}"  name="children" class="form-control">
            </div>
        </div>
    </div>
    <hr>
@endif