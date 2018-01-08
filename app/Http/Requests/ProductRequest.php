<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "txtName"        => "required",
            "txtDescription" => "required",
            "txtDetail"      => "required",
            "txtUnitPrice"   => "required|numeric",
            "txtPromoPrice"  => "numeric",  
        ];
    }
    public function messages()
    {
        return [
            "txtName.required"        => "Bạn chưa nhập Tên sản phẩm",
            "txtDescription.required" => "Bạn chưa nhập miêu tả",
            "txtDetail.required"      => "Bạn chưa nhập chi tiết sản phẩm",
            "txtUnitPrice.required"   => "Bạn chưa nhập giá đơn giá",
            "txtUnitPrice.numeric"    => "Đơn giá phải là số",
            "txtPromoPrice.numeric"   => "Giá khuyến mãi phải là số",  
        ];
    }
}
