@extends('admin.template')

@section('page_title')
	{{'
		Police Station
	'}}
@endsection

@section('page_content')
	
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label titleContainerLable">
            <h4><i class="building icon"></i> Police Station</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
          <div class="ui search policeStation">
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
              <div class="item btn addPoliceStation"><i class="add user icon"></i> create</div>
    		      <div class="item btn mDelete"><i class="remove user icon"></i> delete selected</div>
              <div class="item btn reloadData"><i class="refresh icon"></i> reload data</div>
    		    </div>
    		  </div>
    		</div>
        <table class="ui celled padded teal table" style="">
            <thead>
              <tr>
              	<th>
                  <div class="ui master checkbox checkboxPoliceStation">
                    <input type="checkbox" tabindex="0" class="hidden" id="cbPoliceStationMaster">
                  </div>
              	</th>
                <th>No.</th>
                <th>Nama</th>
                <th>Kota</th>
                <th>Tlp</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbPoliceStation">
              
            </tbody>
        </table>
      
    </div>

	<!-- modal detail -->
	<div class="ui long modal detailPoliceStation">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Detail Police Station
      </div>
      <div class="content">
        <div class="description">
          <div class="ui list">
            <div class="item">
              <div class="header">Nama</div>
              <i class="dNama"></i>
            </div>
            <div class="item">
              <div class="header">Email</div>
              <i class="dEmail"></i>
            </div>
            <div class="item">
              <div class="header">Alamat</div>
              <i class="dAlamat"></i>
            </div>
            <div class="item">
              <div class="header">Kode Pos</div>
              <i class="dKodePos"></i>
            </div>
            <div class="item">
              <div class="header">Tlp.</div>
              <i class="dTlp"></i>
            </div>
            <div class="item">
              <div class="header">Keterangan</div>
              <i class="dKeterangan"></i>
            </div>
            <div class="item">
              <div class="header">Latitude</div>
              <i class="dLatitude"></i>
            </div>
            <div class="item">
              <div class="header">Longitude</div>
              <i class="dLongitude"></i>
            </div>
            <div class="item">
              <div class="header">Created</div>
              <i class="dCreated"></i>
            </div>
            <div class="item">
              <div class="header">Updated</div>
              <i class="dUpdated"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- modal delete admin -->
    <div class="ui small modal deletePoliceStation">
      <i class="close icon"></i>
      <div class="header titleContainerLable">
        Delete Police Station
      </div>
      <div class="image content">
        <div class="description">
          Wanna to delete this data ?
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" style="user-select: auto;">Cancel</div>
        <div class="ui primary button deletePoliceStation" style="user-select: auto;" data-id="" > 
          OK 
        </div>
      </div>
    </div>

    <!-- create -->
    <div class="ui modal cPoliceStation">
      <i class="close icon cPoliceStation"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Create Form</center></div>
                  <form class="ui form cPoliceStation" >
                      <!-- <input type="hidden" value="" name="key" id="keySekolah"> -->
                      <div class="field">
                          <label>Nama Kantor</label>
                          <input type="text" name="nama_kantor" id="nama_kantor" placeholder="Nama Kantor">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="email" placeholder="Email">
                      </div>
                      <div class="field">
                          <label>Alamat</label>
                          <input type="text" name="alamat" id="alamat" placeholder="Alamat">
                      </div>
                      <div class="field">
                        <label>Kabupaten / Kota</label>
                        <select class="ui search dropdown kota" name="id_kota" id="ddKota">
                          
                        </select>
                      </div> 
                      <div class="field">
                          <label>Kode Pos</label>
                          <input type="number" name="kode_pos" id="kode_pos" placeholder="Kode Pos">
                      </div>
                      <div class="field">
                          <label>Telepon</label>
                          <input type="number" name="tlp" id="tlp" placeholder="Telepon">
                      </div>
                      <div class="field">
                          <label>Keterangan</label>
                          <textarea rows="3" name="ket" id="ket"></textarea>
                      </div>
                    
                      <div class="field">
                          <label>Latitude</label>
                          <input type="text" name="lat" id="lat" placeholder="Latitude">
                      </div>
                      <div class="field">
                          <label>Longitude</label>
                          <input type="text" name="long" id="long" placeholder="Longitude">
                      </div>
                      

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button cPoliceStation">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui primary button savePoliceStation">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

    <!-- edit -->
    <div class="ui modal ePoliceStation">
      <i class="close icon ePoliceStation"></i>
      <div class="example">
          <div class="ui segment">
              <div class="html ui top attached segment">
                  <div class="ui top attached large label head-form"><center class="head-font"><i class="user icon"></i> Edit Form</center></div>
                  <form class="ui form ePoliceStation" >
                      <input type="hidden" value="" name="id" id="keyPoliceStation">
                      <div class="field">
                          <label>Nama Kantor</label>
                          <input type="text" name="nama_kantor" id="e_nama_kantor" placeholder="Nama Kantor">
                      </div>
                      <div class="field">
                          <label>Email</label>
                          <input type="text" name="email" id="e_email" placeholder="Email">
                      </div>
                      <div class="field">
                          <label>Alamat</label>
                          <input type="text" name="alamat" id="e_alamat" placeholder="Alamat">
                      </div>
                      <div class="field">
                        <label>Kabupaten / Kota</label>
                        <select class="ui search dropdown kota" name="id_kota" id="ddKotaEdit">
                          
                        </select>
                      </div> 
                      <div class="field">
                          <label>Kode Pos</label>
                          <input type="number" name="kode_pos" id="e_kode_pos" placeholder="Kode Pos">
                      </div>
                      <div class="field">
                          <label>Telepon</label>
                          <input type="number" name="tlp" id="e_tlp" placeholder="Telepon">
                      </div>
                      <div class="field">
                          <label>Keterangan</label>
                          <textarea rows="3" name="ket" id="e_ket"></textarea>
                      </div>
                    
                      <div class="field">
                          <label>Latitude</label>
                          <input type="text" name="lat" id="e_lat" placeholder="Latitude">
                      </div>
                      <div class="field">
                          <label>Longitude</label>
                          <input type="text" name="long" id="e_long" placeholder="Longitude">
                      </div>
                      

                      <div class="actions">
                        <div class="fluid ui buttons">
                          <a class="ui cancel button ePoliceStation">Cancel</a>
                          <div class="or"></div>
                          <button type="submit" class="ui primary button updatePoliceStation">Save</button>
                        </div>  
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

@endsection
