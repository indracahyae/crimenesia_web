<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBukti extends FormRequest
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
            'ket'               => 'required',
            'id_kriminalitas'   => 'required',
            'foto'              => 'required|mimes:jpeg,png,jpg,pdf|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'ket.required'              => 'Keterangan is required',
            'id_kriminalitas.required'  => 'Id Kriminalitas is required'
        ];
    }
}
