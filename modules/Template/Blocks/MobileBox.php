<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class MobileBox extends BaseBlock
{
    public function getName()
    {
        return __('Mobile Box');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('List Item(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'        => 'target_link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Target Link')
                        ],
                        [
                            'id'        => 'order',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Order')
                        ],
                    ]
                ],
                [
                    'id'    => 'scanner_image',
                    'type'  => 'uploader',
                    'label' => __('Scanner Uploader')
                ],
                [
                    'id'    => 'mobile_image',
                    'type'  => 'uploader',
                    'label' => __('Mobile Image Uploader')
                ],
            ],
            'category'=>__("Other Block")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.mobile-box.index', $model);
    }

    public function contentAPI($model = []){
        if(!empty($model['list_item'])){
            foreach (  $model['list_item'] as &$item ){
                $item['icon_image_url'] = FileHelper::url($item['icon_image'], 'full');
            }
        }
        $model['scanner_image_url'] = get_file_url($model['scanner_image'],'full');
        $model['mobile_image_url'] = get_file_url($model['mobile_image'],'full');
        return $model;
    }
}
