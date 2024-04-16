<?php
namespace Modules\Template;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getTemplateBlocks(){
        return [
            // 'row'=>"\\Modules\\Template\\Blocks\\Row",
            // 'column'=>"\\Modules\\Template\\Blocks\\Column",
            'text'=>"\\Modules\\Template\\Blocks\\Text", 
            'video_player'=>"\\Modules\\Template\\Blocks\\VideoPlayer",
            'faqs'=>"\\Modules\\Template\\Blocks\\FaqList",
            'form_search_all_service'=>"\\Modules\\Template\\Blocks\\FormSearchAllService",
            'offer_block'=>"\\Modules\\Template\\Blocks\\OfferBlock",
            'offer_slider'=>"\\Modules\\Template\\Blocks\\OfferSlider",
            'how_it_works'=>"\\Modules\\Template\\Blocks\\HowItWork",
            'subscriber_block'=>"\\Modules\\Template\\Blocks\\SubscriberBlock",
            'mobile_box'=>"\\Modules\\Template\\Blocks\\MobileBox",
            'client_feedback'=>"\\Modules\\Template\\Blocks\\ClientFeedBack",
        ];
    }
}
