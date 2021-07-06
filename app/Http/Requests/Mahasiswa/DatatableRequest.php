<?php

namespace App\Http\Requests\Mahasiswa;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class DatatableRequest extends FormRequest
{
    /**
     * Define properties
     *
     * @var mixed
     */
    private $allowedStatus;

    /**
     * Create new instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->allowedStatus = array_keys(Student::getAllStatus());
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
        return [
            'start' => ['integer', 'min:0'],
            'length' => ['integer', 'min:1', 'max:100'],
            'prodiId' => [ 'nullable', 'integer' ],
            'status' => [ 'nullable', 'in:-1,0,' . implode(',', $this->allowedStatus) ]
        ];
    }
}
