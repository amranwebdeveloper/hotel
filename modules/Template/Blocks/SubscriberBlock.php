<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class SubscriberBlock extends BaseBlock
{
    public function getName()
    {
        return __('Subscriber Block');
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
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'    => 'background_image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
            ],
            'category'=>__("Other Block")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.subscriber-block.index', $model);
    }

    public function contentAPI($model = []){
        $model['background_image_url'] = get_file_url($model['background_image'],'full');
        return $model;
    }
}
