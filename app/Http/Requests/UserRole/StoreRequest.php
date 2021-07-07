<?php

namespace App\Http\Requests\UserRole;

use App\Models\User;
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
        $usersTable = (new User())->getTable();

        return [
            'name' => [ 'required', 'min:3', 'max:40' ],
            'email' => [ 'required', 'email', 'unique:' . $usersTable . ',email' ],
            'username' => [ 'required', 'alpha_num', 'min:5', 'max:20', 'unique:' . $usersTable . ',username' ],
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
            'name' => 'Nama',
            'email' => 'Email',
            'username' => 'Username'
        ];
    }
}
