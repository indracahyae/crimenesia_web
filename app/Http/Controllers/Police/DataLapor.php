<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Pengaduan;
use App\Kriminalitas;
use App\PendukungKriminalitas;

class DataLapor extends Controller
{

    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

     public function vDataLapor()
    {
    	return view('police/DataLapor');
    }

    // list data
    public function listDataLapor()
    {
        $s=session('loginPolice');
    	$r = DB::table('pengaduan')
    			->leftJoin('masyarakat', 'pengaduan.id_pelapor', '=', 'masyarakat.nik')
    			->select(
    				'masyarakat.nama',
    				'masyarakat.nik',
    				DB::raw('count(pengaduan.id_pelapor) as jumlah_lapor')
    			)
                ->where([
                    ['pengaduan.id_kantor_polisi', '=', $s->id_kantor_polisi]
                ])
    			->groupBy('masyarakat.nik')
    			->get();
    	return response()->json($r);
    }

    // detail pelapor (data pengaduan)
    public function listDataLaporPelapor($nik)
    {
        $s=session('loginPolice');
    	$r = Pengaduan::select('*')
    				->where([
                        ['id_kantor_polisi', '=', $s->id_kantor_polisi],
                        ['id_pelapor', '=', $nik]
                    ])
                        
        			->get();
        return response()->json($r);
    }

    // detail pengaduan (kriminalitas)
    public function detailKriminalitas($id)
    {
    	$r = DB::table('kriminalitas')
                ->join('kota', 'kriminalitas.id_kota', '=', 'kota.id')
                ->join('kategori_kriminalitas', 'kriminalitas.id_kat_kriminalitas', '=', 
                    'kategori_kriminalitas.id')
                ->join('kantor_polisi', 'kriminalitas.id_kantor_polisi', '=', 'kantor_polisi.id')
                ->select('kriminalitas.*', 
                		'kriminalitas.id as id_kriminalitas',
                		'kota.nama as nama_kota',
                        'kategori_kriminalitas.nama as nama_kat_kriminalitas',
                        'kantor_polisi.nama_kantor'
                )
                ->where('kriminalitas.id_pengaduan', '=', $id)
                ->first();
        return response()->json($r);
    }

    // list pelaku (where id_kriminalitas)
    public function listPelaku($id)
    {
        $r = DB::table('pelaku')
                ->join('masyarakat', 'pelaku.nik', '=', 'masyarakat.nik')
                ->select('pelaku.*', 
                        'masyarakat.nama'
                )
                ->where('pelaku.id_kriminalitas', '=', $id)
                ->get();
        return response()->json($r);
    }

    // list bukti pendukung kriminalitas (where id_kriminalitas)
    public function listDokumenPendukung($id)
    {
        // get id kriminalitas
        $r = Kriminalitas::select('id','judul')
                    ->where('id_pengaduan', '=', $id)
                    ->first();
        // get data pendukung 
        $r = PendukungKriminalitas::select('*')
                    ->where('id_kriminalitas', '=', $r->id)
                    ->get();
        return response()->json($r);
    }

    // cari
    public function cari(Request $r)
    {
        $s=session('loginPolice');
        $r['data'] = DB::table('pengaduan')
                    ->leftJoin('masyarakat', 'pengaduan.id_pelapor', '=', 'masyarakat.nik')
                    ->select(
                        'masyarakat.nama',
                        'masyarakat.nik',
                        DB::raw('count(pengaduan.id_pelapor) as jumlah_lapor')
                    )
                    ->groupBy('masyarakat.nik')
                    ->where([
                        ['pengaduan.id_kantor_polisi', '=', $s->id_kantor_polisi],
                        ['masyarakat.nik', 'LIKE', "%$r->key%"]
                    ])
                    ->orWhere([
                        ['pengaduan.id_kantor_polisi', '=', $s->id_kantor_polisi],
                        ['masyarakat.nama', 'LIKE', "%$r->key%"]
                    ])
                    ->get();
        return response()->json($r);
    }
}
