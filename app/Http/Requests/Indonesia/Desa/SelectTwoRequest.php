<?php

namespace App\Http\Requests\Indonesia\Desa;

use Illuminate\Foundation\Http\FormRequest;

class SelectTwoRequest extends FormRequest
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
            'districtId' => [ 'required', 'integer', 'min:-1' ],
            'page' => [ 'required', 'integer', 'min:1' ],
            'search' => [ 'nullable', 'string' ],
            'allowAll' => [ 'nullable', 'in:true,false' ]
        ];
    }
}
