<?php

namespace App\Http\Requests\Perusahaan\Kategori;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'id' => [ 'required', 'integer', 'min:1' ]
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
            'id' => 'ID'
        ];
    }
}
