<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRole
 * @package App\Http\Requests
 * @author zjw
 * 新增角色校验
 */
class StoreRole extends FormRequest
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
            'name'=>'required',
            'permissions'=> 'array'
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'角色名称',
            'permissions'=> '权限'
        ];
    }
}
