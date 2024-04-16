<div class="panel">
    <div class="panel-title"><strong>{{__("Hotel Content")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Title")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("Name of the hotel")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Content")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Main Category")}}</label>
                        <div class="">
                            <select name="category_id" class="form-control">
                                <option value="">{{__("-- Please Select --")}}</option>
                                <?php
                                $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                                    foreach ($categories as $category) {
                                        $selected = '';
                                        if ($row->category_id == $category->id)
                                            $selected = 'selected';
                                        printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                                        $traverse($category->children, $prefix . '-');
                                    }
                                };
                                $traverse($hotel_category);
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">{{__("Main Institutional")}}</label>
                            <div class="">
                                <select name="institutional_id" class="form-control">
                                    <option value="">{{__("-- Please Select --")}}</option>
                                    <?php
                                    $traverse = function ($institutions, $prefix = '') use (&$traverse, $row) {
                                        foreach ($institutions as $institutional) {
                                            $selected = '';
                                            if ($row->institutional_id == $institutional->id)
                                                $selected = 'selected';
                                            printf("<option value='%s' %s>%s</option>", $institutional->id, $selected, $prefix . ' ' . $institutional->name);
                                            $traverse($institutional->children, $prefix . '-');
                                        }
                                    };
                                    $traverse($hotel_institutional);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="form-group">
                <label class="control-label">{{__("Youtube Video")}}</label>
                <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Youtube link video")}}">
            </div>
        @endif
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Banner Image")}}</label>
                <div class="form-group-image">
                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{__("Gallery")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Hotel Policy")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__("Hotel rating standard")}}</label>
                        <input type="number" value="{{$row->star_rate}}" placeholder="{{__("Eg: 5")}}" name="star_rate" class="form-control">
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group-item">
            <label class="control-label">{{__('Policy')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Title")}}</div>
                    <div class="col-md-5">{{__('Content')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($translation->policy))
                    @php if(!is_array($translation->policy)) $translation->policy = json_decode($translation->faqs); @endphp
                    @foreach($translation->policy as $key=>$item)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="policy[{{$key}}][title]" class="form-control" value="{{$item['title']}}" placeholder="{{__('Eg: What kind of foowear is most suitable ?')}}">
                                </div>
                                <div class="col-md-6">
                                    <textarea name="policy[{{$key}}][content]" class="form-control" placeholder="...">{{$item['content']}}</textarea>
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
                        <div class="col-md-5">
                            <input type="text" __name__="policy[__number__][title]" class="form-control" placeholder="{{__('Eg: What kind of foowear is most suitable ?')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea __name__="policy[__number__][content]" class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php do_action(\Modules\Hotel\Hook::FORM_AFTER_POLICY,$row) ?>
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Other Details")}}</strong></div>
    <div class="panel-body">

        <div class="form-group">
            <label class="control-label">{{__("General Features")}} {{__("Note: Features Select From Attributes")}}</label>
            <div class="">
                <textarea name="general_features" class="form-control">{{$translation->general_features}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Facility Activities")}} {{__("Note: Features Select From Attributes")}}</label>
            <div class="">
                <textarea name="facility_activities" class="form-control">{{$translation->facility_activities}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Pool and Beach")}} {{__("Note: Features Select From Attributes")}}</label>
            <div class="">
                <textarea name="pool_and_beach" class="form-control">{{$translation->pool_and_beach}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Honeymoon")}} {{__("Note: Features Select From Attributes")}}</label>
            <div class="">
                <textarea name="honeymoon" class="form-control">{{$translation->honeymoon}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Concept Features")}}</label>
            <div class="">
                <textarea name="concept_features" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->concept_features}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">{{__("Important Notes")}}</label>
            <div class="">
                <textarea name="important_notes" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->important_notes}}</textarea>
            </div>
        </div>
    </div>
</div>
