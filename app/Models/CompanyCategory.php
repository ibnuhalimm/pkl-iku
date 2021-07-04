<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    use HasFactory;

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
                $query->where('name', 'like', "%$keyword%");
            });
        }

        return;
    }
}
