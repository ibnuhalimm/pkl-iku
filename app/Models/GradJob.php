<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradJob extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Define `job_category` field value
     *
     * @var mixed
     */
    CONST JOB_CATEGORY_EMPLOYEE = 1;
    CONST JOB_CATEGORY_ENTREPENEUR = 2;
    CONST JOB_CATEGORY_FREELANCE = 3;

    /**
     * Define `emp_type` field value
     *
     * @var mixed
     */
    CONST EMP_TYPE_CONTRACT = 1;
    CONST EMP_TYPE_PERMANENT = 2;
    CONST EMP_TYPE_CIVIL = 3;

    /**
     * Define `bus_type` field value
     *
     * @var mixed
     */
    CONST BUS_TYPE_PERSONAL = 1;
    CONST BUS_TYPE_FIRMA = 2;
    CONST BUS_TYPE_CV = 3;
    CONST BUS_TYPE_PT = 4;

    /**
     * Get all Job Category
     *
     * @return array
     */
    public static function getAllJobCategory()
    {
        return [
            self::JOB_CATEGORY_EMPLOYEE => 'Karyawan',
            self::JOB_CATEGORY_ENTREPENEUR => 'Pengusaha / Wiraswasta',
            self::JOB_CATEGORY_FREELANCE => 'Pekerja Lepas / Konsultan'
        ];
    }

    /**
     * Get all Emp Type
     *
     * @return array
     */
    public static function getAllEmpType()
    {
        return [
            self::EMP_TYPE_CONTRACT => 'Karyawan Kontrak',
            self::EMP_TYPE_PERMANENT => 'Karyawan Tetap',
            self::EMP_TYPE_CIVIL => 'Pegawai Negeri Sipil'
        ];
    }

    /**
     * Get all Bus Type
     *
     * @return array
     */
    public static function getAllBusType()
    {
        return [
            self::BUS_TYPE_PERSONAL => 'Perseorangan',
            self::BUS_TYPE_FIRMA => 'Firma',
            self::BUS_TYPE_CV => 'CV (Perseroan Komanditer)',
            self::BUS_TYPE_PT => 'PT (Perseroan Terbatas)'
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
        $gradJobTable = $this->getTable();
        $studentsTable = (new Student())->getTable();
        $biodatasTable = (new Biodata())->getTable();
        $companiesTable = (new Company())->getTable();

        return $query->selectRaw("{$gradJobTable}.*,
                            {$studentsTable}.month_grad AS student_month_grad,
                            {$studentsTable}.year_grad AS student_year_grad,
                            {$studentsTable}.id_number AS student_id_number,
                            {$biodatasTable}.name AS student_name,
                            {$companiesTable}.name AS company_name")
                ->join("{$studentsTable}", "{$studentsTable}.id", '=', "{$gradJobTable}.student_id")
                ->join("{$biodatasTable}", "{$biodatasTable}.id", '=', "{$studentsTable}.biodata_id")
                ->join("{$companiesTable}", "{$companiesTable}.id", '=', "{$gradJobTable}.company_id");
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
            $gradJobTable = $this->getTable();
            $studentsTable = (new Student())->getTable();
            $biodatasTable = (new Biodata())->getTable();
            $companiesTable = (new Company())->getTable();

            return $query->where(function($query) use (
                $keyword, $gradJobTable, $studentsTable, $biodatasTable, $companiesTable
            ) {
                $query->where("{$biodatasTable}.name", 'like', "%$keyword%")
                    ->orWhere("{$companiesTable}.name", 'like', "%$keyword%");
            });
        }

        return;
    }

    /**
     * Query to filter by year of `date_start`
     *
     * @param  \Illuminate\Database\Query\Builder   $query
     * @param  int|null                             $year
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFilterYear($query, $year = null)
    {
        if ($year > -1) {
            return $query->whereYear('date_start', $year);
        }

        return;
    }
}
