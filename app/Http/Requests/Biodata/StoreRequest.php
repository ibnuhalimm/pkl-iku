<?php

namespace App\Http\Requests\Biodata;

use App\Models\Biodata;
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
        $biodataTable = (new Biodata())->getTable();

        return [
            'photo' => [ 'required', 'image', 'max:5120' ],
            'id_card_number' => [ 'required', 'digits_between:16,16', 'min:16', 'max:16', 'unique:' . $biodataTable . ',id_card_number' ],
            'name' => [ 'required', 'string', 'min:3', 'max:50' ],
            'birth_place' => [ 'required', 'max:50' ],
            'birth_date' => [ 'required', 'date_format:d-m-Y' ],
            'gender' => [ 'required', 'in:L,P' ],
            'religion_id' => [ 'required' ],
            'blood_type' => [ 'required' ],
            'marital_status' => [ 'required' ],
            'email' => [ 'required', 'email', 'max:50' ],
            'phone' => [ 'required', 'max:15' ],

            'address' => [ 'required' ],
            'province_id' => [ 'required' ],
            'city_id' => [ 'required' ],
            'district_id' => [ 'required' ],
            'village_id' => [ 'required' ],

            'father_name' => [ 'required', 'string', 'min:3', 'max:50' ],
            'father_religion_id' => [ 'required' ],
            'father_profession_id' => [ 'required' ],
            'father_education_id' => [ 'required' ],
            'father_is_life' => [ 'required' ],

            'mother_name' => [ 'required', 'string', 'min:3', 'max:50' ],
            'mother_religion_id' => [ 'required' ],
            'mother_profession_id' => [ 'required' ],
            'mother_education_id' => [ 'required' ],
            'mother_is_life' => [ 'required' ],
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
            'photo'             => 'Foto',
            'id_card_number'    => 'NIK',
            'name'              => 'Nama',
            'birth_place'       => 'Tempat Lahir',
            'birth_date'        => 'Tanggal Lahir',
            'gender'            => 'Gender',
            'religion_id'       => 'Agama',
            'blood_type'        => 'Golongan Darah',
            'email'             => 'Email',
            'phone'             => 'No HP/Telepon',

            'address'           => 'Alamat',
            'province_id'       => 'Provinsi',
            'city_id'           => 'Kabupaten/Kota',
            'district_id'       => 'Kecamatan',
            'village_id'        => 'Desa/Kelurahan',

            'father_name' => 'Nama Ayah',
            'father_religion_id' => 'Agama Ayah',
            'father_profession_id' => 'Pekerjaan Ayah',
            'father_education_id' => 'Pendidikan Terakhir Ayah',
            'father_is_life' => 'Status Hidup Ayah',

            'mother_name' => 'Nama Ibu',
            'mother_religion_id' => 'Agama Ibu',
            'mother_profession_id' => 'Pekerjaan Ibu',
            'mother_education_id' => 'Pendidikan Terakhir Ibu',
            'mother_is_life' => 'Status Hidup Ibu',
        ];
    }
}
