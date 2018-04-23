@extends('police.template')

@section('page_title')
	{{'
		Data Pelaku Kriminalitas
	'}}
@endsection

@section('page_content')
  <!-- tabel -->
  <div class="ui segment">
      <div class="ui top attached label titleContainerLable">
          <h4><i class="user icon"></i> Data Pelaku Kriminalitas</h4>
      </div>
      <!-- tabel menu -->
      <div class="ui text menu">
        <div class="ui search dataPelaku_Polisi">
          <div class="ui icon input">
            <input class="prompt inpSearch" type="text" placeholder="Nama">
            <i class="search icon"></i>
          </div>
          <div class="results"></div>
        </div>

         <div class="ui right dropdown item">
            <!-- Action -->
            <i class="options icon"></i>
            <div class="menu">
              <div class="item btn add" data-aksiceadmin='0'><i class="add user icon"></i> create new</div>
              <div class="item btn mDelete"><i class="remove user icon"></i> delete selected</div>
              <div class="item btn reloadData"><i class="refresh icon"></i> reload data</div>
            </div>
        </div>
      </div>
      <table class="ui celled padded teal table" style="">
          <thead>
            <tr>
              <th>
                <div class="ui master checkbox checkboxPelaku_Polisi">
                  <input type="checkbox" tabindex="0" class="hidden" id="cbPelaku_PolisiMaster">
                </div>
              </th>
              <th>No.</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>kriminalitas</th>
              <!--add, detail (list Crime, delete)  -->
              <th>Aksi</th> 
              <!-- delete, detail, update -->
            </tr>
          </thead>
          <tbody id="tbPelaku">
            
          </tbody>
      </table>
      
  </div>

  <!-- modal delete Pelaku -->
  <div class="ui large modal delPelaku_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Hapus Pelaku
    </div>
    <div class="content">
      <p>
        Yakin ingin menghapus data ini ?
      </p>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
      <div class="ui primary button delPelaku_P" data-id="" style="user-select: auto;">Delete</div>
    </div>
  </div>

  <!-- modal detail Pelaku (data masyarakat) -->
  <div class="ui small modal detailPelaku_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Data Personal Pelaku
    </div>
    <div class="content">
      <img class="ui centered medium circular image fotoPelaku" src="">
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
        
      </div>
    </div>
  </div>

  <!-- modal create Pelaku (data masyarakat) -->
  <div class="ui large modal addDataPelaku_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Create Pelaku
    </div>
    <div class="content">
      <form class="ui form createDataPelaku_P" >
          <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
          <div class="field">
              <label>NIK</label>
              <input type="number" name="nik" id="" placeholder="NIK">
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

          <div class="ui horizontal divider" style="user-select: auto;">
            Tentang Kriminalitas
          </div>

          <div class="ui search dataKriminalitas_Polisi">
            <div class="ui icon input">
              <input class="prompt inpSearchCrime" type="text" placeholder="ketik judul kriminalitas" name="id_kriminalitas">
              <i class="search icon"></i>
            </div>
            <div class="results"></div>
          </div>
          <div class="field">
            <label>Tentang Pelaku terhadap Kriminalitas</label>
            <textarea rows="2" name="ket"></textarea>
          </div>

      </form>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
      <div class="ui primary button submitDataPelaku_P" data-id="" style="user-select: auto;">Submit</div>
    </div>
  </div>
 
  <!-- modal edit Pelaku (data masyarakat) -->
  <div class="ui large modal editDataPelaku_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Create Pelaku
    </div>
    <div class="content">
      <form class="ui form editDataPelaku_P" >
          <input type="hidden" value="" name="key" id="keyPelaku_edit">
          <input type="hidden" value="" name="old_email" id="old_email">
          <div class="field">
              <label>NIK</label>
              <input type="number" name="nik" id="nik_edit" placeholder="NIK">
          </div>
          <div class="field">
              <label>Nama</label>
              <input type="text" name="nama" id="nama_edit" placeholder="Nama">
          </div>
          <div class="field">
            <label>Jenis Kelamin</label>
            <select class="ui dropdown jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin_edit">
              <option value="">...</option>
              <option value="1">Laki-laki</option>
              <option value="2">Perempuan</option>
            </select>
          </div> 
          <div class="field">
              <label>Tempat Lahir</label>
              <input type="text" name="tempat_lahir" id="tempat_lahir_edit" placeholder="Tempat Lahir">
          </div>
          <div class="field">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" id="tanggal_lahir_edit" placeholder="Tanggal Lahir">
          </div>
          <div class="field">
            <label>Kabupaten / Kota</label>
            <select class="ui search dropdown kota" name="id_kota" id="ddKotaEdit">
              
            </select>
          </div>
          <div class="field">
              <label>Alamat</label>
              <input type="text" name="alamat" id="alamat_edit" placeholder="Alamat">
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
              <input type="text" name="pekerjaan" id="pekerjaan_edit" placeholder="Pekerjaan">
          </div>
          <div class="field">
              <label>Tlp.</label>
              <input type="number" name="tlp" id="tlp_edit" placeholder="Telephone Number">
          </div>
          <div class="field">
              <label>Email</label>
              <input type="text" name="email" id="email_edit" placeholder="Email">
          </div>
          <div class="field">
              <label>Photo</label>
              <input type="file" name="foto" id="foto_edit" placeholder="">
          </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
      <div class="ui primary button updateDataPelaku_P" data-id="" style="user-select: auto;">Submit</div>
    </div>
  </div>

  <!-- modal list crime -->
  <div class="ui large modal listCrime_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      List Kriminalitas
    </div>
    <div class="content">
      <table class="ui celled padded teal table" style="">
        <thead>
          <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Waktu</th>
            <th>Keterangan</th>
            <th>Aksi</th> 
            <!-- delete, detail, -->
          </tr>
        </thead>
        <tbody id="tbListCrime_Pelaku">
          
        </tbody>
      </table>
    </div>
  </div>

  <!-- modal add crime -->
  <div class="ui large modal addCrime_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Add Kriminalitas
    </div>
    <div class="content">
      <form class="ui form addCrime_Pelaku" >
        <input type="hidden" value="" name="nik" id="nikCrime">
        <div class="ui search addCrimePelaku_Polisi">
          <div class="ui icon input">
            <input class="prompt inpSearchAddCrime" type="text" placeholder="ketik judul kriminalitas" name="id_kriminalitas" id="">
            <i class="search icon"></i>
          </div>
          <div class="results"></div>
        </div>
        <div class="field">
          <label>Tentang Pelaku terhadap Kriminalitas</label>
          <textarea rows="2" name="ket"></textarea>
        </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui primary button addCrime_Pelaku" data-id="" style="user-select: auto;">Submit</div>
    </div>
  </div>

  <!-- modal detail Crime -->
  <div class="ui small modal detailCrimePelaku_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Detail Kriminalitas
    </div>
    <div class="content">
      <div class="ui list">
        <div class="item">
          <div class="header">Judul</div>
          <div class="detailKriminalitas_judul"></div>
        </div>
        <div class="item">
          <div class="header">Waktu</div>
          <div class="detailKriminalitas_waktu"></div>
        </div>
        <div class="item">
          <div class="header">Kota</div>
          <div class="detailKriminalitas_kota"></div>
        </div>
        <div class="item">
          <div class="header">Alamat</div>
          <div class="detailKriminalitas_alamat"></div>
        </div>
        <div class="item">
          <div class="header">Tentang Pelaku</div>
          <div class="detailKriminalitas_TentangPelaku"></div>
        </div>
        <div class="item">
          <div class="header">Tentang Korban</div>
          <div class="detailKriminalitas_TentangKorban"></div>
        </div>
        <div class="item">
          <div class="header">Deskripsi Kejadian</div>
          <div class="detailKriminalitas_deskripsi"></div>
        </div>
        <div class="item">
          <div class="header">Latitude</div>
          <div class="detailKriminalitas_lat"></div>
        </div>
        <div class="item">
          <div class="header">Longitude</div>
          <div class="detailKriminalitas_long"></div>
        </div>
        <div class="item">
          <div class="header">Kategori Kriminalitas</div>
          <div class="detailKriminalitas_KatKriminalitas"></div>
        </div>
        <div class="item">
          <div class="header">Kantor Polisi</div>
          <div class="detailKriminalitas_KantorPolisi"></div>
        </div>
        
      </div>
    </div>
    <div class="actions">
      <div class="ui button to_modalListCrime" style="user-select: auto;">back</div>
    </div>
  </div>

  

@endsection
