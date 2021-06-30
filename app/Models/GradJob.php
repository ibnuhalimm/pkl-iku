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
    CONST EMP_TYPE_CONTACT = 1;
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
            self::EMP_TYPE_CONTACT => 'Karyawan Kontrak',
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
}
