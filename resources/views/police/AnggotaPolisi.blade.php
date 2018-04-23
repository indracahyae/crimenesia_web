@extends('police.template')

@section('page_title')
	{{'
		Anggota Polisi
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
  <div class="ui segment">
      <div class="ui top attached label titleContainerLable">
          <h4><i class="user icon"></i> Data Anggota Polisi</h4>
      </div>
      <!-- tabel menu -->
      <div class="ui text menu">
        <div class="ui search dataAnggotaPolisi">
          <div class="ui icon input">
            <input class="prompt inpSearch" type="text" placeholder="nrp / nama">
            <i class="search icon"></i>
          </div>
          <div class="results"></div>
        </div>

         <div class="ui right dropdown item">
            <!-- Action -->
            <i class="options icon"></i>
            <div class="menu">
              <div class="item btn addPO" data-aksiceadmin='0'><i class="add user icon"></i> create new</div>
              <div class="item btn mDelete"><i class="remove user icon"></i> delete selected</div>
              <div class="item btn reloadDataPO"><i class="refresh icon"></i> reload data</div>
            </div>
        </div>
      </div>
      <table class="ui celled padded teal table" style="">
          <thead>
            <tr>
              <th>
                <div class="ui master checkbox checkboxPoliceOfficer">
                  <input type="checkbox" tabindex="0" class="hidden" id="cbPoliceOfficerMaster">
                </div>
              </th>
              <th>No.</th>
              <th>NRP</th>
              <th>Nama</th>
              <th>Pangkat</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbDataAnggotaPolisi">
            
          </tbody>
      </table>
  </div>

  <!-- modal detail data -->
  <div class="ui large modal detailPO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Detail Anggota Polisi
    </div>
    <div class="content">
        <img class="ui centered medium circular image fotoPO" src="">
        <div class="ui celled list">
          <div class="item">
            <div class="content">
              <h4 class="ui header">Data Polisi</h4>
            </div>
          </div>
        </div>
        <div class="content active">
          <div class="ui list">
            <div class="item">
              <div class="header">NRP</div>
              <div class="detail_nrp"></div>
            </div>
            <div class="item">
              <div class="header">Pangkat</div>
              <div class="detail_pangkat"></div>
            </div>
            <div class="item">
              <div class="header">Jabatan</div>
              <div class="detail_jabatan"></div>
            </div>
            
          </div>
        </div>
        
        <div class="ui celled list">
          <div class="item">
            <div class="content">
              <h4 class="ui header">Data Umum</h4>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="ui list">
            <div class="item">
              <div class="header">NIK</div>
              <div class="detail_nik"></div>
            </div>
            <div class="item">
              <div class="header">Nama</div>
              <div class="detail_nama"></div>
            </div>
            <div class="item">
              <div class="header">Kelamin</div>
              <div class="detail_kelamin"></div>
            </div>
            <div class="item">
              <div class="header">Tempat Lahir</div>
              <div class="detail_tempatLahir"></div>
            </div>
            <div class="item">
              <div class="header">Tanggal Lahir</div>
              <div class="detail_tglLahir"></div>
            </div>
            <div class="item">
              <div class="header">Kota</div>
              <div class="detail_kota"></div>
            </div>
            <div class="item">
              <div class="header">Alamat</div>
              <div class="detail_alamat"></div>
            </div>
            <div class="item">
              <div class="header">Agama</div>
              <div class="detail_agama"></div>
            </div>
            <div class="item">
              <div class="header">Pekerjaan</div>
              <div class="detail_pekerjaan"></div>
            </div>
            <div class="item">
              <div class="header">Tlp</div>
              <div class="detail_tlp"></div>
            </div>
            <div class="item">
              <div class="header">Email</div>
              <div class="detail_email"></div>
            </div>
            <div class="item">
              <div class="header">Last Login</div>
              <div class="detail_lastLogin"></div>
            </div>
          </div>
        </div>
        
      <!-- </div> -->
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
    </div>
  </div>

  <!-- modal edit data-->

  <!-- modal delete data-->
  <div class="ui large modal deletePO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Delete Anggota Polisi
    </div>
    <div class="content">
        <p>Yakin hapus data ini ?</p>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">cancel</div>
      <div data-id="" class="ui primary button deletePO" style="user-select: auto;">delete</div>
    </div>
  </div>

  <!-- modal create society -->
  <div class="ui large modal createSociety_PO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Store Society Data
    </div>
    <div class="content">
        <form class="ui form createSociety_PO" >
            <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="" placeholder="NIK">
            </div>
            <div class="field">
                <label>Password</label>
                <input type="text" name="password" id="" placeholder="Password">
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" id="" placeholder="Nama">
            </div>
            <div class="field">
              <label>Jenis Kelamin</label>
              <select class="ui dropdown jenis_kelamin" name="jenis_kelamin" id="">
                <option value="">...</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div> 
            <div class="field">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="" placeholder="Tempat Lahir">
            </div>
            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="" placeholder="Tanggal Lahir">
            </div>
            <div class="field">
              <label>Kabupaten / Kota</label>
              <select class="ui search dropdown kota" name="id_kota" id="ddKota">
                
              </select>
            </div>
            <div class="field">
                <label>Alamat</label>
                <input type="text" name="alamat" id="" placeholder="Alamat">
            </div>
            <div class="field">
              <label>Agama</label>
              <select class="ui dropdown agama" name="agama" id="">
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
                <input type="text" name="pekerjaan" id="" placeholder="Pekerjaan">
            </div>
            <div class="field">
                <label>Tlp.</label>
                <input type="number" name="tlp" id="" placeholder="Telephone Number">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" id="" placeholder="Email">
            </div>
            <div class="field">
                <label>Photo</label>
                <input type="file" name="foto" id="" placeholder="">
            </div>
        </form>
    </div>
    <div class="actions">
      <div class="ui button moveTo_modalStorePOlice_PO" style="user-select: auto;">skip</div>
      <div data-id="" class="ui primary button storeSociety_PO" style="user-select: auto;">submit</div>
    </div>
  </div>

  <!-- modal create Police -->
  <div class="ui large modal createPolice_PO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Store Police Data
    </div>
    <div class="content">
        <form class="ui form createPolice_PO" >
            <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
            <div class="field">
                <label>NRP</label>
                <input type="number" name="nrp" id="" placeholder="">
            </div>
            <div class="field">
                <label>Pangkat Polisi</label>
                <select class="ui dropdown pangkatPolisi" name="pangkat_polisi" id="">
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
                <input type="text" name="jabatan_polisi" id="" placeholder="">
            </div>
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="" placeholder="">
            </div>
        </form>
    </div>
    <div class="actions">
      <div class="ui button moveTo_modalCreateSociety_PO" style="user-select: auto;">back</div>
      <div data-id="" class="ui primary button storePolice_PO" style="user-select: auto;">submit</div>
    </div>
  </div>

  <!-- modal edit society -->
  <div class="ui large modal updateSociety_PO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Update Society Data
    </div>
    <div class="content">
        <form class="ui form updateSociety_PO" >
            <input type="hidden" value="" name="keySociety" id="keySociety">
            <input type="hidden" value="" name="old_email" id="old_email">
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" id="nik_PO" placeholder="NIK">
            </div>
            <div class="field">
                <label>Password</label>
                <input type="text" name="password" id="password_PO" placeholder="Password">
            </div>
            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" id="nama_PO" placeholder="Nama">
            </div>
            <div class="field">
              <label>Jenis Kelamin</label>
              <select class="ui dropdown jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin_PO">
                <option value="">...</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
            </div> 
            <div class="field">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir_PO" placeholder="Tempat Lahir">
            </div>
            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir_PO" placeholder="Tanggal Lahir">
            </div>
            <div class="field">
              <label>Kabupaten / Kota</label>
              <select class="ui search dropdown kota" name="id_kota" id="ddKotaEdit">
                
              </select>
            </div>
            <div class="field">
                <label>Alamat</label>
                <input type="text" name="alamat" id="alamat_PO" placeholder="Alamat">
            </div>
            <div class="field">
              <label>Agama</label>
              <select class="ui dropdown agama" name="agama" id="agama_PO">
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
                <input type="text" name="pekerjaan" id="pekerjaan_PO" placeholder="Pekerjaan">
            </div>
            <div class="field">
                <label>Tlp.</label>
                <input type="number" name="tlp" id="tlp_PO" placeholder="Telephone Number">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="email" id="email_PO" placeholder="Email">
            </div>
            <div class="field">
                <label>Photo</label>
                <input type="file" name="foto" id="foto_PO" placeholder="">
            </div>
        </form>
    </div>
    <div class="actions">
      <div class="ui button moveTo_ModalUpdatePolice_PO" style="user-select: auto;">skip</div>
      <div data-id="" class="ui primary button updateSociety_PO" style="user-select: auto;">submit</div>
    </div>
  </div>

  <!-- modal edit Police -->
  <div class="ui large modal updatePolice_PO">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Update Police Data
    </div>
    <div class="content">
        <form class="ui form updatePolice_PO" >
            <input type="hidden" value="" name="keyPolice" id="keyPolice">
            <input type="hidden" value="" name="old_nik" id="old_nik">
            <div class="field">
                <label>NRP</label>
                <input type="number" name="nrp" id="nrp_PO" placeholder="">
            </div>
            <div class="field">
                <label>Pangkat Polisi</label>
                <select class="ui dropdown pangkatPolisi" name="pangkat_polisi" id="pangkat_polisi_PO">
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
                <input type="text" name="jabatan_polisi" id="jabatan_polisi_PO" placeholder="">
            </div>
            <div class="field">
                <label>NIK</label>
                <input type="number" name="nik" class="nik_PO" placeholder="">
            </div>
        </form>
    </div>
    <div class="actions">
      <div class="ui button moveTo_ModalUpdateSociety_PO" style="user-select: auto;">back</div>
      <div data-id="" class="ui primary button updatePolice_PO" style="user-select: auto;">submit</div>
    </div>
  </div>
  
@endsection
