<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgram extends Model
{
    use SoftDeletes;

    /**
     * Relationship to `faculty`
     *
     * @return mixed
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class)->withDefault();
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
                $query->where('name', 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Query to filter by faculty_id
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  int|null                          $facultyId
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFacultyFilter($query, $facultyId = null)
    {
        if ($facultyId > 0) {
            return $query->where('faculty_id', $facultyId);
        }

        return;
    }
}
