<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Define status field value
     *
     * @var mixed
     */
    CONST STATUS_CALON_MHS = 0;
    CONST STATUS_AKTIF = 1;
    CONST STATUS_LULUS = 2;
    CONST STATUS_DROPOUT = 3;
    CONST STATUS_PINDAH_KAMPUS = 4;
    CONST STATUS_NON_AKTIF = 10;

    /**
     * Define `degree` field value
     *
     * @var mixed
     */
    CONST DEGREE_D3 = 'D3';
    CONST DEGREE_S1 = 'S1';

    /**
     * Appends custom attributes
     *
     * @var array
     */
    protected $appends = [
        'str_status'
    ];

    /**
     * Relationship to `biodatas` table
     *
     * @return mixed
     */
    public function biodata()
    {
        return $this->belongsTo(Biodata::class)->withDefault();
    }

    /**
     * Relationship to `study_programs` table
     *
     * @return mixed
     */
    public function study_program()
    {
        return $this->belongsTo(StudyProgram::class)->withDefault();
    }

    /**
     * Get all status
     *
     * @return array
     */
    public static function getAllStatus()
    {
        return [
            self::STATUS_CALON_MHS => 'Calon Mahasiswa',
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_LULUS => 'Lulus',
            self::STATUS_DROPOUT => 'Dropout',
            self::STATUS_PINDAH_KAMPUS => 'Pindah Kampus',
            self::STATUS_NON_AKTIF => 'Non-Aktif'
        ];
    }

    /**
     * Get all degree
     *
     * @return array
     */
    public static function getAllDegree()
    {
        return [
            self::DEGREE_D3 => 'D3',
            self::DEGREE_S1 => 'Strata 1 (S1)'
        ];
    }

    /**
     * Join query to necessary table for datatable
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeJoinedDatatable($query)
    {
        $studentsTable = (new Student())->getTable();
        $biodatasTable = (new Biodata())->getTable();
        $studyProgramsTable = (new StudyProgram())->getTable();

        return $query->selectRaw("{$studentsTable}.*,
                                {$biodatasTable}.name AS biodata_name,
                                {$studyProgramsTable}.name AS study_program_name")
                ->join("{$biodatasTable}", "{$biodatasTable}.id", '=', "{$studentsTable}.biodata_id")
                ->join("{$studyProgramsTable}", "{$studyProgramsTable}.id", '=', "{$studentsTable}.study_program_id");
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
            $studentsTable = (new Student())->getTable();
            $biodatasTable = (new Biodata())->getTable();
            $studyProgramsTable = (new StudyProgram())->getTable();

            return $query->where(function($query) use (
                $keyword, $studentsTable, $biodatasTable, $studyProgramsTable
            ) {
                $query->where("{$biodatasTable}.name", 'like', "%$keyword%")
                    ->orWhere("{$studyProgramsTable}.name", 'like', "%$keyword%")
                    ->orWhere("{$studentsTable}.degree", 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Query to filter by `study_program_id`
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  int|null                             $studyProgramId
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterStudyProgram($query, $studyProgramId = null)
    {
        if ($studyProgramId > -1) {
            return $query->where('study_program_id', $studyProgramId);
        }

        return;
    }

    /**
     * Query to filter by `status`
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  int|null                             $status
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterStatus($query, $status = null)
    {
        if ($status > 0) {
            return $query->where('status', $status);
        }

        return;
    }

    /**
     * Query to get only alumni
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeAlumni($query)
    {
        return $query->where('status', self::STATUS_LULUS);
    }

    /**
     * Join query for select2
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeJoinedSelectTwo($query)
    {
        $studentsTable = $this->getTable();
        $biodatasTable = (new Biodata())->getTable();

        return $query->selectRaw("{$studentsTable}.*,
                            {$biodatasTable}.name AS student_name")
                ->join("{$biodatasTable}", "{$biodatasTable}.id", '=', "{$studentsTable}.biodata_id");
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
            $studentsTable = $this->getTable();
            $biodatasTable = (new Biodata())->getTable();

            return $query->where(function($query) use (
                $keyword, $studentsTable, $biodatasTable
                ) {
                $query->where("{$studentsTable}.id_number", 'like', "%$keyword%")
                    ->orWhere("{$biodatasTable}.name", 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Accessor for `str_status`
     *
     * @return string
     */
    public function getStrStatusAttribute()
    {
        $allStatus = self::getAllStatus();
        $statusAttribute = $this->attributes['status'] ?? '';

        return $allStatus[$statusAttribute] ?? 'Unknown';
    }
}
