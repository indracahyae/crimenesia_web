<?php

namespace App\Http\Controllers\Society;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\KantorPolisi;

class PemetaanSC extends Controller
{

    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
	}
	
	public function listKriminalitas()
    {
		$r = DB::table('kriminalitas')
				->join('kota', 'kriminalitas.id_kota', '=', 'kota.id')
    			->select(
					'kriminalitas.alamat',
					'kriminalitas.lat',
					'kriminalitas.long',
					'kriminalitas.id_kota',
					'kota.nama AS nama_kota',
					DB::raw('count(kriminalitas.id) as jumlah_crime')
    			)
                ->where([
                    ['kriminalitas.validasi_data', '=', 1]
                ])
    			->groupBy('kriminalitas.alamat', 'kriminalitas.id_kota')
    			->get();
    	return response()->json($r);
    }

    public function detailListKriminalitas($id_kota,$alamat)
    {
    	$r = DB::table('kriminalitas')
				->join('kategori_kriminalitas', 'kriminalitas.id_kat_kriminalitas', '=', 'kategori_kriminalitas.id')
    			->select(
					'kriminalitas.judul',
    				'kriminalitas.id AS id_kriminalitas',
					'kategori_kriminalitas.nama AS nama_kategori_kriminalitas',
					'kriminalitas.waktu AS waktu_kriminalitas'
    			)
    			->where(
    				[
						['kriminalitas.validasi_data', '=', 1],
						['kriminalitas.id_kota', '=', $id_kota],
						['kriminalitas.alamat', '=', $alamat]
    				]
    			)
    			->get();
    	return response()->json($r);
	}

	public function listKantorPolisi()
	{
		$r = DB::table('kantor_polisi')
			->join('kota', 'kantor_polisi.id_kota', '=', 'kota.id')
			->select(
				'kantor_polisi.*',
				'kantor_polisi.id AS idKantorPolisi',
				'kota.nama AS nama_kota'
				)
			->orderBy('kantor_polisi.nama_kantor', 'asc')
			->get();

        return response()->json($r);
	}
	
	public function detailKriminalitas($id)
	{
		$r = DB::table('kriminalitas')
					->join('kota', 'kriminalitas.id_kota', '=', 'kota.id')
					->join('kategori_kriminalitas', 'kriminalitas.id_kat_kriminalitas', '=', 'kategori_kriminalitas.id')
					->join('kantor_polisi', 'kriminalitas.id_kantor_polisi', '=', 'kantor_polisi.id')
					->select(
						'kriminalitas.*',
						'kriminalitas.id AS id_kriminalitas',
						'kota.nama AS nama_kota',
						'kategori_kriminalitas.nama AS nama_kategori_kriminalitas',
						'kantor_polisi.nama_kantor'
						)
					->where([
						['kriminalitas.id', '=', $id]
					])
					->first();
		return response()->json($r);
	}

	public function listPelaku($id)
	{
		$r = DB::table('pelaku')
				->join('masyarakat', 'pelaku.nik', '=', 'masyarakat.nik')
				->select(
					'pelaku.*',
					'pelaku.id AS id_pelaku',
					'masyarakat.nama AS nama_pelaku',
					'masyarakat.foto'
					)
				->where([
					['pelaku.id_kriminalitas', '=', $id]
				])
				->get();
		return response()->json($r);
	}

	public function listPolygon(){
		$r = DB::table('kriminalitas')
				->join('kantor_polisi', 'kriminalitas.id_kantor_polisi', '=', 'kantor_polisi.id')
				->select(
					'kriminalitas.id_kantor_polisi',
					'kantor_polisi.nama_kantor',
					'kantor_polisi.path',
					DB::raw('count(kriminalitas.id) as jumlah_crime')
					)
				->where([
					['kriminalitas.validasi_data', '=', 1]
				])
				->groupBy('kriminalitas.id_kantor_polisi')
				->get();
		return response()->json($r);
	}
}
