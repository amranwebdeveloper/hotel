<?php

namespace Modules\Hotel;

use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Hotel\Models\Hotel;
use Modules\Hotel\Models\HotelCategory;
use Modules\Hotel\Models\HotelInstitutional;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper)
    {

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if (is_installed() and Hotel::isEnable()) {

            $sitemapHelper->add("hotel", [app()->make(Hotel::class), 'getForSitemap']);
        }
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if (!Hotel::isEnable()) return [];
        return [
            'hotel' => [
                "position" => 32,
                'url'        => route('hotel.admin.index'),
                'title'      => __('Hotel'),
                'icon'       => 'fa fa-building-o',
                'permission' => 'hotel_view',
                'children'   => [
                    'add' => [
                        'url'        => route('hotel.admin.index'),
                        'title'      => __('All Hotels'),
                        'permission' => 'hotel_view',
                    ],
                    'create' => [
                        'url'        => route('hotel.admin.create'),
                        'title'      => __('Add new Hotel'),
                        'permission' => 'hotel_create',
                    ],
                    'hotel_category' => [
                        'url'        => route('hotel.admin.category.index'),
                        'title'      => __('Categories'),
                        'permission' => 'hotel_manage_others',
                    ],
                    'hotel_institutional' => [
                        'url'        => route('hotel.admin.institutional.index'),
                        'title'      => __('Institutions'),
                        'permission' => 'hotel_manage_others',
                    ],
                    'attribute' => [
                        'url'        => route('hotel.admin.attribute.index'),
                        'title'      => __('Attributes'),
                        'permission' => 'hotel_manage_attributes',
                    ],
                    'room_attribute' => [
                        'url'        => route('hotel.admin.room.attribute.index'),
                        'title'      => __('Room Attributes'),
                        'permission' => 'hotel_manage_attributes',
                    ],
                    'recovery' => [
                        'url'        => route('hotel.admin.recovery'),
                        'title'      => __('Recovery'),
                        'permission' => 'hotel_view',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if (!Hotel::isEnable()) return [];
        return [
            'hotel' => Hotel::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if (!Hotel::isEnable()) return [];
        return [
            'hotel' => [
                'class' => Hotel::class,
                'name'  => __("Hotel"),
                'items' => Hotel::searchForMenu(),
                'position' => 41
            ],
            [
                'class' => HotelCategory::class,
                'name'  => __("Hotel Category"),
                'items' => HotelCategory::searchForMenu(),
                'position' => 42
            ],
            [
                'class' => HotelInstitutional::class,
                'name'  => __("Hotel Institutional"),
                'items' => HotelInstitutional::searchForMenu(),
                'position' => 43
            ],
        ];
    }


    public static function getUserMenu()
    {
        $res = [];
        if (Hotel::isEnable()) {
            $res['hotel'] = [
                'url'   => route('hotel.vendor.index'),
                'title'      => __("Manage Hotel"),
                'icon'       => Hotel::getServiceIconFeatured(),
                'position'   => 30,
                'permission' => 'hotel_view',
                'children' => [
                    [
                        'url'   => route('hotel.vendor.index'),
                        'title'  => __("All Hotels"),
                    ],
                    [
                        'url'   => route('hotel.vendor.create'),
                        'title'      => __("Add Hotel"),
                        'permission' => 'hotel_create',
                    ],
                    [
                        'url'   => route('hotel.vendor.recovery'),
                        'title'      => __("Recovery"),
                        'permission' => 'hotel_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks()
    {
        if (!Hotel::isEnable()) return [];
        return [
            'form_search_hotel' => "\\Modules\\Hotel\\Blocks\\FormSearchHotel",
            'list_hotel' => "\\Modules\\Hotel\\Blocks\\ListHotel",
            'box_category_hotel'=>"\\Modules\\Hotel\\Blocks\\BoxCategoryHotel",
            'box_institutional_hotel'=>"\\Modules\\Hotel\\Blocks\\BoxInstitutionalHotel",
            'hotel_category_thumbnail'=>"\\Modules\\Hotel\\Blocks\\HotelCategoryThumbnail",
        ];
    }
}
