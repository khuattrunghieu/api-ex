<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'email' => [
                'required',
                'unique:users,email',
            ],
            'name' => ['required'],
            'password' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được để trống',
            'email.required'=> 'Email không để trống',
            'email.unique' => 'Email đã đăng ký tài khoản, vui lòng xử dụng email khác',
            'password.required'=>'Mật khẩu không để trống',
        ];
    }
}
