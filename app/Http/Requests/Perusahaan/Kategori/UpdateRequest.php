<?php

namespace App\Http\Requests\Perusahaan\Kategori;

use App\Models\CompanyCategory;
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
        $categoryTable = (new CompanyCategory())->getTable();

        return [
            'id' => [ 'required', 'integer', 'min:1' ],
            'name' => [ 'required', 'string', 'min:3', 'max:50', 'unique:' . $categoryTable .',name,' . $this->exceptId ]
        ];
    }

    /**
     * Get the attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'ID',
            'name' => 'Kategori Perusahaan'
        ];
    }
}
