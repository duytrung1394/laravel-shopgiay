<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequests extends FormRequest
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
            'txtEmail'      => "required|email",
            'txtFirstName'  => "required",
            'txtLastName'   => "required",
            'txtGender'     => "required",
            'txtPhone'      => "numeric",
            'txtAddress'    => "required",
            'txtTotalPrice' => "numeric",
        ];
    }
    public function messages()
    {
        return [
            "txtEmail.required"     => "Bạn chưa nhập Email",
            "txtEmail.email"        => "Phải có định dạng email",
            "txtFirstName.required" => "Bạn chưa nhập Họ",
            "txtLastName.required"  => "Bạn chưa nhập Tên",
            "txtGender.required"    => "Bạn chưa chọn giới tính",
            "txtAddress.numeric"    => "Bạn chưa nhập địa chỉ",
            "txtTotalPrice.numeric" => "Tổng giá phải là sô",  
            "txtPhone.numeric"      => "Số điện thoại phải là sô",  
        ];

    }
}
