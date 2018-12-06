<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAdmin
 * @package App\Http\Requests
 * @author zjw
 *
 */
class StoreAdmin extends FormRequest
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
            'username'=>'required|unique:admins,username',
            'password'=>'required',

        ];
    }

    public function attributes()
    {
        return [
            'username'=> '登录账号',
            'password'=> '用户名'
        ];
    }
}
