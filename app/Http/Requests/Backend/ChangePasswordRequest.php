<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'old_password'=> ['required', function($attr, $val, $fail) {
                if(!Hash::check($val, \Auth::user()->password)) {
                    $fail(":attribute不正确");
                }
            }],
            'new_password'=> 'required'
        ];
    }
    public function attributes()
    {
       return [
           'old_password'=> '旧密码',
           'new_password'=> '新密码'
       ];
    }
}
