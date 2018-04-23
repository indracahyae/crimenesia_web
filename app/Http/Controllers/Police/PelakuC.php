<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Pelaku;
use App\Masyarakat;
use App\Kriminalitas;
use App\Http\Requests\StoreSociety;
use App\Http\Requests\StorePelaku;
use Illuminate\Support\Facades\Storage;

class PelakuC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function view()
    {
    	return view('police/pelaku');
    }

    // list data
    public function listData()
    {
    	$s=session('loginPolice');
    	$r = DB::table('pelaku')
    			->join('masyarakat', 'pelaku.nik', '=', 'masyarakat.nik')
    			->join('kriminalitas', 'pelaku.id_kriminalitas', '=', 'kriminalitas.id')
    			->select(
					'pelaku.nik',
					'masyarakat.nama',
					'masyarakat.jenis_kelamin',
    				DB::raw('count(pelaku.id_kriminalitas) as jumlah_kriminalitas')
    			)
    			->where(
    				[
	    				['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
	    				['kriminalitas.validasi_data', '=', 1]
    				]
    			)
    			->groupBy('pelaku.nik')
    			->get();
    	return response()->json($r);
    }

    // del
	public function delete($id)
    {
    	$d      = Masyarakat::find($id);
		$r 		= $d->delete();

		// del foto
		if ($d->foto != 'default.png' ) {
			Storage::delete('img/society/'.$d->foto);   
		}

        return response()->json($r);
    }

	// m del
	public function mDelete(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = Masyarakat::destroy($ids);
        return response()->json($r); 
	}
	
	// detail data masyarakat
	public function detail($id)
	{
		$r = DB::table('masyarakat')
				->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
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

	// cari
	public function cari(Request $r)
	{		
		$s=session('loginPolice');
    	$r['data'] = DB::table('pelaku')
						->join('masyarakat', 'pelaku.nik', '=', 'masyarakat.nik')
						->join('kriminalitas', 'pelaku.id_kriminalitas', '=', 'kriminalitas.id')
						->select(
							'pelaku.nik',
							'masyarakat.nama',
							'masyarakat.jenis_kelamin',
							DB::raw('count(pelaku.id_kriminalitas) as jumlah_kriminalitas')
						)
						->where(
							[
								['masyarakat.nama', 'LIKE', "%$r->key%"],
								['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi],
								['kriminalitas.validasi_data', '=', 1]
							]
						)
						->groupBy('pelaku.nik')
						->get();
    	return response()->json($r);
	}

	// create (data pelaku = data masyarakat)
	public function addPelaku(StorePelaku $r)
	{
		$d = new Masyarakat;

		// VALIDASI
		// cek nik
		$cekNik = Masyarakat::find($r->nik);
        if(isset($cekNik->nik)){
            return response()->json(2);    
        }
		// cek email
		$cek = Masyarakat::select('*')
				->where('email', '=', $r->email)
				->first();
		if(isset($cek->email)){
			return response()->json(3);    
		}
		// cek foto
		if ($r->hasFile('foto')) {
            $namaFoto   = $r->nik.'_'.date('Y-m-d').'.'.$r->foto->extension();
            $r->file('foto')->move('img/society',$namaFoto);
            $d->foto    = $namaFoto;
        } else {
            $d->foto            = 'default.png';
        }

		$d->nik   				= $r->nik;
		$d->nama   				= $r->nama;
		$d->jenis_kelamin   	= $r->jenis_kelamin;
		$d->tempat_lahir   		= $r->tempat_lahir;
		$d->tanggal_lahir  		= $r->tanggal_lahir;
		$d->id_kota		   		= $r->id_kota;
		$d->alamat   			= $r->alamat;
		$d->agama   			= $r->agama;
		$d->pekerjaan   		= $r->pekerjaan;
		$d->tlp  		 		= $r->tlp;
		$d->email   			= $r->email;
		$d->save();

		// save tb pelaku (data nik)
		$d = new Pelaku;
		$d->nik   			= $r->nik;
		$d->id_kriminalitas = $r->id_kriminalitas;
		$d->ket 			= $r->ket;
		$d->timestamps 		= false;
		$d->save();

		// save data id_kriminalitas (field search pada form add)


		return response()->json(true);
	}

	public function updatePelaku(StoreSociety $r)
	{
		$d = Masyarakat::find($r->key);

		// VALIDASI
		// nik
		if($r->key != $r->nik){
            $cek = Masyarakat::find($r->nik);
            if(isset($cek->nik)){
                return response()->json(2);    
            }  

            if ($d->foto != 'default.png') {
                 // rename foto
                $ext    = explode(".",$d->foto);
                $namaFoto    = $r->nik.'_'.date('Y-m-d').'.'.$ext[1];
                Storage::move('img/society/'.$d->foto, 'img/society/'.$namaFoto);
                $d->foto             = $namaFoto;
            }
        }
		// email
		if($r->old_email != $r->email){
            $cek = Masyarakat::select('*')
                            ->where('email', '=', $r->email)
                            ->first();
            if(isset($cek->email)){
                return response()->json(3);    
            }  
        }
		// foto
		if ($r->hasFile('foto')) {
            
            if ($d->foto != 'default.png' ) {
                // delete old doc
                Storage::delete('img/society/'.$d->foto);   
            }

            // upload
            $namaFoto    = $r->nik.'_'.date('Y-m-d').'.'.$r->foto->extension();
            $r->file('foto')->move('img/society',$namaFoto);
            $d->foto             = $namaFoto;
        }

		// db
		$d->nik   				= $r->nik;
		$d->nama   				= $r->nama;
		$d->jenis_kelamin   	= $r->jenis_kelamin;
		$d->tempat_lahir   		= $r->tempat_lahir;
		$d->tanggal_lahir  		= $r->tanggal_lahir;
		$d->id_kota		   		= $r->id_kota;
		$d->alamat   			= $r->alamat;
		$d->agama   			= $r->agama;
		$d->pekerjaan   		= $r->pekerjaan;
		$d->tlp  		 		= $r->tlp;
		$d->email   			= $r->email;
		$d->save();

		// save data id_kriminalitas (field search pada form add)

		return response()->json(true);
	}

	// list crime   (modal)
	public function listCrime($id)
	{
		$s=session('loginPolice');
		$r = DB::table('pelaku')
				->join('kriminalitas', 'pelaku.id_kriminalitas', '=', 'kriminalitas.id')
				->select(
					'pelaku.*',
					'pelaku.id AS id_pelaku',
					'kriminalitas.judul',
					'kriminalitas.waktu',
					'kriminalitas.id AS id_kriminalitas'
					)
				->where(
					[
						['pelaku.nik', '=', $id],
						['kriminalitas.id_kantor_polisi', '=', $s->id_kantor_polisi]
					]
				)
				->get();
		return response()->json($r);
	}

	// delete crime (action button)
	public function deleteCrime($id) //id pada tb_pelaku
	{
		$d      = Pelaku::find($id);
		$r 		= $d->delete();
		
		// cek untuk delete data masyarakat (jika sudah tidak ada di tabel Pelaku)
		$p 		= Pelaku::select('*')
					->where('nik', '=', $d->nik)
					->first();
		if(!isset($p->nik)){
			$this->delete($d->nik); 
		}

        return response()->json(true);
	}

	// add crime	(modal)
	public function addCrime(Request $r)
	{
		$d 					= new Pelaku;
		$d->ket 			= $r->ket;
		$d->nik 			= $r->nik;
		$d->id_kriminalitas = $r->id_kriminalitas;
		$d->timestamps 		= false;
		$d->save();
		return response()->json(true);
	}

	// detail crime (OPTIONAL)
	public function detailCrime($key) // key = id_kriminalitas
	{
		$r = DB::table('pelaku')
				->join('kriminalitas', 'pelaku.id_kriminalitas', '=', 'kriminalitas.id')
				->select(
					'kriminalitas.*'
					)
				->where([
					['pelaku.id', '=', $key]
				])
				->first();
		return response()->json($r);
	}

}
