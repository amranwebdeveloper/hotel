<?php
namespace Modules\Hotel\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelInstitutional extends BaseModel
{
    use SoftDeletes;
    use NodeTrait;
    protected $table = 'bravo_hotel_institutional';
    protected $fillable = [
        'name',
        'content',
        'title',
        'slug',
        'status',
        'parent_id',
        'banner_image_id',
        'icon_image_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("Hotel Institutional");
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {
            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->orderBy('id', 'desc')->limit(10)->get();
        return $a;
    }
    public function getDetailUrl(){
        return url(app_get_locale(false, false, '/') . config('hotel.hotel_cat_route_prefix'). '/' . $this->slug);
    }

    public static function getLinkForPageSearch($locale = false, $param = [])
    {
        return url(app_get_locale(false, false, '/') . config('hotel.hotel_route_prefix') . "?" . http_build_query($param));
    }

    public function dataForApi(){
        $translation = $this->translateOrOrigin(app()->getLocale());
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
            'title'=>$translation->title,
            'slug'=>$this->slug,
        ];
    }
}
