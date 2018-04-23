<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePolice extends FormRequest
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
            'nrp'               => 'required',
            'pangkat_polisi'    => 'required',
            'jabatan_polisi'    => 'required',
            'nik'               => 'required',
            'dokumen'           => 'mimes:jpeg,jpg,pdf|max:1500',
        ];
    }
}
