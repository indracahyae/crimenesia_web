@extends('admin.template')

@section('page_title')
	{{'
		Manage Society
	'}}
@endsection

@section('page_content')
	
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label titleContainerLable">
            <h4><i class="user icon"></i> Society Accounts</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
          <div class="ui search society">
            <div class="ui icon input">
              <input class="prompt inpSearch" type="text" placeholder="nama">
              <i class="search icon"></i>
            </div>
            <div class="results"></div>
          </div>
    		  <div class="ui right dropdown item">
    		    <!-- Action -->
    		    <i class="options icon"></i>
    		    <div class="menu">
    		      <div class="item btn mDelete"><i class="remove user icon"></i> delete selected</div>
              <div class="item btn reloadData"><i class="refresh icon"></i> reload data</div>
    		    </div>
    		  </div>
    		</div>
        <table class="ui celled padded teal table" style="">
            <thead>
              <tr>
              	<th>
                  <div class="ui master checkbox checkboxSociety">
                    <input type="checkbox" tabindex="0" class="hidden" id="cbSocietyMaster">
                  </div>
              	</th>
                <th>No.</th>
                <th>NIK</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Tlp.</th>
                <th>Last Login</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbSociety">
              
            </tbody>
        </table>
        
    </div>

	<!-- modal detail -->
	<div class="ui long modal detailSociety">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Detail Society
      </div>
      <div class="image content">
        <div class="image">
          <img src="" alt="" class="ui medium rounded image dPhotoSociety">
        </div>
        <div class="description">
          <div class="ui list">
            <div class="item">
              <div class="header">NIK</div>
              <i class="dSocietyNik"></i>
            </div>
            <div class="item">
              <div class="header">Username</div>
              <i class="dSocietyUsername"></i>
            </div>
            <div class="item">
              <div class="header">Password</div>
              <i class="dSocietyPassword"></i>
            </div>
            <div class="item">
              <div class="header">Nama</div>
              <i class="dSocietyNama"></i>
            </div>
            <div class="item">
              <div class="header">Jenis Kelamin</div>
              <i class="dSocietyKelamin"></i>
            </div>
            <div class="item">
              <div class="header">Tempat Lahir</div>
              <i class="dSocietyTempatLahir"></i>
            </div>
            <div class="item">
              <div class="header">Tanggal Lahir</div>
              <i class="dSocietyTanggalLahir"></i>
            </div>
            <div class="item">
              <div class="header">Kota</div>
              <i class="dSocietyKota"></i>
            </div>
            <div class="item">
              <div class="header">Alamat</div>
              <i class="dSocietyAlamat"></i>
            </div>
            <div class="item">
              <div class="header">Agama</div>
              <i class="dSocietyAgama"></i>
            </div>
            <div class="item">
              <div class="header">Pekerjaan</div>
              <i class="dSocietyPekerjaan"></i>
            </div>
            <div class="item">
              <div class="header">Tlp</div>
              <i class="dSocietyTlp"></i>
            </div>
            <div class="item">
              <div class="header">Email</div>
              <i class="dSocietyEmail"></i>
            </div>
            <div class="item">
              <div class="header">Last Login</div>
              <i class="dSocietyLastLogin"></i>
            </div>
            <div class="item">
              <div class="header">Created</div>
              <i class="dSocietyCreated"></i>
            </div>
            <div class="item">
              <div class="header">Updated</div>
              <i class="dSocietyUpdated"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- modal delete admin -->
    <div class="ui small modal deleteSociety">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Delete Society
      </div>
      <div class="image content">
        <div class="description">
          Wanna to delete this data ?
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" style="user-select: auto;">Cancel</div>
        <div class="ui primary button deleteSociety" style="user-select: auto;" data-id="" > 
          OK 
        </div>
      </div>
    </div>

@endsection
