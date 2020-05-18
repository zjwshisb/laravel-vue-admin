<?php
namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(strtoupper($this->method()) == 'POST') {
            return [
                'name'=> ['required','max:32','unique:roles'],
                'description'=> ['required','max:255'],
                'menus'=> ['required', 'array']
            ];
        } else {
            return [
                'name'=> ['required','max:32','unique:roles'],
                'description'=> ['required','max:255'],
                'menus'=> ['required', 'array']
            ];
        }
    }

    public function messages()
    {
        return [
            'name'=> '角色名称',
            'description'=> '说明',
            'menus'=> '权限'
        ];
    }
}
