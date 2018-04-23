<?php

namespace App\Http\Controllers\Society;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Kriminalitas;
use App\PendukungKriminalitas;
use App\Pengaduan;
use App\KantorPolisi;
use App\Kota;
use App\KategoriKriminalitas;
use App\Http\Requests\StorePengaduanSociety;
use App\Http\Requests\StoreBukti;

class LaporC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function listLapor()
    {
        $s=session('loginS');
    	$r = DB::table('pengaduan')
                ->join('kantor_polisi', 'pengaduan.id_kantor_polisi', '=', 'kantor_polisi.id')
    			->select(
                    'pengaduan.id AS id_pengaduan',
                    'pengaduan.waktu AS waktu_pengaduan',
                    'pengaduan.id_pelapor',
                    'pengaduan.validasi_pengaduan',
                    'kantor_polisi.nama_kantor'
    			)
                ->where([
                    ['pengaduan.id_pelapor', '=', $s->nik]
                ])
                ->orderBy('pengaduan.waktu', 'desc')
    			->get();
    	return response()->json($r);
    }

    public function deleteLapor($id)  // data pengaduan, kriminalitas, bukti
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
        $d = Pengaduan::find($id);
        $d->delete();
        
        return response()->json(true);
    }

    public function detailLapor($id)
    {
        $r = DB::table('kriminalitas')
                ->join('pengaduan', 'kriminalitas.id_pengaduan', '=', 'pengaduan.id')
                ->join('kota','kriminalitas.id_kota','=','kota.id')
                ->join('provinsi','kota.id_provinsi','=','provinsi.id')
                ->join('kategori_kriminalitas','kriminalitas.id_kat_kriminalitas','=','kategori_kriminalitas.id')
                ->join('kantor_polisi','kriminalitas.id_kantor_polisi','=','kantor_polisi.id')
                ->select(
                    'kriminalitas.*',
                    'kriminalitas.id AS id_kriminalitas',
                    'kriminalitas.waktu AS waktu_kriminalitas',
                    'pengaduan.waktu AS waktu_pengaduan',
                    'pengaduan.validasi_pengaduan',
                    'kantor_polisi.nama_kantor',
                    'kota.nama AS nama_kota',
                    'provinsi.nama AS nama_provinsi',
                    'kota.id_provinsi',
                    'kategori_kriminalitas.nama AS nama_kat_kriminalitas'
                )
                ->where([
                    ['kriminalitas.id_pengaduan', '=', $id]
                ])
                ->first();
        return response()->json($r);
    }

    // get list kantor polisi
    public function listKantorPolisi()
    {
        $r  = KantorPolisi::orderBy('nama_kantor', 'asc')->get();
        return response()->json($r);
    }

    public function listKatCrime()
    {
        $r  = KategoriKriminalitas::orderBy('nama', 'asc')->get();
        return response()->json($r);
    }

    // create lapor
    public function createLapor(StorePengaduanSociety $r)
    {
        $s = session('loginS');

        // save data pengaduan
        $pengaduan = new Pengaduan;
        $pengaduan->id_pelapor          = $s->nik;
        $pengaduan->waktu               = date('Y-m-d H:i:s');
        $pengaduan->id_kantor_polisi    = $r->id_kantor_polisi;
        $pengaduan->validasi_pengaduan  = 3;
        $pengaduan->save();

        // select id pengaduan
        $select = Pengaduan::orderBy('waktu', 'desc')
                    ->where('id_pelapor', '=', $s->nik)
                    ->first();

        // save data kriminalitas
        $crime = new Kriminalitas;
        $crime->judul               = $r->judul;
        $crime->waktu               = $r->waktu;
        $crime->id_kota             = $r->id_kota;
        $crime->alamat              = $r->alamat;
        $crime->t_pelaku            = $r->t_pelaku;
        $crime->t_korban            = $r->t_korban;
        $crime->deskripsi_kejadian  = $r->deskripsi_kejadian;
        $crime->lat                 = $r->lat;
        $crime->long                = $r->long;
        $crime->validasi_data       = 3;
        $crime->id_pengaduan        = $select->id;
        $crime->id_kat_kriminalitas = $r->id_kat_kriminalitas;
        $crime->id_kantor_polisi    = $r->id_kantor_polisi;
        $crime->save();

        return response()->json($select->id);
    }

    // update lapor
    public function updateLapor(StorePengaduanSociety $r)
    {
        // data pengaduan
        $pengaduan = Pengaduan::find($r->key_id_pengaduan);
        $pengaduan->waktu               = date('Y-m-d H:i:s');
        $pengaduan->id_kantor_polisi    = $r->id_kantor_polisi;
        $pengaduan->save();

        // data crime
        $crime = Kriminalitas::where('id_pengaduan', '=', $r->key_id_pengaduan)->first();
        $crime->judul               = $r->judul;
        $crime->waktu               = $r->waktu;
        $crime->id_kota             = $r->id_kota;
        $crime->alamat              = $r->alamat;
        $crime->t_pelaku            = $r->t_pelaku;
        $crime->t_korban            = $r->t_korban;
        $crime->deskripsi_kejadian  = $r->deskripsi_kejadian;
        $crime->lat                 = $r->lat;
        $crime->long                = $r->long;
        $crime->id_kat_kriminalitas = $r->id_kat_kriminalitas;
        $crime->id_kantor_polisi    = $r->id_kantor_polisi;
        $crime->save();

        return response()->json(true);
    }

    // Bukti
    // list
    public function listBukti($id_kriminalitas)
    {
        $d = PendukungKriminalitas::orderBy('created_at', 'desc')
                ->where('id_kriminalitas', '=', $id_kriminalitas)
                ->get();

                return response()->json($d);
    } 

    // delete 
    public function deleteBukti($key)
    {
        // del data
        $d = PendukungKriminalitas::find($key);
        $d->delete();

        // del file
        Storage::delete('img/crime/'.$d->dokumen);
        
        return response()->json(true);
    }

    // add 
    public function createBukti(StoreBukti $r)
    {
        // foto
        $namaFoto    = $r->id_kriminalitas.'_'.date('Y-m-d H-i-s').'.'.$r->foto->extension();
        $r->file('foto')->move('img/crime',$namaFoto);

        // database
        $d = new PendukungKriminalitas;
        $d->ket = $r->ket;
        $d->dokumen = $namaFoto;
        $d->id_kriminalitas = $r->id_kriminalitas;
        $d->save();

        return response()->json(true);
    }

    // select
    public function selectBukti($id)
    {
        $d = PendukungKriminalitas::find($id);
        return response()->json($d);
    }

    // update 
    public function updateBukti(Request $r)
    {
        $d = PendukungKriminalitas::find($r->id);

        // foto
        if($r->foto != ''){
            // hapus old foto
            Storage::delete('img/crime/'.$d->dokumen);

            $namaFoto    = $r->id_kriminalitas.'_'.date('Y-m-d H-i-s').'.'.$r->foto->extension();
            $r->file('foto')->move('img/crime',$namaFoto);
            $d->dokumen = $namaFoto;
        }

        // database
        $d->ket = $r->ket;
        $d->save();

        return response()->json(true);
    }

}
