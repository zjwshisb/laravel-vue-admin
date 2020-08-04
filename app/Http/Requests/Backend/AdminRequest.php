<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'roles' => ['required', 'array'],
            'is_forbidden' => ['boolean']
        ];
        if (strtoupper($this->method()) === 'POST') {
            $rules['username'] = ['required', 'unique:admins', 'max:20'];
            $rules['password'] = ['required', 'max:20'];
        }
        return $rules;
    }
}
