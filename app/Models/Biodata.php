<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Biodata extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Appends custom attributes
     *
     * @var array
     */
    protected $appends = [
        'photo_url'
    ];

    /**
     * Relationship to `biodata_parents` table
     *
     * @return mixed
     */
    public function parent()
    {
        return $this->hasOne(BiodataParent::class)->withDefault();
    }

    /**
     * Relationship tp `religions` table
     *
     * @return mixed
     */
    public function religion()
    {
        return $this->belongsTo(Religion::class)->withDefault();
    }

    /**
     * Relationship tp `indonesia_provinces` table
     *
     * @return mixed
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    /**
     * Relationship tp `indonesia_cities` table
     *
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withDefault();
    }

    /**
     * Relationship tp `indonesia_district` table
     *
     * @return mixed
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }

    /**
     * Relationship tp `indonesia_village` table
     *
     * @return mixed
     */
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id')->withDefault();
    }

    /**
     * Accessor for `photo_url` attributes
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        $photoAttribute = $this->attributes['photo'] ?? '';

        if (Storage::disk('public')->exists($photoAttribute)) {
            return asset(Storage::url($photoAttribute));
        }

        return asset('img/no-image.png');
    }

    /**
     * Query to search from datatable
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  string|null                          $keyword
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSearchDatatable($query, $keyword = null)
    {
        if (!empty($keyword)) {
            return $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('birth_place', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%");
            });
        }

        return;
    }
}
