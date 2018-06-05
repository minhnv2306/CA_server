<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:certs',
            'identification_card' => 'required|max:255|unique:certs',
            'name' => 'required',
            'phone_number' => 'required',
            'date_create_id_cart' => 'required',
            'where_create_id_cart' => 'required',
            'deadline' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'Email đã tồn tại',
            'identification_card.unique'  => 'Số chứng minh thư đã tồn tại',
        ];
    }
}
