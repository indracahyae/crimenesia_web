<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelaku extends FormRequest
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
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'id_kota' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'tlp' => 'required',
            'email' => 'required|email',
            'foto' => 'mimes:jpeg,png,jpg|max:1000',
            'ket' => 'required',
            'id_kriminalitas' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_kota.required'          => 'Kota is required',
            'id_kriminalitas.required'  => 'Kriminalitas is required',
            'tlp.required'              => 'Telepon is required',
            'ket.required'              => 'Keterangan is required'
        ];
    }
}
