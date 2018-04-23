<?php

namespace App\Http\Controllers\Society;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Masyarakat;

class MyProfileC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function detailData()
    {
        $s 	= session('loginS');
        $d = DB::table('masyarakat')
        ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
        ->select(
            'masyarakat.*', 
            'kota.nama as nama_kota',
            'kota.id_provinsi'
        )
        ->where([
                    ['masyarakat.nik', '=', $s->nik]
                ])
        ->first();
        return response()->json($d);
    }

    public function update(Request $r)
    {

        $d = Masyarakat::find($r->key);

        // cek nik
        if($r->key != $r->nik ){
            $cekNik = Masyarakat::find($r->nik);
            if(isset($cekNik->nik)){
                return response()->json(2);    
            }
        }

        // cek username
        if($d->username != $r->username ){
            $cek = Masyarakat::select('*')
                    ->where('username', '=', $r->username)
                    ->first();
            if(isset($cek->username)){
                return response()->json(3);    
            } 
        }

        // cek email
        if($d->email != $r->email ){
            $cek = Masyarakat::select('*')
                    ->where('email', '=', $r->email)
                    ->first();
            if(isset($cek->email)){
                return response()->json(4);    
            }
        }

        $d->nik   			= $r->nik;
        $d->username   		= $r->username;
        $d->password   		= $r->password;
        $d->nama   			= $r->nama;
        $d->jenis_kelamin   = $r->jenis_kelamin;
        $d->tempat_lahir   	= $r->tempat_lahir;
        $d->tanggal_lahir  	= $r->tanggal_lahir;
        $d->id_kota		   	= $r->id_kota;
        $d->alamat   		= $r->alamat;
        $d->agama   		= $r->agama;
        $d->pekerjaan   	= $r->pekerjaan;
        $d->tlp  		 	= $r->tlp;
        $d->email   		= $r->email;
        $d->save();

        // update session
        $this->updateSession($r->key);

        return response()->json(true);
    }

    public function updateFoto(Request $r)
    {
        $d  = Masyarakat::find($r->key);

        // cek foto
        if ($d->foto != 'default.png' ) {
            // delete old doc
            Storage::delete('img/society/'.$d->foto);   
        }

         // upload
         $namaFoto    = $r->key.'_'.date('Y-m-d H-i-s').'.'.$r->foto->extension();
         $r->file('foto')->move('img/society',$namaFoto);

         $d->foto     = $namaFoto;
         $d->save();

        // update session
        $this->updateSession($r->key);
         return response()->json(true);
    }

    // update session
    public function updateSession($key)
    {
        $d = DB::table('masyarakat')
                ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
                ->select(
                    'masyarakat.*', 
                    'kota.nama as nama_kota'
                )
                ->where([
                            ['masyarakat.nik', '=', $key]
                        ])
                ->first();
        session(['loginS' => $d]);
    }
}
