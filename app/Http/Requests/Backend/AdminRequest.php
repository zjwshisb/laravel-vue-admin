<?php
namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(strtoupper($this->method) === 'POST') {
            return [
                'password'=> 'required',
                'username'=> 'required',
                'is_active'=> 'required'
            ];
        } else {
            return [
                'is_active'=> 'required'
            ];
        }
    }
}
