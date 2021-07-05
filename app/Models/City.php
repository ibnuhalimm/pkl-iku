<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Define table name
     *
     * @var string
     */
    protected $table = 'indonesia_cities';

    /**
     * Query to search from selectTwo
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  string|null                          $keyword
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSearchSelectTwo($query, $keyword = null)
    {
        if (!empty($keyword)) {
            return $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Query to filter by `province_id`
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  integer|null                         $province_id
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterProvince($query, $provinceId = null)
    {
        if ($provinceId > -1) {
            return $query->where('province_id', $provinceId);
        }

        return;
    }
}
