<?php

namespace Modules\Hotel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Hotel\Models\Hotel;
use Modules\Hotel\Models\HotelCategory;
use Modules\Hotel\Models\HotelCategoryTranslation;

class CategoryController extends Controller
{

    public $hotel_category;
    public $hotel;
    public function __construct(HotelCategory $hotel_category, Hotel $hotel)
    {
        $this->hotel_category = $hotel_category;
        $this->hotel = $hotel;
    }
    public function index(Request $request)
    {
        $listCategory = $this->hotel_category::query();
        if (!empty($search = $request->query('s'))) {
            $listCategory->where('name', 'LIKE', '%' . $search . '%');
        }
        $listCategory->orderBy('created_at', 'desc');

        $data = [
            'rows'        => $listCategory->get()->toTree(),
            'row'         => new $this->hotel_category(),
            'translation'    => new HotelCategoryTranslation(),
            'hotelCategoryHeader' => HotelCategory::where('status', 'publish')->orderBy('created_at', 'desc')->get(),
            'breadcrumbs' => [
                [
                    'name' => __('Hotel'),
                    'url'  => 'frontend/hotel'
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Hotel::frontend.category.index', $data);
    }
    public function detail(Request $request, $slug)
    {
        $row = $this->hotel_category::where('slug', $slug)->where("status", "publish")->first();;
        if (empty($row)) {
            return redirect('/');
        }

        $translation = $row->translateOrOrigin(app()->getLocale());
        $limit_location = 15;
        if (empty(setting_item("hotel_location_search_style")) or setting_item("hotel_location_search_style") == "normal") {
            $limit_location = 1000;
        }
        $data = [
            'row' => $row,
            'translation' => $translation,
            'list_location'      => Location::where('status', 'publish')->limit($limit_location)->with(['translations'])->get(),
            'list_category'      => HotelCategory::where('status', 'publish')->get()->toTree(),
            'hotel_min_max_price' => Hotel::getMinMaxPrice(),
            'rows' => $this->hotel->getListHotels($row->id),
            'seo_meta' => $row->getSeoMetaWithTranslation(app()->getLocale(), $translation),
        ];
        $this->setActiveMenu($row);
        return view('Hotel::frontend.category.detail', $data);
    }
}
