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
        if(strtoupper($this->method()) === 'POST') {
            return [
                'username'=> ['required','unique:admins','max:20'],
                'password'=> ['required','max:20'],
                'roles'=> ['required','array']
            ];
        } else {
            return [
                'roles'=> ['required','array']
            ];
        }
    }
}
