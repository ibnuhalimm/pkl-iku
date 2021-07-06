<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiodataParent extends Model
{
    use SoftDeletes;

    /**
     * Relationship tp `religions` table
     *
     * @return mixed
     */
    public function father_religion()
    {
        return $this->belongsTo(Religion::class, 'father_religion_id');
    }

    /**
     * Relationship tp `professions` table
     *
     * @return mixed
     */
    public function father_profession()
    {
        return $this->belongsTo(Profession::class, 'father_profession_id');
    }

    /**
     * Relationship tp `educations` table
     *
     * @return mixed
     */
    public function father_education()
    {
        return $this->belongsTo(Education::class, 'father_education_id');
    }

    /**
     * Relationship tp `religions` table
     *
     * @return mixed
     */
    public function mother_religion()
    {
        return $this->belongsTo(Religion::class, 'mother_religion_id');
    }

    /**
     * Relationship tp `professions` table
     *
     * @return mixed
     */
    public function mother_profession()
    {
        return $this->belongsTo(Profession::class, 'mother_profession_id');
    }

    /**
     * Relationship tp `educations` table
     *
     * @return mixed
     */
    public function mother_education()
    {
        return $this->belongsTo(Education::class, 'mother_education_id');
    }
}
