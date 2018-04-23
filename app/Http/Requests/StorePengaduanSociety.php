<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanSociety extends FormRequest
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
            'judul' => 'required',
            'alamat' => 'required',
            'id_kantor_polisi' => 'required',
            'waktu' => 'required',   
            'id_kota' => 'required',  
            't_pelaku' => 'required',    
            't_korban' => 'required',   
            'deskripsi_kejadian' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'id_kat_kriminalitas' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'judul.required' => 'Judul is required',
            'alamat.required'  => 'Alamat is required',
            'id_kantor_polisi.required'  => 'Kantor Polisi is required',
            'waktu.required' => 'Waktu is required',
            'id_kota.required' => 'Kota is required',
            't_pelaku.required' => 'Pelaku is required',
            't_korban.required' => 'Korban is required',
            'deskripsi_kejadian.required' => 'Deskripsi Kejadian is required',
            'lat.required' => 'Latitude is required',
            'long.required' => 'Longitude is required',
            'id_kat_kriminalitas.required' => 'Kategori kriminalitas is required'
        ];
    }
}
