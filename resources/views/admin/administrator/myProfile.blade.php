@extends('admin.template')

@section('page_title')
	{{'
		My Profile
	'}}
@endsection

@section('page_content')
	<div class="ui centered card">
	  <div class="image myAccountAdmin">
	    <img class="foto myAccountAdmin" src="{{asset('img/'.$foto)}}">
	  </div>
	  <div class="content">
	    <div class="ui list">
		  <div class="item">
		    <div class="header">Fullname</div>
		    <i class="nama myAccountAdmin">{{$nama}}</i>
		  </div>
		  <div class="item">
		    <div class="header">Password</div>
		    <i class="password myAccountAdmin">{{$password}}</i>
		  </div>
		  <div class="item">
		    <div class="header">Created</div>
		    <i class="created myAccountAdmin">{{$created_at}}</i>
		  </div>
		  <div class="item">
		    <div class="header">Updated</div>
		    <i class="updated myAccountAdmin">{{$updated_at}}</i>
		  </div>
		  <div class="item">
		    <div class="header">Last Login</div>
		    <i class="last_login myAccountAdmin">{{$last_login}}</i>
		  </div>
		</div>
	  </div>
	  <div class="extra content">
	  	<a class="left floated user">
	      <i class="user icon"></i>
	      <i class="username myAccountAdmin">{{$username}}</i>
	    </a>
	    <a class="right floated edit btn editMyAccount">
	      <i class="edit icon"></i>
	      edit
	    </a>
	  </div>
	</div>

	<div class="ui modal editAkunSaya">
        <i class="close icon myProfileAdmin"></i>
        <div class="example">
            <div class="ui segment">
                <div class="html ui top attached segment">
                    <div class="ui top attached label head-form"><center class="head-font"><i class="user icon"></i> Edit My Account</center></div>
                    <form class="ui form editMyAccount" enctype="multipart/form-data">
                        <input type="hidden" value="{{$username}}" name="id" id="idMyAccount">
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
                            <label>Photo</label>
                            <input type="file" name="foto" id="fotoMyProfileAdmin" placeholder="Photo" value="">
                        </div>

                        <div class="actions">
                        	<div class="fluid ui buttons">
	                        	<a class="ui cancel button myProfileAdmin">Cancel</a>
	                            <div class="or"></div>
	                            <button type="submit" class="ui positive button updateMyAccount">Save</button>
	                        </div>	
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui active centered inline ajaxLoader"></div>
    </div>
@endsection
