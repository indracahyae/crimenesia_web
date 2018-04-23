<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmin extends FormRequest
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
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'akses' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'A name is required',
            'akses.required'  => 'A access is required',
        ];
    }
}
