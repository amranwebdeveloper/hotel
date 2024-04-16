<?php

namespace Modules\Hotel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Hotel\Models\Hotel;
use Modules\Hotel\Models\HotelInstitutional;
use Modules\Hotel\Models\HotelInstitutionalTranslation;

class InstitutionalController extends Controller
{

    public $hotel_institutional;
    public $hotel;
    public function __construct(HotelInstitutional $hotel_institutional, Hotel $hotel)
    {
        $this->hotel_institutional = $hotel_institutional;
        $this->hotel = $hotel;
    }
    public function index(Request $request)
    {
        $listInstitutional = $this->hotel_institutional::query();
        if (!empty($search = $request->query('s'))) {
            $listInstitutional->where('name', 'LIKE', '%' . $search . '%');
        }
        $listInstitutional->orderBy('created_at', 'desc');

        $data = [
            'rows'        => $listInstitutional->get()->toTree(),
            'row'         => new $this->hotel_institutional(),
            'translation'    => new HotelInstitutionalTranslation(),
            'hotelInstitutionalHeader' => HotelInstitutional::where('status', 'publish')->orderBy('created_at', 'desc')->get(),
            'breadcrumbs' => [
                [
                    'name' => __('Hotel'),
                    'url'  => 'frontend/hotel'
                ],
                [
                    'name'  => __('Institutional'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Hotel::frontend.institutional.index', $data);
    }
    public function detail(Request $request, $slug)
    {
        $row = $this->hotel_institutional::where('slug', $slug)->where("status", "publish")->first();;
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
            'list_institutional'      => HotelInstitutional::where('status', 'publish')->get()->toTree(),
            'hotel_min_max_price' => Hotel::getMinMaxPrice(),
            'rows' => $this->hotel->getListHotels($row->id),
            'seo_meta' => $row->getSeoMetaWithTranslation(app()->getLocale(), $translation),
        ];
        $this->setActiveMenu($row);
        return view('Hotel::frontend.institutional.detail', $data);
    }
}
