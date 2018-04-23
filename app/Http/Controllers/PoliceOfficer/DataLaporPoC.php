<?php

namespace App\Http\Controllers\PoliceOfficer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Pengaduan;
use App\Kriminalitas;
use App\PendukungKriminalitas;

class DataLaporPoC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    // list data lapor
    public function listDataLapor()
    {
        $s=session('loginPo');
    	$r = DB::table('pengaduan')
                ->join('masyarakat', 'pengaduan.id_pelapor', '=', 'masyarakat.nik')
                ->join('kriminalitas', 'pengaduan.id', '=', 'kriminalitas.id_pengaduan')
    			->select(
                    'pengaduan.id AS id_pengaduan',
                    'pengaduan.waktu AS waktu_pengaduan',
                    'pengaduan.id_pelapor',
                    'pengaduan.validasi_pengaduan',
                    'kriminalitas.judul AS nama',
                    'masyarakat.foto'
    			)
                ->where([
                    ['pengaduan.id_kantor_polisi', '=', $s->id_kantor_polisi]
                ])
                ->orderBy('pengaduan.waktu', 'desc')
    			->get();
    	return response()->json($r);
    }

    // del data lapor (on longpres) 
    public function delDataLapor($id)
    {
        // select id_kriminalitas 
        $kriminalitas  = Kriminalitas::select('id')
                            ->where('id_pengaduan',$id)->first();

         // hapus file pendukung kriminalitas 
            // get data pendukung kriminalitas
            $pendukungKriminalitas = PendukungKriminalitas::select('*')
                                        ->where('id_kriminalitas', '=', $kriminalitas->id)
                                        ->get();
            // looping untuk delete file
            foreach ($pendukungKriminalitas as $data) {
                Storage::delete('img/crime/'.$data->dokumen);
            }

        // hapus data
        $d      = Pengaduan::select('*')
    				->where('id', '=', $id)
    				->first();
        $r = $d->delete();

        return response()->json($r);
    }

    // detail data lapor (on pres -> new screen)
    public function detailLapor($id) //id pengaduan
    {
        $r = DB::table('kriminalitas')
                ->join('pengaduan', 'kriminalitas.id_pengaduan', '=', 'pengaduan.id')
                ->join('kota','kriminalitas.id_kota','=','kota.id')
                ->join('kategori_kriminalitas','kriminalitas.id_kat_kriminalitas','=','kategori_kriminalitas.id')
                ->select(
                    'kriminalitas.*',
                    'kriminalitas.waktu AS waktu_kriminalitas',
                    'pengaduan.id_pelapor',
                    'kota.nama AS nama_kota',
                    'kategori_kriminalitas.nama AS nama_kat_kriminalitas'
                )
                ->where([
                    ['kriminalitas.id_pengaduan', '=', $id]
                ])
                ->first();
        return response()->json($r);
    }

        // detail pelapor
        public function detailPelapor($id)
        {
            $r = DB::table('masyarakat')
                    ->join('kota','masyarakat.id_kota','=','kota.id')
                    ->select(
                        'masyarakat.*',
                        'kota.nama AS nama_kota'
                    )
                    ->where([
                        ['masyarakat.nik', '=', $id]
                    ])
                    ->first();
            return response()->json($r);
        }

        // list bukti kriminalitas 
        public function listBukti($id)
        {
            $r = PendukungKriminalitas::select('*')
                    ->where('id_kriminalitas', '=', $id)
                    ->get();	
            return response()->json($r);
        }

        // validasi data lapor 
        public function validasiLapor(Request $r)
        {   // id pengaduan
            $s=session('loginPo');

            $d          = Pengaduan::find($r->id_pengaduan);
            $d->id_validator        = $s->nrp;      
            $d->validasi_pengaduan  = $r->validasi;      
            $d->save();
                        
            // update tb kriminalitas 
            $d          = Kriminalitas::find($r->id_kriminalitas);
            $d->validasi_data   = $r->validasi;       
            $d->save();

            return response()->json(1);
        }
        
}
