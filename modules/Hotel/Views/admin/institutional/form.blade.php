<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Institutional name")}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{__("Title")}}</label>
    <input type="text" value="{{$translation->title}}" placeholder="{{__("Institutional Title")}}" name="title" class="form-control">
</div>
<div class="form-group">
    <label class="control-label">{{__("Description")}}</label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{__("Thumbnail Image")}}</label>
    <div class="form-group-image">
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('icon_image_id',$row->icon_image_id) !!}
    </div>
</div>
@if(is_default_lang())
    <div class="form-group">
        <label>{{__("Parent")}}</label>
        <select name="parent_id" class="form-control">
            <option value="">{{__("-- Please Select --")}}</option>
            <?php
            $traverse = function ($institutions, $prefix = '') use (&$traverse, $row) {
                foreach ($institutions as $institutional) {
                    if ($institutional->id == $row->id) {
                        continue;
                    }
                    $selected = '';
                    if ($row->parent_id == $institutional->id)
                        $selected = 'selected';
                    printf("<option value='%s' %s>%s</option>", $institutional->id, $selected, $prefix . ' ' . $institutional->name);
                    $traverse($institutional->children, $prefix . '-');
                }
            };
            $traverse($parents);
            ?>
        </select>
    </div>
@endif
