@extends('admin.template')

@section('page_title')
	{{'
		Manage Police
	'}}
@endsection

@section('page_content')
	
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label titleContainerLable">
            <h4><i class="spy icon"></i> Police Accounts</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
          <div class="ui search police">
            <div class="ui icon input">
              <input class="prompt inpSearch" type="text" placeholder="nama / nrp">
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
                  <div class="ui master checkbox checkboxPolice">
                    <input type="checkbox" tabindex="0" class="hidden" id="cbPoliceMaster">
                  </div>
              	</th>
                <th>No.</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Pangkat</th>
                <th>Jabatan</th>
                <th>Kantor</th>
                <th>Valid</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbPolice">
              
            </tbody>
        </table>
        
    </div>

	<!-- modal detail -->
	<div class="ui long modal detailPolice">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Detail Police
      </div>
      <div class="image content">
        <div class="image">
          <img src="" alt="" class="ui medium rounded image dPhotoPolice">
        </div>
        <div class="description">
          <div class="ui list">
            <div class="item">
              <div class="header">NRP</div>
              <i class="dNrp"></i>
            </div>
            <div class="item">
              <div class="header">Pangkat Polisi</div>
              <i class="dPangkatPolisi"></i>
            </div>
            <div class="item">
              <div class="header">Jabatan Polisi</div>
              <i class="dJabatanPolisi"></i>
            </div>
            <div class="item">
              <div class="header">Nama</div>
              <i class="dNama"></i>
            </div>
            <div class="item">
              <div class="header">NIK</div>
              <i class="dNik"></i>
            </div>
            <div class="item">
              <div class="header">Tlp.</div>
              <i class="dTlp"></i>
            </div>
            <div class="item">
              <div class="header">Email</div>
              <i class="dEmail"></i>
            </div>
            <div class="item">
              <div class="header">Nama Kantor</div>
              <i class="dNamaKantor"></i>
            </div>
            <div class="item">
              <div class="header">Last Login</div>
              <i class="dLastLogin"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- modal delete admin -->
    <div class="ui small modal deletePolice">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Delete Police
      </div>
      <div class="image content">
        <div class="description">
          Wanna to delete this data ?
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" style="user-select: auto;">Cancel</div>
        <div class="ui primary button deletePolice" style="user-select: auto;" data-id="" > 
          OK 
        </div>
      </div>
    </div>

@endsection
