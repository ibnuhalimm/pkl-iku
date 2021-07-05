<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    /**
     * Define table name
     *
     * @var string
     */
    protected $table = 'indonesia_provinces';

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
}
