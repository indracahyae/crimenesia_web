<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Kriminalitas;
use App\PendukungKriminalitas;
use App\Pelaku;
use App\KategoriKriminalitas;
use App\Http\Requests\StoreKriminalitas;
use App\Http\Requests\StoreBukti;

class KriminalitasC extends Controller
{
    
	function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function view()
    {
    	return view('police/Kriminalitas');
    }

    // list Kriminalitas
    public function listData()
    {
    	$s=session('loginPolice');
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
    			->where(
    				[
	    				['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
	    				['kriminalitas.validasi_data', '=', 1]
    				]
    			)
    			->get();
    	return response()->json($r);
    }

    // delete
    public function delete($id)
    {
    	$d      = Kriminalitas::select('*')
    				->where('id', '=', $id)
    				->first();
        $r = $d->delete();
        return response()->json($r);
    }

    // multiple delete
    public function mDelete(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = Kriminalitas::destroy($ids);
        return response()->json($r); 
    }

    // detail - data kriminalitas
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
		$r->waktu = date('Y-m-d\TH:i:s', strtotime($r->waktu));
    	return response()->json($r);
    }

    // detail -> list pelaku
    public function listPelaku($id)
    {
    	$r = Pelaku::select('*')
    			->where('id_kriminalitas', '=', $id)
    			->get();	
    	return response()->json($r);	
    }

    // detail -> data pelaku
    public function detailPelaku($id)
    {
    	$r = DB::table('pelaku')
    			->join('masyarakat', 'pelaku.nik', '=', 'masyarakat.nik')
    			->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
    			->select(
    				'pelaku.*',
    				'masyarakat.*',
    				'kota.nama AS nama_kota'
    			)
    			->where([
    				['pelaku.id', '=', $id]
    			])
    			->first();
    	return response()->json($r);
    }

    // detail -> data pendukung kriminalitas / bukti
    public function detailBukti($id)
    {
    	$r = PendukungKriminalitas::select('*')
    			->where('id_kriminalitas', '=', $id)
    			->get();	
    	return response()->json($r);
    }

    // cari
    public function cari(Request $r)
    {
    	$s=session('loginPolice');
    	$r['data'] = DB::table('kriminalitas')
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
		    			->where(
		    				[
			    				['judul', 'LIKE', "%$r->key%"],
			    				['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
			    				['validasi_data', '=', 1]
		    				]
		    			)
		    			->get();
    	return response()->json($r);
    }

	// create kriminalitas
	public function store(StoreKriminalitas $r)
	{
		$s=session('loginPolice');
		$d = new Kriminalitas;
		$d->judul   			= $r->judul;
		$d->waktu   			= strftime('%Y-%m-%dT%H:%M:%S', strtotime($r->waktu));
		$d->id_kota   			= $r->id_kota;
		$d->alamat   			= $r->alamat;
		$d->t_pelaku   			= $r->t_pelaku;
		$d->t_korban   			= $r->t_korban;
		$d->deskripsi_kejadian  = $r->deskripsi_kejadian;
		$d->lat   				= $r->lat;
		$d->long   				= $r->long;
		$d->validasi_data   	= 1;
		$d->id_kat_kriminalitas = $r->id_kat_kriminalitas;
		$d->id_kantor_polisi   	= $s->id_kantor_polisi;
        $d->save();
        return response()->json(true);
	}
	
	// create bukti / pendukung kriminalitas
	public function storeBukti(StoreBukti $r)
	{
		$d = new PendukungKriminalitas;
		$d->ket   			= $r->ket;
		
		// upload dokumen
        $namaDoc   = $r->id_kriminalitas.date('Y-m-d H-i-s').'.'.$r->foto->extension();
        $r->file('foto')->move('img/crime',$namaDoc);
		
		$d->dokumen       	= $namaDoc;
		$d->id_kriminalitas	= $r->id_kriminalitas;
		$d->save();
        return response()->json(true);
	}
	
	// delete bukti / pendukung kriminalitas
	public function deleteBukti($id)
	{
		$d = PendukungKriminalitas::select('*')
						->where('id', '=', $id)
						->first();
		
		// delete file
		Storage::delete('img/crime/'.$d->dokumen);
		
		$r = $d->delete();

		return response()->json($r);	
	}

	// list kategori kriminalitas
	public function listKategoriKriminalitas()
    {
    	$r  = KategoriKriminalitas::orderBy('nama', 'asc')->get();
        return response()->json($r);
	}
	
	// update kriminalitas
	public function update(StoreKriminalitas $r)
	{
		$d          = Kriminalitas::find($r->key);
        
        $d->judul   			= $r->judul;
		$d->waktu   			= strftime('%Y-%m-%dT%H:%M:%S', strtotime($r->waktu));
		$d->id_kota   			= $r->id_kota;
		$d->alamat   			= $r->alamat;
		$d->t_pelaku   			= $r->t_pelaku;
		$d->t_korban   			= $r->t_korban;
		$d->deskripsi_kejadian  = $r->deskripsi_kejadian;
		$d->lat   				= $r->lat;
		$d->long   				= $r->long;
		$d->id_kat_kriminalitas = $r->id_kat_kriminalitas;
              
        $rs             		= $d->save();
        return response()->json($rs);
	}

	// Filter list by date
	public function listFilterByDate(Request $r)
    {
		// modify end date, agar bisa berfungsi sesuai
		$v = explode("-",$r->end);
		$v[2]= (int)$v[2]+1;
		$r->end = $v[0].'-'.$v[1].'-'.$v[2];

    	$s=session('loginPolice');
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
    			->where(
    				[
	    				['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
						['kriminalitas.validasi_data', '=', 1]
    				]
				)
				->whereBetween('kriminalitas.waktu', [$r->start, $r->end])
    			->get();
		return response()->json($r);
    }

	// filter list by category
	public function listFilterByCategory(Request $r)
    {
		$ids = explode(',', $r->ids);
    	$s=session('loginPolice');
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
    			->where(
    				[
	    				['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
						['kriminalitas.validasi_data', '=', 1]
    				]
				)
				->whereIn('kriminalitas.id_kat_kriminalitas', $ids)
    			->get();
    	return response()->json($r);
    }

}
