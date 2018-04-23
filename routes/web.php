<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('police/login');
});

//ROUTE APLIKASI ADMINISTRATOR
//login
	Route::get('vLoginAdmin', 'Admin\LoginAdminC@login');
	Route::post('setLoginAdmin', 'Admin\LoginAdminC@setLogin');
	Route::get('logOutAdmin', 'Admin\LoginAdminC@setLogout');
//ROUTE ADMIN WITH MIDDLEWARE
Route::group(['middleware' => 'checkLogin'], function () {
    //home
	Route::get('homeAdmin', 'Admin\CrudAdmin@homeAdmin');
	//my Profile
	Route::get('myProfileAdmin', 'Admin\CrudAdmin@myProfile');
	Route::get('showMyAccount', 'Admin\CrudAdmin@showMyProfile');
	Route::post('updateMyAccount', 'Admin\CrudAdmin@updateMyProfile');
	//crud manage admin
	Route::get('homeCrudAdmin', 'Admin\CrudAdmin@homeCrudAdmin');
    Route::resource('crudAdmins', 'Admin\CrudAdmin'); 
    Route::get('deleteAdmin/{id}', 'Admin\CrudAdmin@deleteAdmin');   
    Route::post('mDeleteAdmin', 'Admin\CrudAdmin@mDeleteAdmin');
    //society
    Route::get('vSociety', 'Admin\Society@vSociety');
    Route::get('listSociety', 'Admin\Society@listSociety');
    Route::get('detailSociety/{nik}', 'Admin\Society@detailSociety');
	Route::get('deleteSociety/{nik}', 'Admin\Society@deleteSociety');
	Route::post('mDeleteSociety', 'Admin\Society@mDeleteSociety');
	Route::post('cariSociety', 'Admin\Society@cari');
	Route::get('selectCariSociety/{nik}', 'Admin\Society@selectCariSociety');

	//police rd validasi search
	Route::get('vPolice', 'Admin\Police@vPolice');
	Route::get('listPolice', 'Admin\Police@listPolice');
	Route::get('detailPolice/{nrp}', 'Admin\Police@detailPolice');
	Route::get('deletePolice/{nrp}', 'Admin\Police@deletePolice');
	Route::post('mDeletePolice', 'Admin\Police@mDeletePolice');
	Route::post('cariPolice', 'Admin\Police@cari');
	Route::post('validasiPolice', 'Admin\Police@validasiPolice');

	// Police Station draw rd search + cu
	Route::get('vPoliceStation', 'Admin\PoliceStation@vPoliceStation');
	Route::get('listPoliceStation', 'Admin\PoliceStation@listPoliceStation');
	Route::get('detailPoliceStation/{id}', 'Admin\PoliceStation@detailPoliceStation');
	Route::get('deletePoliceStation/{id}', 'Admin\PoliceStation@deletePoliceStation');
	Route::post('mDeletePoliceStation', 'Admin\PoliceStation@mDeletePoliceStation');
	Route::post('cariPoliceStation', 'Admin\PoliceStation@cari');
	Route::post('createPoliceStation', 'Admin\PoliceStation@create');
	Route::get('listKota', 'Admin\PoliceStation@listKota');
	Route::post('updatePoliceStation', 'Admin\PoliceStation@updatePoliceStation');
});

//ROUTE APLIKASI POLICE
// login
Route::get('vLoginPolice', 'Police\LoginPolice@vLoginPolice');
Route::post('loginPolice', 'Police\LoginPolice@loginPolice');
// registrasi
Route::post('regPoliceStoreSociety', 'Police\LoginPolice@storeSociety');
Route::get('getListKota', 'Police\LoginPolice@listKota');
Route::get('getListPoliceStation', 'Police\LoginPolice@listPoliceStation');
Route::post('regPoliceStorePolice', 'Police\LoginPolice@storePolice');
Route::get('logOutPolice', 'Police\LoginPolice@logout');

Route::group(['middleware' => 'loginPolice'], function () {
	Route::get('homePolice', 'Police\AkunPolisi@homePolice');
	// my akun
	Route::get('vMyProfilePolice', 'Police\MyAkun@vMyProfilePolice');
	Route::get('myAkunPolice', 'Police\MyAkun@myAkunPolice');
	Route::get('myAkunPoliceDataSociety', 'Police\MyAkun@dataSociety');
	Route::get('myAkunPoliceDataPolice', 'Police\MyAkun@dataPolice');
	Route::post('myAkunPolice_UpdateDataPolice', 'Police\MyAkun@updateDataPolice');
	Route::post('myAkunPolice_UpdateDataSociety', 'Police\MyAkun@updateDataSociety');
	// Data Lapor
	Route::get('vDataLapor_Police', 'Police\DataLapor@vDataLapor');
	Route::get('listDataLapor_Police', 'Police\DataLapor@listDataLapor');
	Route::get('listDataLaporPelapor_Police/{nik}', 'Police\DataLapor@listDataLaporPelapor');
	Route::get('detailLaporKriminalitas_Police/{id}', 'Police\DataLapor@detailKriminalitas');
	Route::get('listPelakuDataLapor_Police/{id}', 'Police\DataLapor@listPelaku');
	Route::get('listDokumenPendukungDataLapor_Police/{id}', 'Police\DataLapor@listDokumenPendukung');
	Route::post('cariDataLapor_Police', 'Police\DataLapor@cari');
	// Anggota Polisi (Police Officer)
	Route::get('vAnggotaPolisi_PO', 'Police\AnggotaPolisi@view');
	Route::get('listDataAnggotaPolisi_PO', 'Police\AnggotaPolisi@listData');
	Route::get('detailAnggotaPolisi_PO/{nrp}', 'Police\AnggotaPolisi@detail');
	Route::get('deleteAnggotaPolisi_PO/{nrp}', 'Police\AnggotaPolisi@delete');
	Route::post('mDeletePO_Police', 'Police\AnggotaPolisi@mDeletePO');
	Route::post('cariPO_Police', 'Police\AnggotaPolisi@cari');
	Route::post('storeSocietyPO_Police', 'Police\AnggotaPolisi@storeSociety');
	Route::post('storePolicePO_Police', 'Police\AnggotaPolisi@storePolice');
	Route::post('updateSocietyPO_Police', 'Police\AnggotaPolisi@updateSociety');
	Route::post('updatePolicePO_Police', 'Police\AnggotaPolisi@updatePolice');
	// Kriminalitas
	Route::get('vKriminalitas_Police', 'Police\KriminalitasC@view');
	Route::get('listDataKriminalitas_Police', 'Police\KriminalitasC@listData');
	Route::get('delKriminalitas_Police/{id}', 'Police\KriminalitasC@delete');
	Route::post('mDelKriminalitas_Police', 'Police\KriminalitasC@mDelete');
	Route::get('detailKriminalitas_Police/{id}', 'Police\KriminalitasC@detailKriminalitas');
	Route::get('detailBuktiKriminalitas_Police/{id}', 'Police\KriminalitasC@detailBukti');
	Route::get('detailKriminalitasListPelaku_Police/{id}', 'Police\KriminalitasC@listPelaku');
	Route::get('detailKriminalitasPelaku_Police/{id}', 'Police\KriminalitasC@detailPelaku');
	Route::post('cariKriminalitas_Police', 'Police\KriminalitasC@cari');
	Route::post('storeKriminalitas_Police', 'Police\KriminalitasC@store');
	Route::get('listKategoriKriminalitas', 'Police\KriminalitasC@listKategoriKriminalitas');
	Route::post('storeBukti_Police', 'Police\KriminalitasC@storeBukti');
	Route::get('delBukti_Police/{id}', 'Police\KriminalitasC@deleteBukti');	
	Route::post('updateKriminalitas_Police', 'Police\KriminalitasC@update');
	Route::post('listFilterByDate_Police', 'Police\KriminalitasC@listFilterByDate');
	Route::post('listFilterByCategory_Police', 'Police\KriminalitasC@listFilterByCategory');


	// Pelaku Kriminalitas
	Route::get('vPelaku_Police', 'Police\PelakuC@view');
	Route::get('listPelaku_Police', 'Police\PelakuC@listData');
	Route::get('delPelaku_Police/{id}', 'Police\PelakuC@delete');
	Route::post('mDelPelaku_Police', 'Police\PelakuC@mDelete');
	Route::get('detailPelaku_Police/{id}', 'Police\PelakuC@detail');
	Route::post('cariPelaku_Police', 'Police\PelakuC@cari');
	Route::post('addPelaku_Police', 'Police\PelakuC@addPelaku');
	Route::post('updatePelaku_Police', 'Police\PelakuC@updatePelaku');
	Route::get('pelakuListCrime_Police/{id}', 'Police\PelakuC@listCrime');
	Route::get('delCrimePelaku_Police/{id}', 'Police\PelakuC@deleteCrime');
	Route::post('addCrimePelaku_Police', 'Police\PelakuC@addCrime');
});

// route pemetaan kriminalitas (digunakan PO & society)

//ROUTE APLIKASI ANGGOTA POLISI
Route::get('getToken', 'PoliceOfficer\LoginPoC@getToken');
Route::post('loginPo', 'PoliceOfficer\LoginPoC@login');
Route::post('logoutPo', 'PoliceOfficer\LoginPoC@logout');
Route::get('profilePo', 'PoliceOfficer\ProfilePoC@profile');
Route::get('listKantorPolisiPo', 'PoliceOfficer\ProfilePoC@listKantor');
Route::post('updateProfilePo', 'PoliceOfficer\ProfilePoC@updateProfile');
Route::get('listKriminalitasPo', 'PoliceOfficer\PemetaanPoC@listKriminalitas');
Route::get('detailListKriminalitasPo/{kota}/{alamat}', 'PoliceOfficer\PemetaanPoC@detailListKriminalitas');
Route::get('detailKriminalitasPo/{id}', 'PoliceOfficer\PemetaanPoC@detailKriminalitas');
Route::get('listPelakuPo/{id}', 'PoliceOfficer\PemetaanPoC@listPelaku');
Route::get('listPemetaanKantorPolisiPo', 'PoliceOfficer\PemetaanPoC@listKantorPolisi');
Route::get('listDataLaporPo', 'PoliceOfficer\DataLaporPoC@listDataLapor');
Route::get('delDataPengaduan/{id}', 'PoliceOfficer\DataLaporPoC@delDataLapor');
Route::get('detailLaporPo/{id}', 'PoliceOfficer\DataLaporPoC@detailLapor');
Route::get('detailPelaporPo/{id}', 'PoliceOfficer\DataLaporPoC@detailPelapor');
Route::get('listPendukungKriminalitasPo/{id}', 'PoliceOfficer\DataLaporPoC@listBukti');
Route::post('validasiLaporPo', 'PoliceOfficer\DataLaporPoC@validasiLapor');
Route::get('polygonPo', 'PoliceOfficer\PemetaanPoC@listPolygon');

//ROUTE APLIKASI SOCIETY
Route::get('getTokenS', 'Society\LoginSC@getToken');
Route::post('signUpS', 'Society\LoginSC@signUp');
Route::get('listProvinsiS', 'Society\LoginSC@provinsi');
Route::get('listKotaS/{id}', 'Society\LoginSC@listKota');
Route::post('loginS', 'Society\LoginSC@login');
Route::post('logoutS', 'Society\LoginSC@logout');
Route::get('listKriminalitasS', 'Society\PemetaanSC@listKriminalitas');
Route::get('detailKriminalitasS/{id}', 'Society\PemetaanSC@detailKriminalitas');
Route::get('detailListKriminalitasS/{kota}/{alamat}', 'Society\PemetaanSC@detailListKriminalitas');
Route::get('listPelakuS/{id}', 'Society\PemetaanSC@listPelaku');
Route::get('listPemetaanKantorPolisiS', 'Society\PemetaanSC@listKantorPolisi');
Route::get('myProfileS', 'Society\MyProfileC@detailData');
Route::post('updateMyProfileS', 'Society\MyProfileC@update');
Route::post('updateFotoMyProfileS', 'Society\MyProfileC@updateFoto');
Route::get('listLaporS', 'Society\LaporC@listLapor');
Route::get('deleteLaporS/{id}', 'Society\LaporC@deleteLapor');
Route::get('detailLaporS/{id}', 'Society\LaporC@detailLapor');
Route::get('listKantorPolisiS', 'Society\LaporC@listKantorPolisi');
Route::get('listKatCrimeS', 'Society\LaporC@listKatCrime');
Route::post('createLaporS', 'Society\LaporC@createLapor');
Route::post('updateLaporS', 'Society\LaporC@updateLapor');
Route::get('listBuktiS/{id}', 'Society\LaporC@listBukti');
Route::get('deleteBuktiS/{id}', 'Society\LaporC@deleteBukti');
Route::post('addBuktiS', 'Society\LaporC@createBukti');
Route::get('selectBuktiS/{id}', 'Society\LaporC@selectBukti');
Route::post('updateBuktiS', 'Society\LaporC@updateBukti');
Route::get('polygonS', 'Society\PemetaanSC@listPolygon');