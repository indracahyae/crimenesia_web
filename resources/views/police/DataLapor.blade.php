@extends('police.template')

@section('page_title')
	{{'
		Data Lapor
	'}}
@endsection

@section('page_content')
	<!-- tabel -->
  <div class="ui segment">
      <div class="ui top attached label titleContainerLable">
          <h4><i class="user icon"></i> Data Lapor</h4>
      </div>
      <!-- tabel menu -->
      <div class="ui text menu">
        <div class="ui search dataLapor">
          <div class="ui icon input">
            <input class="prompt inpSearch" type="text" placeholder="NIK / Nama">
            <i class="search icon"></i>
          </div>
          <div class="results"></div>
        </div>
        <button class="circular ui basic icon mini button reload_dataLapor" style="user-select: auto;">
          <i class="refresh icon"></i>
        </button>
      </div>
      <table class="ui celled padded teal table" style="">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIK Pelapor</th>
              <th>Nama</th>
              <th>Jumlah Pengaduan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbDataLapor">
            
          </tbody>
      </table>
      
  </div>

  <!-- modal list pengaduan -->
  <div class="ui large modal listPengaduanPelapor">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Data Pengaduan
    </div>
    <div class="content">
      <table class="ui celled table">
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Status Validasi</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Kriminalitas</th>
            <th>Bukti Pendukung</th>
          </tr>
        </thead>
        <tbody id="listPengaduanPelapor">
          
        </tbody>
      </table>
    </div>
    <!-- <div class="actions">
      <div class="ui button cancel" style="user-select: auto;">close</div>
    </div> -->
  </div>

  <!-- modal detail pengaduan / kriminalitas -->
  <div class="ui large modal detailLaporKriminalitas">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Detail Kriminalitas
    </div>
    <div class="content">
      <div class="ui list">
        <div class="item">
          <div class="header">Judul</div>
          <div class="detailJudul"></div>
        </div>
        <div class="item">
          <div class="header">Waktu</div>
          <div class="detailWaktu"></div>
        </div>
        <div class="item">
          <div class="header">Kota</div>
          <div class="detailKota"></div>
        </div>
        <div class="item">
          <div class="header">Alamat</div>
          <div class="detailAlamat"></div>
        </div>
        <div class="item">
          <div class="header">Tentang Pelaku</div>
          <div class="detailTentangPelaku"></div>
        </div>
        <div class="item">
          <div class="header">Tentang Korban</div>
          <div class="detailTentangKorban"></div>
        </div>
        <div class="item">
          <div class="header">Latitude</div>
          <div class="detailLat"></div>
        </div>
        <div class="item">
          <div class="header">Longitude</div>
          <div class="detailLong"></div>
        </div>
        <div class="item">
          <div class="header">Kategori Kriminalitas</div>
          <div class="detailKatKriminalitas"></div>
        </div>
        <div class="item">
          <div class="header">Lingkup Kantor</div>
          <div class="detailNamaKantor"></div>
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui button back_detailLaporKriminalitas" style="user-select: auto;">back</div>
      <div class="ui primary button detailLaporKriminalitas_Pelaku" data-id="" style="user-select: auto;">Pelaku</div>
    </div>
  </div>

  <!-- modal list pelaku -->
  <div class="ui large modal laporListPelaku">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Daftar Pelaku
    </div>
    <div class="content">
      <table class="ui celled table">
        <thead>
          <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody id="listPelaku_DataLapor">
          
        </tbody>
      </table>
    </div>
    <div class="actions">
      <div class="ui button back_listPelaku_DataLapor" style="user-select: auto;">back</div>
    </div>
  </div>

  <!-- modal dok pendukung -->
  <div class="ui large modal laporDokPendukung">
    <i class="close icon"></i>
    <div class="header titleContainerLable">
     Dokumen Pendukung
    </div>
    <div class="content">
      <table class="ui celled table">
        <thead>
          <tr>
            <th>Keterangan</th>
            <th>Dokumen</th>
          </tr>
        </thead>
        <tbody id="listDokPendukung_DataLapor">
          
        </tbody>
      </table>
    </div>
    <div class="actions">
      <div class="ui button back_listDokPendukung" style="user-select: auto;">back</div>
    </div>
  </div>
@endsection
