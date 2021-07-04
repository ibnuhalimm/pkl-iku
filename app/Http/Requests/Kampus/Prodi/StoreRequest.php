<?php

namespace App\Http\Requests\Kampus\Prodi;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Define properties
     *
     * @var mixed
     */
    private $allowedFaculties = [];

    /**
     * Create new instance
     *
     * @return void
     */
    public function __construct()
    {
        $faculties = Faculty::selectRaw('id')->get();

        $faculties->map(function($faculty) {
            array_push($this->allowedFaculties, $faculty->id);
        });
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
        $studyProgramTable = (new StudyProgram())->getTable();

        return [
            'faculty_id' => [ 'required', 'integer', 'in:' . implode(',', $this->allowedFaculties) ],
            'name' => [ 'required', 'string', 'min:3', 'max:50', 'unique:'. $studyProgramTable .',name' ]
        ];
    }

    /**
     * Get the field name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'faculty_id' => 'Fakultas',
            'name' => 'Nama Program Studi'
        ];
    }
}
