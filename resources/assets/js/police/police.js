var urlWeb = $('meta[name="url"]').attr('content');

$(document).ready(function(){
	// setting
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'loginPolice'        	        : 'loginPolice',
        'regPoliceStoreSociety'	        : 'regPoliceStoreSociety',
        'getListKota'			        : 'getListKota',
        'getListPoliceStation'	        : 'getListPoliceStation',
        'regPoliceStorePolice'	        : 'regPoliceStorePolice',
        'myAkunPolice'			        : 'myAkunPolice',
        'myAkunPolice_UpdateDataPolice'	: 'myAkunPolice_UpdateDataPolice',
        'myAkunPolice_UpdateDataSociety': 'myAkunPolice_UpdateDataSociety',
        'listDataLapor_Police'          : 'listDataLapor_Police',
        'listDataLaporPelapor_Police'   : 'listDataLaporPelapor_Police/{nik}',
        'detailLaporKriminalitas_Police': 'detailLaporKriminalitas_Police/{id}',
        'listPelakuDataLapor_Police'    : 'listPelakuDataLapor_Police/{id}',
        'listDokumenPendukungDataLapor' : 'listDokumenPendukungDataLapor_Police/{id}',
        'cariDataLapor_Police'          : 'cariDataLapor_Police',
        'listDataAnggotaPolisi_PO'      : 'listDataAnggotaPolisi_PO',
        'detailAnggotaPolisi_PO'        : 'detailAnggotaPolisi_PO/{id}',
        'deleteAnggotaPolisi_PO'        : 'deleteAnggotaPolisi_PO/{id}',
        'mDeletePO_Police'              : 'mDeletePO_Police',
        'cariPO_Police'                 : 'cariPO_Police',
        'storeSocietyPO_Police'         : 'storeSocietyPO_Police',
        'storePolicePO_Police'          : 'storePolicePO_Police',
        'updateSocietyPO_Police'        : 'updateSocietyPO_Police',
        'updatePolicePO_Police'         : 'updatePolicePO_Police',
        'listDataKriminalitas_Police'   : 'listDataKriminalitas_Police',
        'delKriminalitas_Police'                : 'delKriminalitas_Police/{id}',
        'mDelKriminalitas_Police'               : 'mDelKriminalitas_Police',
        'detailKriminalitas_Police'             : 'detailKriminalitas_Police/{id}',
        'detailBuktiKriminalitas_Police'        : 'detailBuktiKriminalitas_Police/{id}',
        'detailKriminalitasListPelaku_Police'   : 'detailKriminalitasListPelaku_Police/{id}',
        'detailKriminalitasPelaku_Police'       : 'detailKriminalitasPelaku_Police/{id}',
        'cariKriminalitas_Police'       : 'cariKriminalitas_Police',
        'storeKriminalitas_Police'      : 'storeKriminalitas_Police',
        'getListKatCrime'               : 'listKategoriKriminalitas',
        'storeBukti_Police'             : 'storeBukti_Police',
        'delBukti_Police'               : 'delBukti_Police/{id}',
        'updateKriminalitas_Police'     : 'updateKriminalitas_Police',
        'listPelaku_Police'             : 'listPelaku_Police',
        'delPelaku_Police'              : 'delPelaku_Police/{id}',
        'mDelPelaku_Police'             : 'mDelPelaku_Police',
        'cariPelaku_Police'             : 'cariPelaku_Police',
        'detailPelaku_Police'           : 'detailPelaku_Police/{id}',
        'addPelaku_Police'              : 'addPelaku_Police',
        'updatePelaku_Police'           : 'updatePelaku_Police',
        'pelakuListCrime_Police'        : 'pelakuListCrime_Police/{id}',
        'delCrimePelaku_Police'         : 'delCrimePelaku_Police/{id}',
        'addCrimePelaku_Police'         : 'addCrimePelaku_Police',
        'listFilterByCategory_Police'   : 'listFilterByCategory_Police',
        'listFilterByDate_Police'       : 'listFilterByDate_Police'
    };

	// login
	$( ".button.login" ).on( "click", function(e) {
        e.preventDefault();
    });
    $( ".form.login" ).on( "submit", function(e) {
        e.preventDefault();
    });
	 $('.button.login').api({
        action: 'loginPolice',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.login")[0]);
            return settings;
        },
        onSuccess: function(d) {                                 
            if(d){
            	alertNoty('Login Success','info');
                location.href = urlWeb + '/homePolice';
            }else{
                alertNoty('Login Failed','warning');
            }
        },
        onFailure: function(r) {
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });

	// sign up
	$( ".btnSignUp" ).on( "click", function(e) {
       dropdownKota();
    });
	$('.modal.regPoliceDataMasyarakat')
	  .modal('attach events', '.btnSignUp')
	;
	$('.modal.regPolice')
	  .modal('attach events', '.btnRegPolice')
	;
	// save reg Data Masyarakat
	$('.button.saveRegPoliceDataMasyarakat').api({
        action: 'regPoliceStoreSociety',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.regPoliceDataMasyarakat")[0]);
            return settings;
        },
        onSuccess: function(d) {                                 
            if(d == 1){
            	alertNoty('Save Success','info');
            	$('.modal.regPolice').modal('show');
            }else if(d == 2){ //nik telah ada
                alertNoty('Use another NIK','info');
            }
        },
        onFailure: function(r) {
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });

    // save reg data Police
    $('.dropdown.pangkatPolisi').dropdown();
    $( ".btnRegPolice" ).on( "click", function(e) {
       ddKantorPolisi();
    });
    $('.button.saveRegPolice').api({
        action: 'regPoliceStorePolice',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.regPolice")[0]);
            return settings;
        },
        onSuccess: function(d) {                                 
            if(d == 1){ // sukses
            	alertNoty('Save Success','info');
            	$('.modal.regPolice').modal('hide');
            }else if(d == 2){ //NRP telah ada
                alertNoty('Use another NRP','info');
            }else if(d == 3){ //NIK telah ada
                alertNoty('Use another NIK','info');
            }
        },
        onFailure: function(r) {
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });

	// APP
	$('.ui.dropdown').dropdown({
        on: 'hover'
    });

    // MY AKUN
    $('.modal.myAkunPoliceDataPolice')
	  .modal('attach events', '.edit.btn.myAccountPoliceDataPolice', 'show')
	  .modal('setting', 'closable', false)
	;
	$('.modal.myAkunPoliceDataSociety')
	  .modal('attach events', '.edit.btn.myAccountPoliceDataSociety', 'show')
	  .modal('setting', 'closable', false)
	;
	$( ".edit.btn.myAccountPoliceDataSociety" ).on( "click", function(e) {
       
    });
    // get data My Akun
    if( $('.card.myAkunPolice').length ) 
    {
    	dropdownKota();
    	ddKantorPolisi();
        myAkunPolice();   
    }
    function myAkunPolice(){
      $('.card.myAkunPolice').api({
        action: 'myAkunPolice',
        on: 'now',
        onSuccess: function(d) {
            // isi view
            $('.topUsername').html(d.nama);
            $('.foto.myAccountPolice').attr('src',urlWeb+'/img/society/'+d.foto);
            $('.nrp.myAccountPolice').html(d.nrp);
            $('.nama.myAccountPolice').html(d.nama);
            $('.pangkat.myAccountPolice').html(pangkat_polisi(d.pangkat_polisi));
            $('.jabatan.myAccountPolice').html(d.jabatan_polisi);
            $('.nik.myAccountPolice').html(d.nik);
            $('.dokumen.myAccountPolice').html(d.dokumen);
            $('.kantor.myAccountPolice').html(d.nama_kantor);
            $('#myAccountPolice_dokumen').attr('href',urlWeb+'/doc/police/'+d.dokumen);
            // isi modal society
            $('#key_society').val(d.nik);
            $('#old_email').val(d.email_pribadi);
            $('#myAkunPoliceDataSociety_nik').val(d.nik);
            $('#myAkunPoliceDataSociety_password').val(d.password);
            $('#myAkunPoliceDataSociety_nama').val(d.nama);
            $('.dropdown.jenis_kelamin').dropdown('set selected',d.jenis_kelamin.toString());
            $('#myAkunPoliceDataSociety_tempatLahir').val(d.tempat_lahir);
            $('#myAkunPoliceDataSociety_tanggalLahir').val(d.tanggal_lahir);
            $('.dropdown.kota').dropdown('set selected',d.kota_lahir.toString());
            $('#myAkunPoliceDataSociety_alamat').val(d.alamat_tinggal);
            $('.dropdown.agama').dropdown('set selected',d.agama.toString());
            $('#myAkunPoliceDataSociety_pekerjaan').val(d.pekerjaan);
            $('#myAkunPoliceDataSociety_tlp').val(d.tlp_pribadi);
            $('#myAkunPoliceDataSociety_email').val(d.email_pribadi);
            // isi modal police
            $('#key_police').val(d.nrp);
            $('#myAkunPoliceDataPolice_old_nik').val(d.nik);
            $('#myAkunPoliceDataPolice_nrp').val(d.nrp);
            $('#myAkunPoliceDataPolice_jabatan').val(d.jabatan_polisi);
            $('#myAkunPoliceDataPolice_nik').val(d.nik);
            $('.dropdown.pangkatPolisi').dropdown('set selected',d.pangkat_polisi.toString());
            $('#ddKantorPolisi').dropdown('set selected',d.id_kantor_polisi.toString());
        }
      });  
    }
    // update data police
    $('.button.update_myAkunPoliceDataPolice').api({
        action: 'myAkunPolice_UpdateDataPolice',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.myAkunPoliceDataPolice")[0]);
            return settings;
        },
        onSuccess: function(d) {                                 
            if(d == 1){ // sukses
            	alertNoty('Save Success','info');
            	myAkunPolice();
            	$('.modal.myAkunPoliceDataPolice').modal('hide');
            }else if(d == 2){ // duplikat nrp
            	alertNoty('use another NRP','info');
            }else if(d == 3){ // duplikat nik
            	alertNoty('use another NIK','info');
            }
        },
        onFailure: function(r) {
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });

    // update data society
    $('.button.update_myAkunPoliceDataSociety').api({
        action: 'myAkunPolice_UpdateDataSociety',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.myAkunPoliceDataSociety")[0]);
            return settings;
        },
        onSuccess: function(d) {                                 
            if(d == 1){ // sukses
            	alertNoty('Save Success','info');
            	myAkunPolice();
            	$('.modal.myAkunPoliceDataSociety').modal('hide');
            }else if(d == 2){ // duplikat nik
            	alertNoty('use another NIK','info');
            }else if(d == 3){ // duplikat email
            	alertNoty('use another Email','info');
            }
        },
        onFailure: function(r) {
            nf='<ul>';
            $.each( r, function( key, value ) {
                nf += '<li>' + value + '</li>'; 
            });    
            nf+='</ul>';
            alertNoty(nf,'warning');
        }
    });

    // DATA LAPOR
    if( $('#tbDataLapor').length ) 
    {
        listDataLapor();   
    }
    function listDataLapor(){
      $('#tbDataLapor').api({
        action: 'listDataLapor_Police',
        on: 'now',
        onSuccess: function(d) {
            drawListDataLapor(d);            
        }
      });  
    }
    function drawListDataLapor(d){
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nik+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].jumlah_lapor+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddDataLapor">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailDataLapor" data-nik="'+d[key].nik+'"><i class="chevron right icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbDataLapor").html('');
        $("#tbDataLapor").html(list);
        initTableDataLapor();
    }
    function initTableDataLapor() {
        $('.ui.dropdown.ddDataLapor').dropdown({
            on: 'hover'
        });
        // list pengaduan
        $( ".item.detailDataLapor" ).on( "click", function(e) {
            $('.modal.listPengaduanPelapor').modal('show');
        });
        $('.item.detailDataLapor').api({ 
            action: 'listDataLaporPelapor_Police',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("nik");
                settings.urlData = {
                    nik: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi modal
               draw_listDataLaporPelapor(d);
               $('.modal.listPengaduanPelapor').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        function draw_listDataLaporPelapor(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<tr>'+
                                    '<td>'+d[key].waktu+'</td>'+
                                    '<td>'+cek_validator(d[key].validasi_pengaduan)+'</td>'+
                                    '<td>'+d[key].created_at+'</td>'+
                                    '<td>'+d[key].updated_at+'</td>'+
                                    '<td>'+ 
                                        '<button class="ui icon button detailLaporKriminalitas" data-id="'+d[key].id+'">'+
                                          '<i class="file text outline icon"></i>'+
                                        '</button>'+
                                    '</td>'+
                                    '<td>'+ 
                                        '<button class="ui icon teal button detailLaporDokumenPendukung" data-id="'+d[key].id+'">'+
                                          '<i class="folder open icon"></i>'+
                                        '</button>'+
                                    '</td>'+
                                '</tr>';
                    }
                    no++;
                }
            }

            $("#listPengaduanPelapor").html('');
            $("#listPengaduanPelapor").html(list);

            // detail pengaduan (data kriminalitas)
            $('.button.detailLaporKriminalitas').api({
                action: 'detailLaporKriminalitas_Police',
                urlData: {
                  id: $(this).data('id')
                },
                method : 'GET',
                onSuccess: function(d) {
                    $('.modal.detailLaporKriminalitas').modal('show');
                    $('.detailJudul').html(d.judul);
                    $('.detailWaktu').html(d.waktu);
                    $('.detailKota').html(d.nama_kota);
                    $('.detailAlamat').html(d.alamat);
                    $('.detailTentangPelaku').html(d.t_pelaku);
                    $('.detailTentangKorban').html(d.t_korban);
                    $('.detailLat').html(d.lat);
                    $('.detailLong').html(d.long);
                    $('.detailKatKriminalitas').html(d.nama_kat_kriminalitas);
                    $('.detailNamaKantor').html(d.nama_kantor);
                    $('.button.detailLaporKriminalitas_Pelaku').data('id',d.id_kriminalitas);

                },
                onFailure: function(r) {
                    
                }
            });
            $( ".button.back_detailLaporKriminalitas" ).on( "click", function(e) {
                $('.modal.listPengaduanPelapor').modal('show');
            });
            // list dokumen pendukung
            $('.button.detailLaporDokumenPendukung').api({
                action: 'listDokumenPendukungDataLapor',
                urlData: {
                  id: $(this).data('id')
                },
                method : 'GET',
                onSuccess: function(d) {
                    drawListDokPendukung_DataLapor(d);
                    $('.modal.laporDokPendukung').modal('show');
                },
                onFailure: function(r) {
                    
                }
            });
            $( ".button.back_listDokPendukung" ).on( "click", function(e) {
                $('.modal.listPengaduanPelapor').modal('show');
            });
        }
        // list pelaku
        $('.button.detailLaporKriminalitas_Pelaku').api({
            action: 'listPelakuDataLapor_Police',
            urlData: {
              id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                // draw list
                drawListPelaku_DataLapor(d);
                $('.modal.laporListPelaku').modal('show');
            },
            onFailure: function(r) {
                
            }
        });
        // draw list pelaku
        function drawListPelaku_DataLapor(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<tr>'+
                                    '<td>'+d[key].nik+'</td>'+
                                    '<td>'+d[key].nama+'</td>'+
                                    '<td>'+d[key].ket+'</td>'+                                    
                                '</tr>';
                    }
                    no++;
                }
            }

            $("#listPelaku_DataLapor").html('');
            $("#listPelaku_DataLapor").html(list);
        }
        // back from list pelaku - Data Lapor
        $( ".button.back_listPelaku_DataLapor" ).on( "click", function(e) {
            $('.modal.detailLaporKriminalitas').modal('show');
        });
        // draw list dok pendukung
        function drawListDokPendukung_DataLapor(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<tr>'+
                                    '<td>'+d[key].ket+'</td>'+
                                    '<td>'+
                                        '<a target="_blank" href="'+urlWeb+'/img/crime/'+d[key].dokumen+'">'+d[key].dokumen+'</a>'+
                                    '</td>'+
                                '</tr>';
                    }
                    no++;
                }
            }

            $("#listDokPendukung_DataLapor").html('');
            $("#listDokPendukung_DataLapor").html(list);
        }

        function cek_validator(d) {
            // if (d == null) {
            //     return 'data belum valid'
            // }else{
            //     return d;
            // }
            switch(d){
                case 0:
                    return "Tidak Valid";
                    break;
                case 1:
                    return "Valid";
                    break;
                case 2:
                    return "Dalam Pemeriksaan";
                    break;
                case 3:
                    return "Belum Diperiksa";
                    break;
                default:
                    return d;
                    break;
            }
        }       
    }
    // cari Data Lapor
    $('.ui.search.dataLapor')
        .search({
            apiSettings: {
                action: 'cariDataLapor_Police',
                method : 'POST',
                beforeSend: function(settings) {
                    settings.data.key = $('.inpSearch').val();
                    return settings;
                }
            },
            cache: false,
            fields: {
                results     : 'data',
                title       : 'nik',
                description : 'nama'
            },
            minCharacters : 3,
            onSelect: function(d) {
                drawListDataLapor([d]);
            },
        })
    ;
    $( ".button.reload_dataLapor" ).on( "click", function(e) {
        listDataLapor();
    });

    // ANGGOTA POLISI
    // list data
    if( $('#tbDataAnggotaPolisi').length ) 
    {
        listAnggotaPolisi();   
    }
    $( ".btn.reloadDataPO" ).on( "click", function(e) {
        listAnggotaPolisi();
    });
    function listAnggotaPolisi(){
      $('#tbDataAnggotaPolisi').api({
        action: 'listDataAnggotaPolisi_PO',
        on: 'now',
        onSuccess: function(d) {
            drawListAnggotaPolisi(d);            
        }
      });  
    }
    function drawListAnggotaPolisi(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxPoliceOfficer">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbPoliceOfficerSub" data-id="'+d[key].nrp+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nrp+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].pangkat_polisi+'</td>'+
                                '<td>'+d[key].jabatan_polisi+'</td>'+  
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddPoliceOfficer">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailPoliceOfficer" data-id="'+d[key].nrp+'"><i class="user icon"></i></div>'+
                                        '<div class="item editPoliceOfficer" data-id="'+d[key].nrp+'"><i class="edit icon"></i></div>'+
                                        '<div class="item deletePoliceOfficer" data-id="'+d[key].nrp+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+                             
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbDataAnggotaPolisi").html('');
        $("#tbDataAnggotaPolisi").html(list);
        intTabelAnggotaPolisi();
    }
    function intTabelAnggotaPolisi() {
        $('.ui.checkboxPoliceOfficer').checkbox();
        $('.ui.dropdown.ddPoliceOfficer').dropdown({
            on: 'hover'
        });
        $('.ui.accordion')
          .accordion()
        ;
        // detail
        $('.item.detailPoliceOfficer').api({
            action: 'detailAnggotaPolisi_PO',
            urlData: {
              id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                $('.detail_nrp').html(d.nrp);
                $('.detail_pangkat').html(pangkat_polisi(d.pangkat_polisi));
                $('.detail_jabatan').html(d.jabatan_polisi);
                $('.detail_kantor').html(d.nama_kantor);

                $('.detail_nik').html(d.nik);
                $('.detail_nama').html(d.nama);
                $('.detail_kelamin').html(vKelamin(d.jenis_kelamin));
                $('.detail_tempatLahir').html(d.tempat_lahir);
                $('.detail_tglLahir').html(d.tanggal_lahir);
                $('.detail_kota').html(d.nama_kota);
                $('.detail_alamat').html(d.alamat);
                $('.detail_agama').html(vAgama(d.agama));
                $('.detail_pekerjaan').html(d.pekerjaan);
                $('.detail_tlp').html(d.tlp);
                $('.detail_email').html(d.email);
                $('.fotoPO').attr('src',urlWeb+'/img/society/'+d.foto);
                $('.detail_lastLogin').html(d.last_login);
                $('.modal.detailPO').modal('show');
            },
            onFailure: function(r) {
                
            }
        });
        // delete
        $('.modal.deletePO')
          .modal('attach events', '.item.deletePoliceOfficer', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deletePoliceOfficer').on("click", function(e) {
            $('.button.deletePO').data('id',$(this).data('id'));
        });
        $('.button.deletePO').api({
            action: 'deleteAnggotaPolisi_PO',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deletePO').modal('hide');
               alertNoty('Delete Success','info');
               listAnggotaPolisi();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        // multiple delete
        $('.master.checkbox.checkboxPoliceOfficer')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbPoliceOfficerSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbPoliceOfficerSub").prop('checked', false); 
            }
          });
        $('.btn.mDelete').api({
            action: 'mDeletePO_Police',
            method : 'POST',
            beforeSend: function(set){
                alertNoty('Delete process','warning');
                var ids = []; 
                $(".hidden.cbPoliceOfficerSub:checked").each(function() {  
                    ids.push($(this).attr('data-id'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listAnggotaPolisi();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });
        // cari
        $('.ui.search.dataAnggotaPolisi')
            .search({
                apiSettings: {
                    action: 'cariPO_Police',
                    method : 'POST',
                    beforeSend: function(settings) {
                        settings.data.key = $('.inpSearch').val();
                        return settings;
                    }
                },
                cache: false,
                fields: {
                    results     : 'data',
                    title       : 'nama',
                    description : 'nrp'
                },
                minCharacters : 3,
                onSelect: function(d) {
                    drawListAnggotaPolisi([d]);
                },
            })
        ;
         
        // create society data
        $( ".btn.addPO" ).on( "click", function(e) {
            dropdownKota();
           $('.modal.createSociety_PO').modal('show'); 
        });
        $( ".button.moveTo_modalStorePOlice_PO" ).on( "click", function(e) {
           $('.modal.createPolice_PO').modal('show'); 
        });
        $('.button.storeSociety_PO').api({
            action: 'storeSocietyPO_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.createSociety_PO")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d == 1){
                    alertNoty('Save Success','info');
                    $('.modal.createPolice_PO').modal('show');
                }else if(d == 2){ //nik telah ada
                    alertNoty('Use another NIK','info');
                }else if(d == 3){ //nik telah ada
                    alertNoty('Use another Email','info');
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });
        // create police data
        $( ".button.moveTo_modalCreateSociety_PO" ).on( "click", function(e) {
           $('.modal.createSociety_PO').modal('show'); 
        });
        $('.dropdown.pangkatPolisi').dropdown();
        $('.button.storePolice_PO').api({
            action: 'storePolicePO_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.createPolice_PO")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d == 1){ // sukses
                    alertNoty('Save Success','info');
                    $('.modal.createPolice_PO').modal('hide');
                    listAnggotaPolisi();
                }else if(d == 2){ //NRP telah ada
                    alertNoty('Use another NRP','info');
                }else if(d == 3){ //NIK telah ada
                    alertNoty('Use another NIK','info');
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // update society data
            $( ".item.editPoliceOfficer" ).on( "click", function(e) {
                dropdownKota();
            });
            $( ".button.moveTo_ModalUpdatePolice_PO" ).on( "click", function(e) {
                $('.modal.updatePolice_PO').modal('show');
            });
            // isi modal
            $('.item.editPoliceOfficer').api({ 
                action: 'detailAnggotaPolisi_PO',
                method : 'GET',
                urlData: {
                  id: $(this).data("id")
                },
                onSuccess: function(d) {
                   // isi form society
                   $('#keySociety').val(d.nik);
                   $('#old_email').val(d.email);
                   $('#nik_PO').val(d.nik);
                   $('#password_PO').val(d.password);
                   $('#nama_PO').val(d.nama);
                   $('.dropdown.jenis_kelamin').dropdown('set selected',d.jenis_kelamin.toString());
                   $('#tempat_lahir_PO').val(d.tempat_lahir);
                   $('#tanggal_lahir_PO').val(d.tanggal_lahir);
                   $('.dropdown.kota').dropdown('set selected',d.id_kota.toString());                   $('#alamat_PO').val(d.alamat);
                   $('.dropdown.agama').dropdown('set selected',d.agama.toString()); 
                   $('#pekerjaan_PO').val(d.pekerjaan);
                   $('#tlp_PO').val(d.tlp);
                   $('#email_PO').val(d.email);
                   $('.modal.updateSociety_PO').modal('show');
                   
                   // isi form police
                   $('#keyPolice').val(d.nrp);
                   $('#old_nik').val(d.nik);
                   $('#nrp_PO').val(d.nrp);
                   $('#pangkat_polisi_PO').dropdown('set selected',d.pangkat_polisi.toString());
                   $('#jabatan_polisi_PO').val(d.jabatan_polisi);
                   $('.nik_PO').val(d.nik);
                },
                onFailure: function(r) {
                   alertNoty('refresh page','warning'); 
                }
            });
            // update
            $('.button.updateSociety_PO').api({
                action: 'updateSocietyPO_Police',
                method : 'POST',
                cache  : false,
                processData: false,
                contentType: false,
                beforeSend: function(settings){
                    settings.data = new FormData($(".form.updateSociety_PO")[0]);
                    return settings;
                },
                onSuccess: function(d) {                                 
                    if(d == 1){ // sukses
                        alertNoty('Save Success','info');
                        listAnggotaPolisi();
                        $('.modal.updateSociety_PO').modal('hide');
                        $('.modal.updatePolice_PO').modal('show');
                    }else if(d == 2){ // duplikat nik
                        alertNoty('use another NIK','info');
                    }else if(d == 3){ // duplikat email
                        alertNoty('use another Email','info');
                    }
                },
                onFailure: function(r) {
                    nf='<ul>';
                    $.each( r, function( key, value ) {
                        nf += '<li>' + value + '</li>'; 
                    });    
                    nf+='</ul>';
                    alertNoty(nf,'warning');
                }
            });

        // update police data
            $( ".button.moveTo_ModalUpdateSociety_PO" ).on( "click", function(e) {
                $('.modal.updateSociety_PO').modal('show');
            });
            // update
            $('.button.updatePolice_PO').api({
                action: 'updatePolicePO_Police',
                method : 'POST',
                cache  : false,
                processData: false,
                contentType: false,
                beforeSend: function(settings){
                    settings.data = new FormData($(".form.updatePolice_PO")[0]);
                    return settings;
                },
                onSuccess: function(d) {                                 
                    if(d == 1){ // sukses
                        alertNoty('Save Success','info');
                        listAnggotaPolisi();
                        $('.modal.updatePolice_PO').modal('hide');
                    }else if(d == 2){ // duplikat nrp
                        alertNoty('use another NRP','warning');
                    }else if(d == 3){ // duplikat nik / nik not found
                        alertNoty('use another NIK','warning');
                    }
                },
                onFailure: function(r) {
                    nf='<ul>';
                    $.each( r, function( key, value ) {
                        nf += '<li>' + value + '</li>'; 
                    });    
                    nf+='</ul>';
                    alertNoty(nf,'warning');
                }
            });
    }

    // MENU KRIMINALITAS
    // list data
    if( $('#tbDataKriminalitas').length ) 
    {
        listKriminalitas();   
    }
    $( ".btn.reloadData" ).on( "click", function(e) {
       listKriminalitas();
    });
    function listKriminalitas(){
      $('#tbDataKriminalitas').api({
        action: 'listDataKriminalitas_Police',
        on: 'now',
        onSuccess: function(d) {
            drawListKriminalitas(d);            
        }
      });  
    }
    function drawListKriminalitas(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxKriminalitas_Polisi">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbKriminalitas_PolisiSub" data-id="'+d[key].id_kriminalitas+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].judul+'</td>'+
                                '<td>'+d[key].waktu+'</td>'+
                                '<td>'+d[key].nama_kategori_kriminalitas+'</td>'+
                                '<td>'+d[key].nama_kantor+'</td>'+ 
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon button ddBuktiKriminalitas_Polisi">'+
                                        '<i class="file icon"></i>'+
                                        '<div class="menu">'+
                                            '<div class="item addBukti" data-id="'+d[key].id_kriminalitas+'"><i class="plus icon"></i></div>'+
                                            '<div class="item delBukti" data-id="'+d[key].id_kriminalitas+'"><i class="remove icon"></i></div>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>'+    
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddKriminalitas_Polisi">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detail" data-id="'+d[key].id_kriminalitas+'"><i class="user icon"></i></div>'+
                                        '<div class="item edit" data-id="'+d[key].id_kriminalitas+'"><i class="edit icon"></i></div>'+
                                        '<div class="item delete" data-id="'+d[key].id_kriminalitas+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+                             
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbDataKriminalitas").html('');
        $("#tbDataKriminalitas").html(list);
        intTabelKriminalitas_Polisi();
    }

    // filter by Category
    $( ".btn.filterCategory" ).on( "click", function(e) {
        $('.modal.filterKriminalitasByCategory_P').modal('show');  
        getListCategoryCrime();
    });
    $('.button.filterByCategory').api({
        action: 'listFilterByCategory_Police',
        method : 'POST',
        beforeSend: function(set){
            alertNoty('Filtering process','warning');
            var ids = []; 
            $(".cbFilterCategoryCrime:checked").each(function() {  
                ids.push($(this).attr('data-id'));
            }); 
            ids = ids.join(",");
            set.data = {
                ids : ids
            };
            return set;
        },
        onSuccess: function(d) {
            alertNoty('Filter Success','info');
            drawListKriminalitas(d);
            $('.modal.filterKriminalitasByCategory_P').modal('hide');
        },
        onFailure: function(d) {
            alertNoty('refresh page','warning'); 
        }
    });

    // filter by Date
    $( ".btn.filterDate" ).on( "click", function(e) {
        $('.modal.filterKriminalitasByDate_P').modal('show');  
    });
    $('.button.filterByDate').api({
        action: 'listFilterByDate_Police',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.filterCrimeByDate")[0]);
            return settings;
        },
        onSuccess: function(d) {       
            drawListKriminalitas(d);                          
            alertNoty('Filter Success','info');
            $('.modal.filterKriminalitasByDate_P').modal('hide');
        },
        onFailure: function(r) {
            alertNoty('network error, try again','warning');
        }
    });


    function intTabelKriminalitas_Polisi() {
        $('.ui.checkboxKriminalitas_Polisi').checkbox();
        $('.ui.dropdown.ddKriminalitas_Polisi, .ui.ddBuktiKriminalitas_Polisi').dropdown({
            on: 'hover'
        });

        // delete
        $('.modal.delKriminalitas')
          .modal('attach events', '.item.delete', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.delete').on("click", function(e) {
            $('.button.delKriminalitas').data('id',$(this).data('id'));
        });
        $('.button.delKriminalitas').api({
            action: 'delKriminalitas_Police',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.delKriminalitas').modal('hide');
               alertNoty('Delete Success','info');
               listKriminalitas();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        $('.master.checkbox.checkboxKriminalitas_Polisi')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbKriminalitas_PolisiSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbKriminalitas_PolisiSub").prop('checked', false); 
            }
          });
        $('.btn.mDelete').api({
            action: 'mDelKriminalitas_Police',
            method : 'POST',
            beforeSend: function(set){
                alertNoty('Delete process','warning');
                var ids = []; 
                $(".hidden.cbKriminalitas_PolisiSub:checked").each(function() {  
                    ids.push($(this).attr('data-id'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listKriminalitas();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

        // detail - crime
        $('.item.detail').api({
            action: 'detailKriminalitas_Police',
            urlData: {
              id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                $('.detailKriminalitas_judul').html(d.judul);
                $('.detailKriminalitas_waktu').html(d.waktu);
                $('.detailKriminalitas_kota').html(d.nama_kota);
                $('.detailKriminalitas_alamat').html(d.alamat);
                $('.detailKriminalitas_TentangPelaku').html(d.t_pelaku);
                $('.detailKriminalitas_TentangKorban').html(d.t_korban);
                $('.detailKriminalitas_deskripsi').html(d.deskripsi_kejadian);
                $('.detailKriminalitas_lat').html(d.lat);
                $('.detailKriminalitas_long').html(d.long);
                $('.detailKriminalitas_KatKriminalitas').html(d.nama_kategori_kriminalitas);
                $('.detailKriminalitas_KantorPolisi').html(d.nama_kantor);
                $('.button.open_detailBukti').data('id',d.id_kriminalitas);
                $('.button.open_listPelaku').data('id',d.id_kriminalitas);
                $('.modal.detailKriminalitas').modal('show');
            },
            onFailure: function(r) {
                
            }
        });

        // detai - list bukti 
        $('.backTo_detailKriminalitas').on("click", function(e) {
            $('.modal.detailKriminalitas').modal('show');
        });
        $('.button.open_detailBukti').api({
            action: 'detailBuktiKriminalitas_Police',
            urlData: {
              id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                drawListBukti_DetailKriminalitas(d);
                $('.modal.detailBukti').modal('show');
            },
            onFailure: function(r) {
                
            }
        });
        function drawListBukti_DetailKriminalitas(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<div class="item">'+
                                  '<a href="'+urlWeb+'/img/crime/'+d[key].dokumen+'" class="header" target="_blank">'+d[key].dokumen+'</a>'+
                                  '<div class="description">'+
                                    d[key].ket+
                                  '</div>'+
                                '</div>';
                    }
                    no++;
                }
            }

            $(".list.detailBukti").html('');
            $(".list.detailBukti").html(list);
        }

        // detail - list pelaku
        $('.button.open_listPelaku').api({
            action: 'detailKriminalitasListPelaku_Police',
            urlData: {
              id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                drawListPelaku_DetailKriminalitas(d);
                $('.modal.listPelaku').modal('show');
            },
            onFailure: function(r) {
                
            }
        });
        function drawListPelaku_DetailKriminalitas(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<div class="item">'+
                                  '<a class="header detailKriminalitas_detailPelaku" data-id="'+d[key].id+'" >NIK: '+d[key].nik+'</a>'+
                                  '<div class="description">'+
                                    d[key].ket+
                                  '</div>'+
                                '</div>';
                    }
                    no++;
                }
            }

            $(".list.listPelaku").html('');
            $(".list.listPelaku").html(list);
            detailKriminalitas_detailPelaku();
        }

        // detail - pelaku
        $('.backTo_ListPelaku').on("click", function(e) {
            $('.modal.listPelaku').modal('show');
        });
        function detailKriminalitas_detailPelaku() {
            $('.detailKriminalitas_detailPelaku').api({
                action: 'detailKriminalitasPelaku_Police',
                urlData: {
                  id: $(this).data('id')
                },
                method : 'GET',
                onSuccess: function(d) {
                    $('.detail_nik').html(d.nik);
                    $('.detail_nama').html(d.nama);
                    $('.detail_kelamin').html(vKelamin(d.jenis_kelamin));
                    $('.detail_tempatLahir').html(d.tempat_lahir);
                    $('.detail_tglLahir').html(d.tanggal_lahir);
                    $('.detail_kota').html(d.nama_kota);
                    $('.detail_alamat').html(d.alamat);
                    $('.detail_agama').html(vAgama(d.agama));
                    $('.detail_pekerjaan').html(d.pekerjaan);
                    $('.detail_tlp').html(d.tlp);
                    $('.detail_email').html(d.email);
                    $('.detail_ket').html(d.ket);
                    $('.detail_foto').attr('src',urlWeb+'/img/society/'+d.foto);
                    $('.modal.detailPelaku').modal('show');
                },
                onFailure: function(r) {
                    
                }
            });
        }  

        // cari kriminalitas
        $('.ui.search.dataKriminalitas_Polisi')
            .search({
                apiSettings: {
                    action: 'cariKriminalitas_Police',
                    method : 'POST',
                    beforeSend: function(settings) {
                        settings.data.key = $('.inpSearch').val();
                        return settings;
                    }
                },
                cache: false,
                fields: {
                    results     : 'data',
                    title       : 'judul',
                    description : 'waktu'
                },
                minCharacters : 3,
                onSelect: function(d) {
                    drawListKriminalitas([d]);
                },
            })
        ;

        // Create Crime 
        $( ".btn.add" ).on( "click", function(e) {
            $('.modal.createKriminalitas').modal('show'); 
            dropdownKota();
            dropdownKatCrime();
        });
        $('.button.saveCreateKriminalitas').api({
            action: 'storeKriminalitas_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.createCrime_P")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d){ // sukses
                    alertNoty('Save Success','info');
                    $('.modal.createKriminalitas').modal('hide');
                    listKriminalitas();
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // create bukti 
        $( ".item.addBukti" ).on( "click", function(e) {
            $('.modal.createBuktiKriminalitas').modal('show');
            $('#keyBukti').val($(this).data('id'));
        });
        $('.button.saveCreateBuktiKriminalitas').api({
            action: 'storeBukti_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.createBukti_P")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d){ // sukses
                    alertNoty('Save Success','info');
                    $('.modal.createBuktiKriminalitas').modal('hide');
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });


        // Del Bukti Crime
        // Open Modal
        $( ".item.delBukti" ).on( "click", function(e) {
            $('.modal.delBuktiKriminalitas').modal('show');
            getListBukti($(this).data('id')); 
        });
        // get list bukti
        function getListBukti(key) {
            $('meta[name="_token"]').api({
                action: 'detailBuktiKriminalitas_Police',
                urlData: {
                    id: key
                  },
                method: 'GET',
                on: 'now',
                onSuccess: function(d) {
                    console.log(d);
                    drawListBukti(d);
                }
            });
        }
        // draw list bukti
        function drawListBukti(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<tr>' +
                                    '<td>'+ no +'</td>' +
                                    '<td>'+ d[key].ket +'</td>' +
                                    '<td>'+ d[key].dokumen +'</td>' +
                                    '<td>'+
                                        '<button class="ui icon button delDataBukti" data-id="'+d[key].id+'">' +
                                            '<i class="remove icon"></i>' +
                                        '</button>' +
                                    '</td>' +
                                '</tr>';
                    }
                    no++;
                }
            }

            $("#tbListBukti").html('');
            $("#tbListBukti").html(list);
            initDelDataBukti();
        }
        // delete bukti
        function initDelDataBukti() {
            $('.button.delDataBukti').api({
                action: 'delBukti_Police',
                method : 'GET',
                beforeSend: function(settings){
                    var d = $(this).data("id");
                    settings.urlData = {
                        id: d 
                      };
                    return settings;
                },
                onSuccess: function(d) {
                   alertNoty('Delete Success','info');
                   $('.modal.delBuktiKriminalitas').modal('hide');
                   $("#tbListBukti").html('');
                },
                onFailure: function(r) {
                   alertNoty('refresh page','warning'); 
                }
            });
        }
        
        // Update Crime 
        $( ".item.edit" ).on( "click", function(e) {
            dropdownKota();
            dropdownKatCrime(); 
        });
        // ambil data > isi ke form > update
        $('.item.edit').api({ 
            action: 'detailKriminalitas_Police',
            method : 'GET',
            urlData: {
              id: $(this).data("id")
            },
            onSuccess: function(d) {
               // isi form
               console.log(d);
               $('#keyEditCrime').val(d.id_kriminalitas);
               $('.judul_fe').val(d.judul);
               $('.alamat_fe').val(d.alamat);
               $('.tPelaku_fe').val(d.t_pelaku);
               $('.tKorban_fe').val(d.t_korban);
               $('.kejadian_fe').val(d.deskripsi_kejadian);
               $('.lat_fe').val(d.lat);
               $('.long_fe').val(d.long);
               $('.waktu_fe').val(d.waktu);
               $('#ddKotaEdit').dropdown('set selected',d.id_kota.toString());
               $('#ddKatCrimeEdit').dropdown('set selected',d.id_kat_kriminalitas.toString());

               $('.modal.updateKriminalitas').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        $('.button.saveUpdateKriminalitas').api({
            action: 'updateKriminalitas_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.updateCrime_P")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d){ // sukses
                    alertNoty('Save Success','info');
                    $('.modal.updateKriminalitas').modal('hide');
                    listKriminalitas();
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

    }

    // Menu Pelaku
    // List Pelaku
    if( $('#tbPelaku').length ) 
    {
        listPelaku();   
    }
     // reload data
     $( ".btn.reloadData" ).on( "click", function(e) {
        listPelaku();
     });
    function listPelaku(){
      $('#tbPelaku').api({
        action: 'listPelaku_Police',
        on: 'now',
        onSuccess: function(d) {
            drawListPelaku(d);            
        }
      });  
    }
    function drawListPelaku(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>' +
                                '<td>'+
                                    '<div class="ui child checkbox checkboxPelaku_Polisi">'+
                                        '<input type="checkbox" tabindex="0" class="hidden cbPelaku_PolisiSub" data-id="'+d[key].nik+'">'+
                                    '</div>'+ 
                                '</td>' +
                                '<td>'+ no +'</td>' +
                                '<td>'+d[key].nik+'</td>' +
                                '<td>'+d[key].nama+'</td>' +
                                '<td>'+ vKelamin_icon(d[key].jenis_kelamin) +'</td>' +
                                '<td>' +
                                    '<div class="ui bottom pointing dropdown icon button ddCrime_P">'+
                                        '<i class="ui icon">' + d[key].jumlah_kriminalitas + '</i>' +
                                        '<div class="menu">'+
                                            '<div class="item listCrime" data-id="'+d[key].nik+'"><i class="unordered list icon"></i></div>'+
                                            '<div class="item addCrime" data-id="'+d[key].nik+'"><i class="plus icon"></i></div>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>' +
                                '<td>' +
                                    '<div class="ui bottom pointing dropdown icon teal button ddAksiPelaku_Polisi">'+
                                        '<i class="rocket icon"></i>'+
                                        '<div class="menu">'+
                                            '<div class="item detail" data-id="'+d[key].nik+'"><i class="user icon"></i></div>'+
                                            '<div class="item edit" data-id="'+d[key].nik+'"><i class="edit icon"></i></div>'+
                                            '<div class="item delete" data-id="'+d[key].nik+'"><i class="remove user icon"></i></div>'+
                                        '</div>'+
                                    '</div>'+
                               ' </td>'+
                           ' </tr>';
                }
                no++;
            }
        }

        $("#tbPelaku").html('');
        $("#tbPelaku").html(list);
        initTabelPelaku_Polisi();
    }
    function initTabelPelaku_Polisi() {
        $('.ui.checkboxPelaku_Polisi').checkbox();
        $('.ui.dropdown.ddAksiPelaku_Polisi, .ui.dropdown.ddCrime_P').dropdown({
            on: 'hover'
        });

        // delete
        $('.item.delete').on("click", function(e) {
            $('.modal.delPelaku_P').modal('show');
            $('.button.delPelaku_P').data('id',$(this).data('id'));
        });
        $('.button.delPelaku_P').api({
            action: 'delPelaku_Police',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.delPelaku_P').modal('hide');
               alertNoty('Delete Success','info');
               listPelaku();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        $('.master.checkbox.checkboxPelaku_Polisi')
            .checkbox({
            // check all children
            onChecked: function() {
            $(".hidden.cbPelaku_PolisiSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
            $(".hidden.cbPelaku_PolisiSub").prop('checked', false); 
            }
        });
        $('.btn.mDelete').api({
            action: 'mDelPelaku_Police',
            method : 'POST',
            beforeSend: function(set){
                alertNoty('Delete process','warning');
                var ids = []; 
                $(".hidden.cbPelaku_PolisiSub:checked").each(function() {  
                    ids.push($(this).attr('data-id'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listPelaku();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

        // cari Pelaku
        $('.ui.search.dataPelaku_Polisi')
        .search({
            apiSettings: {
                action: 'cariPelaku_Police',
                method : 'POST',
                beforeSend: function(settings) {
                    settings.data.key = $('.inpSearch').val();
                    return settings;
                }
            },
            cache: false,
            fields: {
                results     : 'data',
                title       : 'nama',
                description : 'nik'
            },
            minCharacters : 3,
            onSelect: function(d) {
                drawListPelaku([d]);
            },
        });

        // detail Pelaku            
        $('.item.detail').api({
            action: 'detailPelaku_Police',
            urlData: {
                id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                console.log(d);
                $('.detail_nik').html(d.nik);
                $('.detail_nama').html(d.nama);
                $('.detail_kelamin').html(vKelamin(d.jenis_kelamin));
                $('.detail_tempatLahir').html(d.tempat_lahir);
                $('.detail_tglLahir').html(d.tanggal_lahir);
                $('.detail_kota').html(d.nama_kota);
                $('.detail_alamat').html(d.alamat);
                $('.detail_agama').html(vAgama(d.agama));
                $('.detail_pekerjaan').html(d.pekerjaan);
                $('.detail_tlp').html(d.tlp);
                $('.detail_email').html(d.email);
                $('.fotoPelaku').attr('src',urlWeb+'/img/society/'+d.foto);
                $('.modal.detailPelaku_P').modal('show');
            },
            onFailure: function(r) {
                
            }
        });

        //cari crime (di form)
        $('.ui.search.dataKriminalitas_Polisi')
        .search({
            apiSettings: {
                action: 'cariKriminalitas_Police',
                method : 'POST',
                beforeSend: function(settings) {
                    settings.data.key = $('.inpSearchCrime').val();
                    return settings;
                }
            },
            cache: false,
            fields: {
                results     : 'data',
                title       : 'id_kriminalitas',
                description : 'judul'
            },
            minCharacters : 3,
            onSelect: function(d) {
                
            },
        });
        $('.ui.search.addCrimePelaku_Polisi')
        .search({
            apiSettings: {
                action: 'cariKriminalitas_Police',
                method : 'POST',
                beforeSend: function(settings) {
                    settings.data.key = $('.inpSearchAddCrime').val();
                    return settings;
                }
            },
            cache: false,
            fields: {
                results     : 'data',
                title       : 'id_kriminalitas',
                description : 'judul'
            },
            minCharacters : 3,
            onSelect: function(d) {
                
            },
        });
    

        // add Data Pelaku
        $('.btn.add').on("click", function(e) {
            dropdownKota();
            $('.modal.addDataPelaku_P').modal('show');
        });
        $('.button.submitDataPelaku_P').api({
            action: 'addPelaku_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.createDataPelaku_P")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d == true){
                    alertNoty('Save Success','info');
                    $('.modal.addDataPelaku_P').modal('hide');
                    $(".form.createDataPelaku_P")[0].reset();
                    listPelaku();
                }else if(d == 2){ //nik telah ada
                    alertNoty('Use another NIK','info');
                }else if(d == 3){ //email telah ada
                    alertNoty('Use another Email','info');
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // update data pelaku
        $('.item.edit').on("click", function(e) {
            $(".form.editDataPelaku_P")[0].reset();
            dropdownKota();
            $('.modal.editDataPelaku_P').modal('show');
        });
        // isi modal
        $('.item.edit').api({ 
            action: 'detailPelaku_Police',
            method : 'GET',
            urlData: {
              id: $(this).data("id")
            },
            onSuccess: function(d) {
               // isi form society
               $('#keyPelaku_edit').val(d.nik);
               $('#old_email').val(d.email);
               $('#nik_edit').val(d.nik);
               $('#nama_edit').val(d.nama);
               $('#tempat_lahir_edit').val(d.tempat_lahir);
               $('.dropdown.jenis_kelamin').dropdown('set selected',d.jenis_kelamin.toString());
               $('#tanggal_lahir_edit').val(d.tanggal_lahir);
               $('#ddKotaEdit').dropdown('set selected',d.id_kota.toString());
               $('#alamat_edit').val(d.alamat);
               $('.dropdown.agama').dropdown('set selected',d.agama.toString());
               $('#pekerjaan_edit').val(d.pekerjaan);
               $('#tlp_edit').val(d.tlp);
               $('#email_edit').val(d.email);
               //    foto

            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        // submit
        $('.button.updateDataPelaku_P').api({
            action: 'updatePelaku_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.editDataPelaku_P")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d == true){
                    alertNoty('Save Success','info');
                    $('.modal.editDataPelaku_P').modal('hide');
                    $(".form.editDataPelaku_P")[0].reset();
                    listPelaku();
                }else if(d == 2){ //nik telah ada
                    alertNoty('Use another NIK','info');
                }else if(d == 3){ //email telah ada
                    alertNoty('Use another Email','info');
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // add crime
        $('.item.addCrime').on("click", function(e) {
            $('.modal.addCrime_P').modal('show');
            $('#nikCrime').val($(this).data('id'));
        });
        // submit add
        $('.button.addCrime_Pelaku').api({
            action: 'addCrimePelaku_Police',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.addCrime_Pelaku")[0]);
                return settings;
            },
            onSuccess: function(d) {                                 
                if(d == true){
                    alertNoty('Save Success','info');
                    $('.modal.addCrime_P').modal('hide');
                    $(".form.addCrime_Pelaku")[0].reset();
                    listPelaku();
                }
            },
            onFailure: function(r) {
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // list crime 
        $('.item.listCrime').api({
            action: 'pelakuListCrime_Police',
            urlData: {
                id: $(this).data('id')
            },
            method : 'GET',
            onSuccess: function(d) {
                // clear
                drawListCrime_Pelaku(d);
                $('.modal.listCrime_P').modal('show');
            },
            onFailure: function(r) {
                
            }
        });
        // draw list crime
        function drawListCrime_Pelaku(d) {
            var list = '';
            var no = 1;

            if(Object.keys(d).length < 1){
                list += 'kosong';
            }else {
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<tr>' +
                                    '<td>'+ no +'</td>' +
                                    '<td>'+ d[key].judul +'</td>' +
                                    '<td>'+ d[key].waktu +'</td>' +
                                    '<td>'+ d[key].ket +'</td>' +
                                    '<td>'+
                                        '<div class="ui icon buttons">'+
                                            '<button class="ui button detailCrime_Pelaku" style="user-select: auto;" data-id="'+d[key].id_kriminalitas+'"><i class="info icon"></i></button>'+
                                            '<button class="ui button delCrime_Pelaku" style="user-select: auto;" data-id="'+d[key].id_pelaku+'"><i class="remove icon"></i></button>'+
                                        '</div>'+
                                    '</td>' +
                                '</tr>';
                    }
                    no++;
                }
            }

            $("#tbListCrime_Pelaku").html('');
            $("#tbListCrime_Pelaku").html(list);
            initTabelListCrimePelaku();
        }
        function initTabelListCrimePelaku() {
            // delete crime
            $('.button.delCrime_Pelaku').api({
                action: 'delCrimePelaku_Police',
                method : 'GET',
                beforeSend: function(settings){
                    var d = $(this).data("id");
                    settings.urlData = {
                        id: d 
                      };
                    return settings;
                },
                onSuccess: function(d) {
                   alertNoty('Delete Success','info');
                   listPelaku();
                   $('.modal.listCrime_P').modal('hide');
                   $("#tbListCrime_Pelaku").html('');
                },
                onFailure: function(r) {
                   alertNoty('refresh page','warning'); 
                }
            });

            // detail crime
            $('.to_modalListCrime').on("click", function(e) {
                $('.modal.listCrime_P').modal('show');
            });
            $('.detailCrime_Pelaku').on("click", function(e) {
                
                var id = $(this).data('id');
                $('.detailCrimePelaku_P').api({
                    on: 'now',
                    action: 'detailKriminalitas_Police',
                    urlData: {
                      id: id
                    },
                    method : 'GET',
                    onSuccess: function(d) {
                        $('.detailKriminalitas_judul').html(d.judul);
                        $('.detailKriminalitas_waktu').html(d.waktu);
                        $('.detailKriminalitas_kota').html(d.nama_kota);
                        $('.detailKriminalitas_alamat').html(d.alamat);
                        $('.detailKriminalitas_TentangPelaku').html(d.t_pelaku);
                        $('.detailKriminalitas_TentangKorban').html(d.t_korban);
                        $('.detailKriminalitas_deskripsi').html(d.deskripsi_kejadian);
                        $('.detailKriminalitas_lat').html(d.lat);
                        $('.detailKriminalitas_long').html(d.long);
                        $('.detailKriminalitas_KatKriminalitas').html(d.nama_kategori_kriminalitas);
                        $('.detailKriminalitas_KantorPolisi').html(d.nama_kantor);

                        $('.modal.detailCrimePelaku_P').modal('show');
                    },
                    onFailure: function(r) {
                        
                    }
                });                


            });

        }
        
    }


    function dropdownKota(id) {
	    $('meta[name="_token"]').api({
	        action: 'getListKota',
	        method: 'GET',
	        on: 'now',
	        onSuccess: function(d) {
	            // draw
	            list = '<option value="">...</option>';
	            for(var key in d){
	                if(d.hasOwnProperty(key)){

	                    list += '<option value="'+d[key].id+'">'+d[key].nama+'</option>';
	                }
	            }
	            $("#ddKota").html('');
	            $("#ddKota").html(list);

	            $("#ddKotaEdit").html('');
	            $("#ddKotaEdit").html(list);

	            // deklarasi
                $('#ddKota').dropdown();
                $('#ddKotaEdit').dropdown();
	        }
	    });
    }
    
    function dropdownKatCrime(id) {
	    $('meta[name="_token"]').api({
	        action: 'getListKatCrime',
	        method: 'GET',
	        on: 'now',
	        onSuccess: function(d) {
	            // draw
	            list = '<option value="">...</option>';
	            for(var key in d){
	                if(d.hasOwnProperty(key)){

	                    list += '<option value="'+d[key].id+'">'+d[key].nama+'</option>';
	                }
	            }
	            $("#ddKatCrime").html('');
	            $("#ddKatCrime").html(list);

                $("#ddKatCrimeEdit").html('');
	            $("#ddKatCrimeEdit").html(list);

	            // deklarasi
	            $('#ddKatCrime')
				  .dropdown()
				;

	        }
	    });
	}

	function ddKantorPolisi(d) {
		$('meta[name="_token"]').api({
	        action: 'getListPoliceStation',
	        method: 'GET',
	        on: 'now',
	        onSuccess: function(d) {
	            // draw
	            list = '';
	            for(var key in d){
	                if(d.hasOwnProperty(key)){

	                    list += '<option value="'+d[key].id+'">'+d[key].nama_kantor+'</option>';
	                }
	            }
	            $("#ddKantorPolisi").html('');
	            $("#ddKantorPolisi").html(list);

	            // deklarasi
	            $('#ddKantorPolisi').dropdown();
	        }
	    });
    }
    
    function getListCategoryCrime(){
        $('meta[name="_token"]').api({
	        action: 'getListKatCrime',
	        method: 'GET',
	        on: 'now',
	        onSuccess: function(d) {
                drawCheckBoxListCategoryCrime(d);
            }
	    });
    }

    function drawCheckBoxListCategoryCrime(d) {
        // draw in menu kriminalitas
        var list = '';
        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){
                    list += '<div class="ui checkbox" style="display:block; margin-bottom:3px">'+
                                '<input type="checkbox" class="cbFilterCategoryCrime" data-id="'+ d[key].id +'">'+
                                '<label>'+d[key].nama+'</label>'+
                            '</div>';
                }
            }
        }

        $(".content.cbFilterCrimeByCategory").html('');
        $(".content.cbFilterCrimeByCategory").html(list);
    }

	function pangkat_polisi(d) {
        // rendah ke tinggi
        switch(d){
            case 0:
                return "Bhayangkara Dua";
                break;
            case 1:
                return "Bhayangkara Satu";
                break;
            case 2:
                return "Bhayangkara Kepala";
                break;
            case 3:
                return "Ajun Brigadir Polisi Dua";
                break;
            case 4:
                return "Ajun Brigadir Polisi Satu";
                break;
            case 5:
                return "Ajun Brigadir Polisi"; 
                break; 
            case 6:
                return "Brigadir Polisi Dua"; 
                break; 
            case 7:
                return "Brigadir Polisi Satu"; 
                break; 
            case 8:
                return "Brigadir Polisi"; 
                break; 
            case 9:
                return "Brigadir Polisi Kepala"; 
                break; 
            case 10:
                return "Ajun Inspektur Polisi Dua"; 
                break; 
            case 11:
                return "Ajun Inspektur Polisi Satu"; 
                break; 
            case 12:
                return "Inspektur Polisi Dua"; 
                break; 
            case 13:
                return "Inspektur Polisi Satu"; 
                break; 
            case 14:
                return "Ajun Komisaris Polisi"; 
                break; 
            case 15:
                return "Komisaris Polisi"; 
                break;  
            case 16:
                return "Ajun Komisaris Besar Polisi"; 
                break; 
            case 17:
                return "Komisaris Besar Polisi"; 
                break;
            case 18:
                return "Brigadir Jenderal Polisi"; 
                break; 
            case 19:
                return "Inspektur Jenderal Polisi"; 
                break; 
            case 20:
                return "Komisaris Jendral Polisi"; 
                break; 
            case 21:
                return "Jenderal Polisi"; 
                break;                                                                        
        }
    }

    function vKelamin(d) {
        if(d == '1'){
            return 'Pria';
        }else{
            return 'Wanita';
        }
    }

    function vKelamin_icon(p) {
        (p==1) ? p='<i class="male icon">' : p='<i class="female icon">';
        return p;
    }

    function vAgama(d) {
        switch(d){
            case 0:
                return "Islam";
                break;
            case 1:
                return "Kristen";
                break;
            case 2:
                return "Hindu";
                break;
            case 3:
                return "Buddha";
                break;
            case 4:
                return "Konghucu";
                break;
        }
    }
	
});

function alertNoty(m,ty){
    new Noty({
            theme   : 'relax',
            text    : m,
            type    : ty,
            timeout : 3000
          }).show()
}