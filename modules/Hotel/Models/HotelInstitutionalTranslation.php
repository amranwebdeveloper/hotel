<?php
namespace Modules\Hotel\Models;

use App\BaseModel;

class HotelInstitutionalTranslation extends BaseModel
{
    protected $table = 'bravo_hotel_institutional_translations';
    protected $fillable = [
        'name',
        'title',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}
