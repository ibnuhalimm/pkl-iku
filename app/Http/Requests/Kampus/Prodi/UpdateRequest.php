<?php

namespace App\Http\Requests\Kampus\Prodi;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Define properties
     *
     * @var exceptId
     */
    private $exceptId = 0;
    private $allowedFaculties = [];

    /**
     * Create new instance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->exceptId = $request->id;

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
            'id' => [ 'required', 'integer', 'min:1' ],
            'faculty_id' => [ 'required', 'integer', 'in:' . implode(',', $this->allowedFaculties) ],
            'name' => [ 'required', 'string', 'min:3', 'unique:' . $studyProgramTable . ',name,' . $this->exceptId ]
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
            'id' => 'ID',
            'faculty_id' => 'Fakultas',
            'name' => 'Nama Program Studi'
        ];
    }
}
