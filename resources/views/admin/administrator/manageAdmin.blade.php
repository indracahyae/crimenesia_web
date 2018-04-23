@extends('admin.template')

@section('page_title')
	{{'
		Manage Admin
	'}}
@endsection

@section('page_content')
	
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label titleContainerLable">
            <h4><i class="spy icon"></i> Admin Accounts</h4>
        </div>
        <!-- tabel menu -->
        <div class="ui text menu">
		  <div class="ui right dropdown item">
		    <!-- Action -->
		    <i class="options icon"></i>
		    <div class="menu">
		      <div class="item btn addAdmin" data-aksiceadmin='0'><i class="add user icon"></i> create new</div>
		      <div class="item btn mDeleteAdmin"><i class="remove user icon"></i> delete selected</div>
		    </div>
		  </div>
		</div>
        <table class="ui celled padded teal table" style="">
            <thead>
            <tr>
            	<th>
                <div class="ui master checkbox checkboxAdmin">
                  <input type="checkbox" tabindex="0" class="hidden" id="cbAdminMaster">
                </div>
            	</th>
              <th>No.</th>
              <th>Username</th>
              <th>Password</th>
              <th>Jabatan</th>
              <th>Updated</th>
              <th>Last Login</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbAdministrator">

            </tbody>
        </table>
        
    </div>

	<!-- modal form -->
	<div class="ui modal ceAdmin">
        <i class="close icon ceAdmin"></i>
        <div class="example">
            <div class="ui segment">
                <div class="html ui top attached segment">
                    <div class="ui top attached label head-form"><center class="head-font"><i class="user icon"></i> Admin Form</center></div>
                    <form class="ui form ceAdmin" enctype="multipart/form-data">
                        <input type="hidden" value="" name="id" id="idAdministrator">
                        <input type="hidden" value="" name="oldFoto" id="oldFotoCeAdmin">
                        <div class="field">
                            <label>Full Name</label>
                            <input type="text" name="nama" id="nama" placeholder="Full Name" value="">
                        </div>
                        <div class="field">
                            <label>Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" value="">
                        </div>
                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" value="">
                        </div>
                        <div class="field">
              						<label>Choose Access</label>
              						<select class="ui dropdown akses" name="akses" id="akses">
            							  <option value="">...</option>
            							  <option value="1">Main Admin</option>
            							  <option value="0">Member Admin</option>
            							</select>
              					</div>	
                        <div class="field">
                            <label>Photo</label>
                            <input type="file" name="foto" id="foto" placeholder="Photo" value="">
                            <div class="ui pointing red basic label">
                              file type : jpeg,png,jpg and max 1 MB
                            </div>
                        </div>

                        <div class="actions">
                        	<div class="fluid ui buttons">
	                        	<a class="ui cancel button manageAdmin">Cancel</a>
	                            <div class="or"></div>
	                            <!-- <button class="ui primary button saveAdmin">Simpan</button> -->
	                            <button type="submit" class="ui primary button saveAdmin">Save</button>
	                        </div>	
                        </div>
                        <!-- <div class="ui error message"></div> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="ui active centered inline ajaxLoader"></div>
    </div>


	<!-- modal confirm delete admin -->

	<!-- modal detail admin -->
	<div class="ui long modal detailAdmin">
      <i class="yellow close icon detailAdmin"></i>
      <div class="header titleContainerLable">
        Detail Admin
      </div>
      <div class="image content">
        <div class="image">
          <img src="" alt="" class="ui medium rounded image photoAdmin">
        </div>
        <div class="description">
            <div class="ui list">
              <div class="item">
                <div class="header">Full Name</div>
                <i class="dAdminName"></i>
              </div>
              <div class="item">
                <div class="header">Username</div>
                <i class="dAdminUsername"></i>
              </div>
              <div class="item">
                <div class="header">Password</div>
                <i class="dAdminPassword"></i>
              </div>
              <div class="item">
                <div class="header">Access</div>
                <i class="dAdminAccess"></i>
              </div>
              <div class="item">
                <div class="header">Created</div>
                <i class="dAdminCreated"></i>
              </div>
              <div class="item">
                <div class="header">Updated</div>
                <i class="dAdminUpdated"></i>
              </div>
              <div class="item">
                <div class="header">Last Login</div>
                <i class="dAdminLastLogin"></i>
              </div>
            </div>
        </div>
      </div>
    </div>

    <!-- modal delete admin -->
    <div class="ui small modal deleteAdmin">
      <i class="close icon"></i>
      <div class="header">
        Delete Admin
      </div>
      <div class="image content">
        <div class="description">
          Wanna to delete this data ?
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" style="user-select: auto;">Cancel</div>
        <div class="ui primary button deleteAdmin" style="user-select: auto;">OK</div>
      </div>
    </div>

@endsection
