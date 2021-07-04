<?php

namespace App\Http\Requests\Perusahaan\Kategori;

use App\Models\CompanyCategory;
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
        $categoryTable = (new CompanyCategory())->getTable();

        return [
            'name' => [ 'required', 'string', 'min:3', 'max:50', 'unique:' . $categoryTable .',name' ]
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
            'name' => 'Kategori Perusahaan'
        ];
    }
}
