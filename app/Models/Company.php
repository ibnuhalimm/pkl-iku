<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Relations ship to `company_categories` table
     *
     * @return mixed
     */
    public function company_category()
    {
        return $this->belongsTo(CompanyCategory::class)->withDefault();
    }

    /**
     * Relations ship to `indonesia_provinces` table
     *
     * @return mixed
     */
    public function province()
    {
        return $this->belongsTo(Province::class)->withDefault();
    }

    /**
     * Relations ship to `indonesia_cities` table
     *
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
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
                    ->orWhere('brand', 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Query to search from select2
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  string|null                          $keyword
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSearchSelectTwo($query, $keyword = null)
    {
        if (!empty($keyword)) {
            return $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('brand', 'like', "%$keyword%");
            });
        }

        return;
    }
}
