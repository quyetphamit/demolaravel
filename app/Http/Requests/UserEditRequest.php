<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
        $rule = [];
        if ($this->input('txtPass')) {
            $rule = [
                'txtRepass' => 'required'
            ];
        }
        if ($this->input('txtRepass')) {
            $rule = [
                'txtPass' => 'required'
            ];
        }
        if ($this->input('txtPass') && $this->input('txtRepass')) {
            $rule = [
                'txtRepass' => 'same:txtPass'
            ];
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'txtRepass.required' => 'Mật khẩu xác nhận không được để trống',
            'txtPass.required' => 'Mật khẩu mới không khớp',
            'txtRepass.same' => 'Mật khẩu không khớp nhau'
        ];
    }
}
