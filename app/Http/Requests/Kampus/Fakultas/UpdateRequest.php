<?php

namespace App\Http\Requests\Kampus\Fakultas;

use App\Models\Faculty;
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

    /**
     * Create new instance
     *
     * @param  \Illuminate\Http\Request  $request
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
        $facultyTable = (new Faculty())->getTable();

        return [
            'id' => [ 'required', 'integer', 'min:0' ],
            'name' => [ 'required', 'string', 'min:3', 'unique:' . $facultyTable . ',name,' . $this->exceptId ]
        ];
    }
}
