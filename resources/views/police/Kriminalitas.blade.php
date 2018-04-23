@extends('police.template')

@section('page_title')
	{{'
		Data Kriminalitas
	'}}
@endsection

@section('page_content')
  <!-- tabel -->
  <div class="ui segment">
      <div class="ui top attached label titleContainerLable">
          <h4><i class="user icon"></i> Data Kriminalitas</h4>
      </div>
      <!-- tabel menu -->
      <div class="ui text menu">
        <div class="ui search dataKriminalitas_Polisi">
          <div class="ui icon input">
            <input class="prompt inpSearch" type="text" placeholder="Judul Kriminalitas">
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
              <div class="item btn filterDate"><i class="calendar outline icon"></i> filter by date</div>
              <div class="item btn filterCategory"><i class="tag icon"></i> filter by category</div>
              <div class="item btn reloadData"><i class="refresh icon"></i> reload data</div>
            </div>
        </div>
      </div>
      <table class="ui celled padded teal table" style="">
          <thead>
            <tr>
              <th>
                <div class="ui master checkbox checkboxKriminalitas_Polisi">
                  <input type="checkbox" tabindex="0" class="hidden" id="cbKriminalitas_PolisiMaster">
                </div>
              </th>
              <th>No.</th>
              <th>Judul</th>
              <th>Waktu</th>
              <th>Kategori</th>
              <th>Kantor Polisi</th>
              <th>Dokumen Pendukung</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbDataKriminalitas">
            
          </tbody>
      </table>
      
  </div>

  <!-- modal detail kriminalitas -->
  <div class="ui large modal detailKriminalitas">
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
      <div class="ui button open_listPelaku" data-id="" style="user-select: auto;">pelaku</div>
      <div class="ui button open_detailBukti" data-id="" style="user-select: auto;">bukti</div>
    </div>
  </div>

  <!-- modal detail list pelaku -->
  <div class="ui large modal listPelaku">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Pelaku Kriminalitas
    </div>
    <div class="content">
      <div class="ui list listPelaku">
        
      </div>
    </div>
    <div class="actions">
      <div class="ui button backTo_detailKriminalitas" style="user-select: auto;">back</div>
    </div>
  </div>

  <!-- modal detail pelaku -->
  <div class="ui large modal detailPelaku">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Detail Pelaku Kriminalitas
    </div>
    <div class="content">
      <img class="ui centered medium circular image detail_foto" src="">
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
          <div class="header">Catatan terhadap kriminalitas ini</div>
          <div class="detail_ket"></div>
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui button backTo_ListPelaku" style="user-select: auto;">back</div>
    </div>
  </div>

  <!-- modal list bukti -->
  <div class="ui large modal detailBukti">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Bukti Pendukung Kriminalitas
    </div>
    <div class="content">
      <div class="ui list detailBukti">
        
      </div>
    </div>
    <div class="actions">
      <div class="ui button backTo_detailKriminalitas" style="user-select: auto;">back</div>
    </div>
  </div>

  <!-- modal delete -->
  <div class="ui large modal delKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Hapus Kriminalitas
    </div>
    <div class="content">
      <p>
        Yakin ingin menghapus data ini ?
      </p>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
      <div class="ui primary button delKriminalitas" data-id="" style="user-select: auto;">Delete</div>
    </div>
  </div>

  <!-- modal create -->
  <div class="ui large modal createKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Create Kriminalitas
    </div>
    <div class="content">
      <form class="ui form createCrime_P" >
        <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
        <div class="field">
            <label>Judul</label>
            <input type="text" name="judul" id="" placeholder="">
        </div>
        <div class="field">
          <label>Alamat</label>
          <input type="text" name="alamat" id="" placeholder="">
        </div>
        <div class="field">
          <label>Waktu</label>
          <input type="datetime-local" name="waktu" id="" placeholder="">
        </div>
        <div class="field">
          <label>Tentang Pelaku</label>
          <textarea rows="3" name="t_pelaku"></textarea>
        </div>
        <div class="field">
          <label>Tentang Korban</label>
          <textarea rows="3" name="t_korban"></textarea>
        </div>
        <div class="field">
          <label>Deskripsi Kejadian</label>
          <textarea rows="3" name="deskripsi_kejadian"></textarea>
        </div>
        <div class="field">
          <label>Latitude</label>
          <input type="number" name="lat" id="" placeholder="">
        </div>
        <div class="field">
          <label>Longitude</label>
          <input type="number" name="long" id="" placeholder="">
        </div>
        <div class="field">
          <label>Kabupaten / Kota</label>
          <select class="ui search dropdown kota" name="id_kota" id="ddKota">
            
          </select>
        </div>
        <div class="field">
          <label>Kategori Kriminalitas</label>
          <select class="ui search dropdown katCrime" name="id_kat_kriminalitas" id="ddKatCrime">
            
          </select>
        </div>
        
      </form>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">cancel</div>
      <div class="ui primary button saveCreateKriminalitas" style="user-select: auto;">Submit</div>
    </div>
  </div>

  <!-- modal update -->
  <div class="ui large modal updateKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Update Kriminalitas
    </div>
    <div class="content">
      <form class="ui form updateCrime_P" >
        <input type="hidden" value="" name="key" id="keyEditCrime">
        <div class="field">
            <label>Judul</label>
            <input type="text" name="judul" class="judul_fe" placeholder="">
        </div>
        <div class="field">
          <label>Alamat</label>
          <input type="text" name="alamat" class="alamat_fe" placeholder="">
        </div>
        <div class="field">
          <label>Waktu</label>
          <input type="datetime-local" name="waktu" id="" class="waktu_fe">
        </div>
        <div class="field">
          <label>Tentang Pelaku</label>
          <textarea rows="3" name="t_pelaku" class="tPelaku_fe"></textarea>
        </div>
        <div class="field">
          <label>Tentang Korban</label>
          <textarea rows="3" name="t_korban" class="tKorban_fe"></textarea>
        </div>
        <div class="field">
          <label>Deskripsi Kejadian</label>
          <textarea rows="3" name="deskripsi_kejadian" class="kejadian_fe"></textarea>
        </div>
        <div class="field">
          <label>Latitude</label>
          <input type="number" name="lat" class="lat_fe">
        </div>
        <div class="field">
          <label>Longitude</label>
          <input type="number" name="long" class="long_fe">
        </div>
        <div class="field">
          <label>Kabupaten / Kota</label>
          <select class="ui search dropdown kota" name="id_kota" id="ddKotaEdit">
            
          </select>
        </div>
        <div class="field">
          <label>Kategori Kriminalitas</label>
          <select class="ui search dropdown katCrime" name="id_kat_kriminalitas" id="ddKatCrimeEdit">
            
          </select>
        </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">cancel</div>
      <div class="ui primary button saveUpdateKriminalitas" style="user-select: auto;">Update</div>
    </div>
  </div>

  <!-- modal create bukti -->
  <div class="ui large modal createBuktiKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Create Bukti Pendukung
    </div>
    <div class="content">
      <form class="ui form createBukti_P" >
        <input type="hidden" value="" name="id_kriminalitas" id="keyBukti">
        <div class="field">
          <label>Keterangan</label>
          <textarea rows="3" name="ket"></textarea>
        </div>
        <div class="field">
          <label>Photo</label>
          <input type="file" name="foto" id="" placeholder="">
        </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">cancel</div>
      <div class="ui primary button saveCreateBuktiKriminalitas" style="user-select: auto;">Submit</div>
    </div>
  </div>

  <!-- modal delete bukti -->
  <div class="ui large modal delBuktiKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Delete Bukti Pendukung
    </div>
    <div class="content">
    <table class="ui celled padded table" style="">
      <thead>
        <tr>
          <th>No.</th>
          <th>Keterangan</th>
          <th>Dokumen</th>
          <th>Hapus</th>
        </tr>
      </thead>
      <tbody id="tbListBukti">
        
      </tbody>
    </table>
    </div>
  </div>

  <!-- modal filter by date -->
  <div class="ui small modal filterKriminalitasByCategory_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Filter by Category
    </div>
    <div class="content cbFilterCrimeByCategory">
      
    </div>
    <div class="actions">
      <div class="ui primary button filterByCategory" style="user-select: auto;">Submit</div>
    </div>
  </div>

  <!-- modal filter by category -->
  <div class="ui small modal filterKriminalitasByDate_P">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
      Filter by Date
    </div>
    <div class="content filterCrimeByDate">
      <form class="ui form filterCrimeByDate" >  
        <div class="field">
          <label>Start Date</label>
          <input type="date" name="start" id="">
        </div>
        <div class="field">
          <label>End Date</label>
          <input type="date" name="end" id="">
        </div>
      </form>
    </div>
    <div class="actions">
      <div class="ui primary button filterByDate" style="user-select: auto;">Submit</div>
    </div>
  </div>

@endsection
