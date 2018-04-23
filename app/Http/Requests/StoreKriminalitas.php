<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKriminalitas extends FormRequest
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
            'judul'                 => 'required',
            'id_kota'               => 'required',
            'alamat'                => 'required',
            't_pelaku'              => 'required',
            't_korban'              => 'required',
            'deskripsi_kejadian'    => 'required',
            'lat'                   => 'required',
            'long'                  => 'required',
            'id_kat_kriminalitas'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_kota.required'              => 'Kota is required',
            't_pelaku.required'             => 'Pelaku is required',
            't_korban.required'             => 'Korban is required',
            'lat.required'                  => 'Latitude is required',
            'long.required'                 => 'Longitude is required',
            'id_kat_kriminalitas.required'  => 'Kategori Kriminalitas is required',
        ];
    }
}
