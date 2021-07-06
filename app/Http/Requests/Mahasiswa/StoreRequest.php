<?php

namespace App\Http\Requests\Mahasiswa;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $studentsTable = (new Student())->getTable();

        return [
            'biodata_id' => [ 'required', 'integer' ],
            'degree' => [ 'required' ],
            'study_program_id' => [ 'required', 'integer' ],
            'id_number' => [ 'required', 'unique:' . $studentsTable . ',id_number' ],
            'status' => [ 'required' ],
            'month_entry' => [ 'required' ],
            'year_entry' => [ 'required', 'date_format:Y' ]
        ];
    }

    /**
     * Get the validation attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'biodata_id' => 'Biodata',
            'degree' => 'Jenjang',
            'study_program_id' => 'Program Studi',
            'id_number' => 'NIM',
            'status' => 'Status',
            'month_entry' => 'Bulan Masuk',
            'year_entry' => 'Tahun Masuk'
        ];
    }
}
