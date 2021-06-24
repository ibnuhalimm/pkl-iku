<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

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
}
