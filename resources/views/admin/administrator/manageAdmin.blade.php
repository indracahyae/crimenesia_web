@extends('admin.template')

@section('page_title')
	{{'
		Manage Admin
	'}}
@endsection

@section('page_content')
	
	<!-- tabel -->
	<div class="ui segment">
        <div class="ui top attached label">
            <h4><i class="users icon"></i> Admin Accounts</h4>
        </div>
        <!-- tabel menu -->
        
        <table class="ui celled padded table" style="margin-top: 40px !important;">
            <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Password</th>
                <th>Jabatan</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="tbAkun">

            </tbody>
        </table>
        
    </div>

	<!-- modal form -->

	<!-- modal confirm delete admin -->
	
@endsection
