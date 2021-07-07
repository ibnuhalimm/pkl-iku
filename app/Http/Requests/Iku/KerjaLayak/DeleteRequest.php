<?php

namespace App\Http\Requests\Iku\KerjaLayak;

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
            'id' => [ 'required', 'integer' ]
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
            'id' => 'ID'
        ];
    }
}
