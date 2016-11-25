<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'txtUser' => 'required|unique:qt64_users,username',
            'txtPass' => 'required',
            'txtRepass' => 'required|same:txtPass'
        ];
    }

    public function messages()
    {
        return [
            'txtUser.required' => 'Vui lòng nhập tài khoản',
            'txtUser.unique' => 'Tài khoản này đã tồn tại',
            'txtPass.required' => 'Vui lòng nhập mật khẩu',
            'txtRepass.required' => 'Nhập mật khẩu xác nhận',
            'txtRepass.same' => 'Mật khẩu không trùng nhau'
        ];
    }
}
