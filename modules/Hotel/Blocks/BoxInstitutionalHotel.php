<?php
namespace Modules\Hotel\Blocks;

use Modules\Template\Blocks\BaseBlock;

use Modules\Media\Helpers\FileHelper;

use Modules\Hotel\Models\HotelInstitutional;

class BoxInstitutionalHotel extends BaseBlock
{
    public function getOptions(){
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('List Item(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'      => 'institutional_id',
                            'type'    => 'select2',
                            'label'   => __('Select Institutional'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route('hotel.admin.institutional.institutional.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'placeholder' => __('-- Select --')
                            ],
                            'pre_selected'=>route('hotel.admin.institutional.institutional.getForSelect2',['pre_selected'=>1])
                        ],
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Image Background')
                        ],
                    ]
                ],
            ],
            'institutional'=>__("Service Hotel")
        ];
    }

    public function getName()
    {
        return __('Hotel: Box Institutional');
    }

    public function content($model = [])
    {
        if(!empty($model['list_item'])){
            $ids = collect($model['list_item'])->pluck('institutional_id');
            $institutions = HotelInstitutional::query()->whereIn("id",$ids)->where('status','publish')->get();
            $model['institutions'] = $institutions;
        }
        return view('Hotel::frontend.blocks.box-institutional-hotel.index', $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach ( $model['list_item'] as &$item ){
                $item['image_id_url'] = FileHelper::url($item['image_id'], 'full');
            }
        }
        return $model;
    }
}
