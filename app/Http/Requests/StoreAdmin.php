<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
            'akses' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'A name is required',
            'akses.required'  => 'A access is required',
            'foto.required'  => 'A photo is required',
            'foto.mimes'  => 'A photo must be jpeg,png,jpg'
        ];
    }
}
