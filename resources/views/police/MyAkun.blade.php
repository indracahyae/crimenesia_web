@extends('police.template')

@section('page_title')
	{{'
		My Account - Police
	'}}
@endsection

@section('page_content')
	<div class="ui centered teal card myAkunPolice">
	  <div class="image myAccountPolice">
	    <img class="foto myAccountPolice" src="">
	  </div>
	  <div class="content">
	    <div class="ui list">
		  <div class="item">
		    <div class="header">NRP</div>
		    <i class="nrp myAccountPolice"> </i>
		  </div>
		  <div class="item">
		    <div class="header">Nama</div>
		    <i class="nama myAccountPolice"> </i>
		  </div>
		  <div class="item">
		    <div class="header">Pangkat</div>
		    <i class="pangkat myAccountPolice"> </i>
		  </div>
		  <div class="item">
		    <div class="header">Jabatan</div>
		    <i class="jabatan myAccountPolice"> </i>
		  </div>
		  <div class="item">
		    <div class="header">NIK</div>
		    <i class="nik myAccountPolice"> </i>
		  </div>
		  <div class="item">
		    <div class="header">Dokumen</div>
		    <a id="myAccountPolice_dokumen" href="" target="_blank">
		    	<i class="dokumen myAccountPolice"> </i>
		    </a>
		  </div>
		  <div class="item">
		    <div class="header">Kantor Polisi</div>
		    <i class="kantor myAccountPolice"> </i>
		  </div>
		</div>
	  </div>
	  <div class="extra content">
	  	<a class="left floated edit btn myAccountPoliceDataSociety">
	      <i class="user teal icon"></i>
	      Data Society
	    </a>
	    <a class="right floated edit btn myAccountPoliceDataPolice">
	      <i class="address card teal icon"></i>
	      Data Police
	    </a>
	  </div>
	</div>

	<!-- modal edit data society -->
	<div class="ui modal myAkunPoliceDataSociety">
      <i class="close icon"></i>
      <div class="header">
       Data Society
      </div>
      <div class="content">
        <form class="ui form myAkunPoliceDataSociety" >
            <input type="hidden" value="" name="key_society" id="key_society">
            <input type="hidden" value="" name="old_email" id="old_email">
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="myAkunPoliceDataSociety_nik" placeholder="NIK">
            </div>
            <div class="field">
                <label>Password</label>
                <input type="text" name="password" id="myAkunPoliceDataSociety_password" placeholder="Password">
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" id="myAkunPoliceDataSociety_nama" placeholder="Nama">
            </div>
            <div class="field">
              <label>Jenis Kelamin</label>
              <select class="ui dropdown jenis_kelamin" name="jenis_kelamin" id="myAkunPoliceDataSociety_kelamin">
                <option value="">...</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div> 
            <div class="field">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="myAkunPoliceDataSociety_tempatLahir" placeholder="Tempat Lahir">
            </div>
            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="myAkunPoliceDataSociety_tanggalLahir" placeholder="Tanggal Lahir">
            </div>
            <div class="field">
              <label>Kabupaten / Kota</label>
              <select class="ui search dropdown kota" name="id_kota" id="ddKota">
               	<option value="">...</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div>
            <div class="field">
                <label>Alamat</label>
                <input type="text" name="alamat" id="myAkunPoliceDataSociety_alamat" placeholder="Alamat">
            </div>
            <div class="field">
              <label>Agama</label>
              <select class="ui dropdown agama" name="agama" id="myAkunPoliceDataSociety_agama">
                <option value="">...</option>
                <option value="0">Islam</option>
                <option value="1">Kristen</option>
                <option value="2">Hindu</option>
                <option value="3">Buddha</option>
                <option value="4">Konghucu</option>
              </select>
            </div>
            <div class="field">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" id="myAkunPoliceDataSociety_pekerjaan" placeholder="Pekerjaan">
            </div>
            <div class="field">
                <label>Tlp.</label>
                <input type="number" name="tlp" id="myAkunPoliceDataSociety_tlp" placeholder="Telephone Number">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" id="myAkunPoliceDataSociety_email" placeholder="Email">
            </div>
            <div class="field">
                <label>Photo</label>
                <input type="file" name="foto" id="" placeholder="">
            </div>
        </form>
      </div>
      <div class="actions">
        <div class="ui button cancel" style="user-select: auto;">Cancel</div>
        <div class="ui brown button update_myAkunPoliceDataSociety" style="user-select: auto;">Update</div>
      </div>
    </div>

	<!-- modal edit data police -->
	<div class="ui modal myAkunPoliceDataPolice">
      <i class="close icon"></i>
      <div class="header">
        Data Police
      </div>
      <div class="content">
        <form class="ui form myAkunPoliceDataPolice" >
            <input type="hidden" value="" name="key_police" id="key_police">
            <input type="hidden" value="" name="old_nik" id="myAkunPoliceDataPolice_old_nik">
            <div class="field">
                <label>NRP</label>
                <input type="number" name="nrp" id="myAkunPoliceDataPolice_nrp" placeholder="">
            </div>
            <div class="field">
                <label>Pangkat Polisi</label>
                <select class="ui dropdown pangkatPolisi" name="pangkat_polisi" id="myAkunPoliceDataPolice_pangkat">
                  <option value="">...</option>
                  <option value="0">Bhayangkara Dua</option>
                  <option value="1">Bhayangkara Satu</option>
                  <option value="2">Bhayangkara Kepala</option>
                  <option value="3">Ajun Brigadir Polisi Dua</option>
                  <option value="4">Ajun Brigadir Polisi Satu</option>
                  <option value="5">Ajun Brigadir Polisi</option>
                  <option value="6">Brigadir Polisi Dua</option>
                  <option value="7">Brigadir Polisi Satu</option>
                  <option value="8">Brigadir Polisi</option>
                  <option value="9">Brigadir Polisi Kepala</option>
                  <option value="10">Ajun Inspektur Polisi Dua</option>
                  <option value="11">Ajun Inspektur Polisi Satu</option>
                  <option value="12">Inspektur Polisi Dua</option>
                  <option value="13">Inspektur Polisi Satu</option>
                  <option value="14">Ajun Komisaris Polisi</option>
                  <option value="15">Komisaris Polisi</option>
                  <option value="16">Ajun Komisaris Besar Polisi</option>
                  <option value="17">Komisaris Besar Polisi</option>
                  <option value="18">Brigadir Jenderal Polisi</option>
                  <option value="19">Inspektur Jenderal Polisi</option>
                  <option value="20">Komisaris Jendral Polisi</option>
                  <option value="21">Jenderal Polisi</option>
                </select>
            </div>
            <div class="field">
                <label>Jabatan Polisi</label>
                <input type="text" name="jabatan_polisi" id="myAkunPoliceDataPolice_jabatan" placeholder="">
            </div>
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="myAkunPoliceDataPolice_nik" placeholder="">
            </div>
            <div class="field">
              <label>Kantor Polisi</label>
              <select class="ui search dropdown kantorPolisi" name="id_kantor_polisi" id="ddKantorPolisi">
                
              </select>
            </div>
            <div class="field">
                <label>Document</label>
                <input type="file" name="dokumen" id="myAkunPoliceDataPolice_dokumen" placeholder="">
            </div>
        </form>
      </div>
      <div class="actions">
        <div class="ui button cancel" style="user-select: auto;">Cancel</div>
        <div class="ui brown button update_myAkunPoliceDataPolice " style="user-select: auto;">Update</div>
      </div>
    </div>

@endsection
