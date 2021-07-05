<?php

namespace App\Http\Requests\Perusahaan\Data;

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
        return [
            'company_category_id' => [ 'required', 'integer', 'min:1' ],
            'name' => [ 'required', 'string', 'max:100' ],
            'brand' => [ 'nullable', 'string', 'max:100' ],
            'address' => [ 'nullable' ],
            'province_id' => [ 'required', 'integer', 'min:1' ],
            'city_id' => [ 'required', 'integer', 'min:1' ]
        ];
    }

    /**
     * Get the validation attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'company_category_id' => 'Kategori',
            'name' => 'Nama Perusahaan',
            'brand' => 'Brand',
            'address' => 'Alamat',
            'province_id' => 'Provinsi',
            'city_id' => 'Kabupaten/Kota'
        ];
    }
}
