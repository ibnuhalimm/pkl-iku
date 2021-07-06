<?php

namespace App\Http\Requests\Mahasiswa;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Define properties
     *
     * @var mixed
     */
    private $exceptId = 0;

    /**
     * Create new instance
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->exceptId = $request->id;
    }

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
            'id_number' => [ 'required', 'unique:' . $studentsTable . ',id_number,' . $this->exceptId ],
            'status' => [ 'required' ],
            'month_entry' => [ 'required' ],
            'year_entry' => [ 'required', 'date_format:Y' ],
            'month_grad' => [ 'required_if:status,' . Student::STATUS_LULUS, 'nullable', ],
            'year_grad' => [ 'required_if:status,' . Student::STATUS_LULUS, 'nullable', 'date_format:Y' ]
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
            'year_entry' => 'Tahun Masuk',
            'month_grad' => 'Bulan Lulus',
            'year_grad' => 'Tahun Lulus'
        ];
    }

    /**
     * Set custom message
     *
     * @return array
     */
    public function messages()
    {
        $allStatus = Student::getAllStatus();

        return [
            'month_grad.required_if' => ':Attribute wajib diisi bila :other adalah ' . $allStatus[Student::STATUS_LULUS],
            'year_grad.required_if' => ':Attribute wajib diisi bila :other adalah ' . $allStatus[Student::STATUS_LULUS]
        ];
    }
}
