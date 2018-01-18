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
            'txtFirstName'   => "required|min:2",
            'txtLastName'    => "required|min:2",
            'txtEmail'       => "required|email",
            'txtPass'        => "required|min:6|max:30",
            'txtConfirmPass' => "required|same:txtPass",         //Same:txtpass bắt buộc phải giốngtxtpass 
        ];
    }
    public function messages()
    {
        return [
            'txtFirstName.required'   => "Bạn chưa nhập họ",
            'txtFirstName.min'        => "Họ phải có ít nhất 2 kí tự",
            'txtLastName.required'    => "Bạn chưa nhập tên",
            'txtLastName.min'         => "Tên phải có ít nhất 2 kí tự",
            'txtEmail.required'       => "Bạn chưa nhập Email",
            'txtEmail.email'          => "Bạn chưa nhập đúng định dạng Email",
            "txtPass.required"        => "Bạn chưa nhập mật khẩu",
            'txtPass.min'             => "Mật khẩu có ít nhất 6 kí tự",
            "txtPass.max"             => "Mật khẩu không được quá 30 kí tự",
            "txtConfirmPass.required" => "Bạn chưa Confirm mật khẩu",
            "txtConfirmPass.same"     => "Mật khẩu không khớp",
        ];
    }
}
