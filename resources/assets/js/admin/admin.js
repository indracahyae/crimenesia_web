//JS ADMIN
 $(document).ready(function () {
    //set
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'updateMyAccount'       : 'updateMyAccount',
        'showMyAccount'         : 'showMyAccount',
        'newAdmin'              : 'crudAdmins',
        'detailAdmin'           : 'crudAdmins/{username}',
        'updateAdmin'           : 'crudAdmins/{username}',
        'allAdmin'              : 'crudAdmins',
        'deleteAdmin'           : 'deleteAdmin/{username}',
        'mDeleteAdmin'          : 'mDeleteAdmin',
        'listSociety'           : 'listSociety',
        'detailSociety'         : 'detailSociety/{nik}',
        'deleteSociety'         : 'deleteSociety/{nik}',
        'mDelSociety'           : 'mDeleteSociety',
        'cariSociety'           : 'cariSociety',
        'selectCariSociety'     : 'selectCariSociety/{nik}',
        'listPolice'            : 'listPolice',
        'detailPolice'          : 'detailPolice/{nrp}',
        'deletePolice'          : 'deletePolice/{nrp}',
        'mDeletePolice'         : 'mDeletePolice',
        'cariPolice'            : 'cariPolice',
        'validasiPolice'        : 'validasiPolice',
        'listPoliceStation'     : 'listPoliceStation',
        'detailPoliceStation'   : 'detailPoliceStation/{id}',
        'deletePoliceStation'   : 'deletePoliceStation/{id}',
        'mDeletePoliceStation'  : 'mDeletePoliceStation',
        'createPoliceStation'   : 'createPoliceStation',
        'listKota'              : 'listKota',
        'updatePoliceStation'   : 'updatePoliceStation',
        'cariPoliceStation'     : 'cariPoliceStation',
    };

    //set ui
    $('.ui.dropdown').dropdown({
        on: 'hover'
    }); // dropdown initialization
    $('.ui.sidebar')
        .sidebar('setting', 'transition', 'overlay')
        .sidebar('attach events', '.item.sidebar-button')
    ;
    $('.ui.checkbox')
      .checkbox()
    ;

    //MY ACCOUNT
    $('.ui.modal.editAkunSaya')
	  .modal('attach events', '.btn.editMyAccount', 'show')
	  .modal('setting', 'closable', false)
	;
    $('.btn.editMyAccount').api({
        action: 'showMyAccount',
        method : 'GET',
        onSuccess: function(d) {
            $('#nama').val(d.nama);
            $('#username').val(d.username);
            $('#password').val(d.password);
        },
        onFailure: function(response) {
            alert('refresh page');
        }
    });
	$( ".button.updateMyAccount" ).on( "click", function(e) {
        e.preventDefault();
    });
    $('.button.updateMyAccount').api({
        action: 'updateMyAccount',
        method : 'POST',
        cache  : false,
        processData: false,
        contentType: false,
        beforeSend: function(settings){
            settings.data = new FormData($(".form.editMyAccount")[0]);
            return settings;
        },
        onSuccess: function(d) {
            if(d == 0){
                new Noty({
                    text: 'Can not update, use another Username',
                    type: 'warning',
                    timeout: 3000
                  }).show()
            }else if(d == 2){
                new Noty({
                    text: 'Can not update, upload file problem.',
                    type: 'warning',
                    timeout: 3000
                  }).show()
            }else{
                $('#fotoMyProfileAdmin').val('');
                $('.topUsername').html(d.username);
                $('#idMyAccount').val(d.username);
                $('.nama.myAccountAdmin').html(d.nama); 
                $('.username.myAccountAdmin').html(d.username); 
                $('.password.myAccountAdmin').html(d.password);
                $('.created.myAccountAdmin').html(d.created_at);
                $('.updated.myAccountAdmin').html(d.updated_at);
                $('.last_login.myAccountAdmin').html(d.last_login);
                setTimeout(
                    function(){
                        $('.foto.myAccountAdmin').attr('src',urlWeb+'/img/'+d.foto);
                    },
                    1000    
                );
                $('.modal.editAkunSaya').modal('hide');
            }
        },
        onFailure: function(response) {
            alert('refresh page');
        }
    });
    $( ".cancel.button.myProfileAdmin, .close.icon.myProfileAdmin, .button.updateMyAccount" )
        .on( "click", function(e) {
            $('#fotoMyProfileAdmin').val('');
    });

    //CRUD ADMIN
    var ceAdmin = 0;
    var actCeAdmin = 0;
    var idCeAdmin = 0;
    
    //all admin
    if( $('#tbAdministrator').length ) 
    {
        allAdmin();   
    }
    function allAdmin(){
      $('#tbAdministrator').api({
        action: 'allAdmin',
        on: 'now',
        onSuccess: function(d) {
            drawTableAdmin(d);
        }
      });  
    }
    // init table admin
    function initTableAdmin(){
        $('.ui.modal.ceAdmin')
          .modal('attach events', '.btn.addAdmin , .mAdmin.editAdmin', 'show')
          .modal('setting', 'closable', false)
        ;
        $( ".close.icon.ceAdmin , .cancel.button.manageAdmin" ).on( "click", function(e) {
            $('.form.ceAdmin').form('clear');
        });
        $('.ui.checkboxAdmin').checkbox();
        $('.ui.dropdown.ddAdmin').dropdown({
            on: 'hover'
        });
        $('.ui.modal.detailAdmin')
          .modal('attach events', '.item.detailAdmin', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.ui.modal.deleteAdmin')
          .modal('attach events', '.item.deleteAdmin', 'show')
          .modal('setting', 'closable', false)
        ;

        $('.item.mAdmin.editAdmin').api({ //isi form sebelum update
            action: 'detailAdmin',
            urlData: {
              username: $(this).data('username')
            },
            method : 'GET',
            onSuccess: function(d) {
                $('#idAdministrator').val(d.username);
                $('#oldFotoCeAdmin').val(d.foto);
                $('#nama').val(d.nama);
                $('#username').val(d.username);
                $('#password').val(d.password);
                $('.dropdown.akses').dropdown('set selected',d.akses.toString());
            },
            onFailure: function(r) {
                
            }
        });
        //detail admin
        $('.item.mAdmin.detailAdmin').api({
            action: 'detailAdmin',
            urlData: {
              username: $(this).data('username')
            },
            method : 'GET',
            onSuccess: function(d) {
                $('.photoAdmin').attr('src',urlWeb+'/img/'+d.foto);
                $('.dAdminName').html(d.nama);
                $('.dAdminUsername').html(d.username);
                $('.dAdminPassword').html(d.password);
                $('.dAdminAccess').html(jabatanAdmin(d.akses));
                $('.dAdminCreated').html(changeDate(d.created_at));
                $('.dAdminUpdated').html(changeDate(d.updated_at));
                $('.dAdminLastLogin').html(changeDate(d.last_login));
            },
            onFailure: function(r) {
                
            }
        });
        $( ".close.detailAdmin" ).on( "click", function(e) {
            $('.photoAdmin').attr('src',''); //clear foto
        });
         //create / update
        $( ".button.saveAdmin" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".btn.addAdmin , .mAdmin.editAdmin" ).on( "click", function(e) {
            ceAdmin = $(this).data('aksiceadmin');
            idCeAdmin = $(this).data('username');
            if(ceAdmin == 0){
                actCeAdmin = 'newAdmin';
            }else{
                actCeAdmin = 'updateAdmin';
            }
            $('.button.saveAdmin').api({
                action : actCeAdmin,
                method : 'POST',
                cache  : false,
                processData: false,
                contentType: false,
                beforeSend: function(settings){
                    settings.data = new FormData($(".form.ceAdmin")[0]);
                    if(ceAdmin == 1){ //jika update
                        settings.urlData = {
                            username: idCeAdmin
                        };
                        // PUT request
                        settings.headers = {"X-HTTP-Method-Override": "PUT"};
                    }
                    return settings;
                },
                onSuccess: function(d) {
                    // if 1 sesuai validasi, 0 tidak sesuai (jalankan validasi form semantic)
                    if(d){
                        new Noty({
                            text: 'success to save',
                            type: 'info',
                            timeout: 2500
                          }).show()
                        $('.modal.ceAdmin').modal('hide');
                        $('.form.ceAdmin').form('clear');
                        allAdmin();
                    }else if(d == 0){
                        new Noty({
                            text: 'try another username',
                            type: 'info',
                            timeout: 2500
                          }).show()
                    }
                },
                onFailure: function(r) {
                    $('.ui.form.ceAdmin').form('validate form');
                    
                    nf='<ul>';
                    $.each( r, function( key, value ) {
                        nf += '<li>' + value + '</li>'; 
                    });    
                    nf+='</ul>';
                    new Noty({
                        text: nf,
                        type: 'warning',
                        timeout: 4000
                      }).show()
                }
            }); 
        });
        // validate form ceAdmin
        $('.ui.form.ceAdmin')
          .form({
            fields: {
              username: {
                identifier: 'username',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter your username'
                  }
                ]
              },
              password: {
                identifier: 'password',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'please enter your password'
                  }
                ]
              },
              nama: {
                identifier: 'nama',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'please enter your full name'
                  }
                ]
              },
              akses: {
                identifier: 'akses',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'please select the access'
                  }
                ]
              },
              foto: {
                identifier: 'foto',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'please select a photo'
                  }
                ]
              }
            }
          })
        ;
        // delete Admin
        $( ".item.mAdmin.deleteAdmin" ).on( "click", function(e) {
            idCeAdmin = $(this).data('username');
            $('.button.deleteAdmin').api({
                action: 'deleteAdmin',
                urlData: {
                  username: idCeAdmin
                },
                method : 'GET',
                onSuccess: function(d) {
                   $('.modal.deleteAdmin').modal('hide');
                   allAdmin();
                },
                onFailure: function(d) {
                    alert('refresh page')
                }
            });
        });

        // checkbox master
        $('.master.checkbox.checkboxAdmin')
          .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbAdminSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbAdminSub").prop('checked', false); 
            }
          });
        $('.btn.mDeleteAdmin').api({
            action: 'mDeleteAdmin',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbAdminSub:checked").each(function() {  
                    ids.push($(this).attr('data-username'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
               allAdmin();
            },
            onFailure: function(d) {
                alert('refresh page')
            }
        });
    }
    //draw table
    function drawTableAdmin(d){
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxAdmin">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbAdminSub" data-username="'+d[key].username+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].username+'</td>'+
                                '<td>'+d[key].password+'</td>'+
                                '<td>'+jabatanAdmin(d[key].akses)+'</td>'+
                                '<td>'+changeDate(d[key].updated_at)+'</td>'+
                                '<td>'+cekDate(d[key].last_login)+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddAdmin">'+
                                      '<i class="wrench icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item mAdmin detailAdmin" data-username="'+d[key].username+'"><i class="user icon"></i></div>'+
                                        '<div class="item mAdmin editAdmin" data-username="'+d[key].username+'" data-aksiceadmin="1"><i class="edit icon"></i></div>'+
                                        '<div class="item mAdmin deleteAdmin" data-username="'+d[key].username+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbAdministrator").html('');
        $("#tbAdministrator").html(list);
        initTableAdmin();
    }

    // RD SOCIETY
    if( $('#tbSociety').length ) 
    {
        listSociety();
        // reload data
        $( ".btn.reloadData" ).on( "click", function(e) {
            listSociety();
        });
    }
    function listSociety(d) {
        $('#tbSociety').api({
        action: 'listSociety',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTableSociety(d);
        }
      });
    }
    function drawTableSociety(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxSociety">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbSocietySub" data-nik="'+d[key].nik+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nik+'</td>'+
                                '<td>'+d[key].username+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+d[key].pekerjaan+'</td>'+
                                '<td>'+d[key].tlp+'</td>'+
                                '<td>'+cekDate(d[key].last_login)+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddSociety">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailSociety" data-nik="'+d[key].nik+'"><i class="user icon"></i></div>'+
                                        '<div class="item deleteSociety" data-nik="'+d[key].nik+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbSociety").html('');
        $("#tbSociety").html(list);
        initTableSociety();
    }
    function initTableSociety() {
        $('.ui.checkboxSociety').checkbox();
        $('.ui.dropdown.ddSociety').dropdown({
            on: 'hover'
        });

        // detail
        $('.item.detailSociety').api({ 
            action: 'detailSociety',
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
               $('.dSocietyNik').html(d.nik);
               $('.dSocietyUsername').html(d.username);
               $('.dSocietyPassword').html(d.password);
               $('.dSocietyNama').html(d.nama);
               $('.dSocietyKelamin').html(vKelamin(d.jenis_kelamin));
               $('.dSocietyTempatLahir').html(d.tempat_lahir);
               $('.dSocietyTanggalLahir').html(cekDate(d.tanggal_lahir+' .'));
               $('.dSocietyKota').html(d.nama_kota);
               $('.dSocietyAlamat').html(d.alamat);
               $('.dSocietyAgama').html(vAgama(d.agama));
               $('.dSocietyPekerjaan').html(d.pekerjaan);
               $('.dSocietyTlp').html(d.tlp);
               $('.dSocietyEmail').html(d.email);
               $('.dSocietyLastLogin').html(cekDate(d.last_login+' .'));
               $('.dSocietyCreated').html(cekDate(d.created_at+' .'));
               $('.dSocietyUpdated').html(cekDate(d.updated_at+' .'));
               $('.dPhotoSociety').attr('src',urlWeb+'/img/society/'+d.foto);

               $('.modal.detailSociety').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete
        $('.modal.deleteSociety')
          .modal('attach events', '.item.deleteSociety', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deleteSociety').on("click", function(e) {
            $('.button.deleteSociety').data('id',$(this).data('nik'));
        });
        $('.button.deleteSociety').api({
            action: 'deleteSociety',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    nik: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deleteSociety').modal('hide');
               alertNoty('Delete Success','info');
               listSociety();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        $('.master.checkbox.checkboxSociety')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbSocietySub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbSocietySub").prop('checked', false); 
            }
          });
        $('.btn.mDelete').api({
            action: 'mDelSociety',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbSocietySub:checked").each(function() {  
                    ids.push($(this).attr('data-nik'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listSociety();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

         // cari Society
        $('.ui.search.society')
            .search({
                apiSettings: {
                    action: 'cariSociety',
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
                    description : 'username'
                },
                minCharacters : 3,
                onSelect: function(d) {
                    drawTableSociety([d]);
                },
            })
        ;

    }

    // POLICE RD VAL
    if( $('#tbPolice').length ) 
    {
        listPolice();
        // reload data
        $( ".btn.reloadData" ).on( "click", function(e) {
            listPolice();
        });
    }
    function listPolice(d) {
        $('#tbPolice').api({
        action: 'listPolice',
        method: 'GET',
        on: 'now',
        onSuccess: function(d) {
            drawTablePolice(d);
        }
      });
    }
    function drawTablePolice(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxPolice">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbPoliceSub" data-nrp="'+d[key].nrp+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nrp+'</td>'+
                                '<td>'+d[key].nama+'</td>'+
                                '<td>'+pangkat_polisi(d[key].pangkat_polisi)+'</td>'+
                                '<td>'+d[key].jabatan_polisi+'</td>'+
                                '<td>'+d[key].nama_kantor+'</td>'+
                                '<td>'+
                                    '<button class="ui icon button '+vButtonValidasiPolice(d[key].valid)+'" data-nrp="'+d[key].nrp+'">'+
                                      '<i class="checkmark icon '+vValidasiPolice(d[key].valid)+' "></i>'+
                                    '</button>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddPolice">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailPolice" data-nrp="'+d[key].nrp+'"><i class="user icon"></i></div>'+
                                        '<div class="item detailDokumen" data-doc="'+d[key].dokumen+'"><i class="file text icon"></i></div>'+
                                        '<div class="item deletePolice" data-nrp="'+d[key].nrp+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbPolice").html('');
        $("#tbPolice").html(list);
        initTablePolice();
    }
    function initTablePolice(){
        $('.ui.checkboxPolice').checkbox();
        $('.ui.dropdown.ddPolice').dropdown({
            on: 'hover'
        });

        // detail
        $('.item.detailPolice').api({ 
            action: 'detailPolice',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("nrp");
                settings.urlData = {
                    nrp: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi modal
               $('.dNrp').html(d.nrp);
               $('.dPangkatPolisi').html(pangkat_polisi(d.pangkat_polisi));
               $('.dJabatanPolisi').html(d.jabatan_polisi);
               $('.dNama').html(d.nama);
               $('.dNik').html(d.nik);
               $('.dTlp').html(d.tlp_polisi);
               $('.dEmail').html(d.email_polisi);
               $('.dNamaKantor').html(d.nama_kantor);
               $('.dLastLogin').html(d.lastLogin_polisi);
               $('.dPhotoPolice').attr('src',urlWeb+'/img/society/'+d.foto);

               $('.modal.detailPolice').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete
        $('.modal.deletePolice')
          .modal('attach events', '.item.deletePolice', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deletePolice').on("click", function(e) {
            $('.button.deletePolice').data('id',$(this).data('nrp'));
        });
        $('.button.deletePolice').api({
            action: 'deletePolice',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    nrp: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deletePolice').modal('hide');
               alertNoty('Delete Success','info');
               listPolice();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        $('.master.checkbox.checkboxPolice')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbPoliceSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbPoliceSub").prop('checked', false); 
            }
          });
        $('.btn.mDelete').api({
            action: 'mDeletePolice',
            method : 'POST',
            beforeSend: function(set){
                var ids = []; 
                $(".hidden.cbPoliceSub:checked").each(function() {  
                    ids.push($(this).attr('data-nrp'));
                }); 
                ids = ids.join(",");
                set.data = {
                    ids : ids
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Delete Success','info');
                listPolice();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

        // search
        $('.ui.search.police')
            .search({
                apiSettings: {
                    action: 'cariPolice',
                    method : 'POST',
                    beforeSend: function(settings) {
                        settings.data.key = $('.inpSearch').val();
                        return settings;
                    }
                },
                cache: false,
                fields: {
                    results     : 'data',
                    title       : 'nrp',
                    description : 'nama'
                },
                minCharacters : 3,
                onSelect: function(d) {
                    drawTablePolice([d]);
                },
            })
        ;

        // validasi
        $('.button.validasiPolice').api({
            action: 'validasiPolice',
            method : 'POST',
            beforeSend: function(set){
                set.data = {
                    nrp : $(this).data("nrp"),
                };
                return set;
            },
            onSuccess: function(d) {
                alertNoty('Validation Success','info');
                listPolice();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

        // dokumen       
        $('.item.detailDokumen').on("click", function(e) {
            window.open(urlWeb+'/doc/police/'+$(this).data("doc"),'_blank');
        });
    }

    // POLICE STATION list rd search
     if( $('#tbPoliceStation').length ) 
    {
        listPoliceStation();
        // reload data
        $( ".btn.reloadData" ).on( "click", function(e) {
            listPoliceStation();
        });
    }
    function listPoliceStation(d) {
        $('#tbPoliceStation').api({
            action: 'listPoliceStation',
            method: 'GET',
            on: 'now',
            onSuccess: function(d) {
                drawTablePoliceStation(d);
            }
          });
    }
    function drawTablePoliceStation(d) {
        var list = '';
        var no = 1;

        if(Object.keys(d).length < 1){
            list += 'kosong';
        }else {
            for(var key in d){
                if(d.hasOwnProperty(key)){

                    list += '<tr>'+
                                '<td>'+
                                    '<div class="ui child checkbox checkboxPoliceStation">'+
                                      '<input type="checkbox" tabindex="0" class="hidden cbPoliceStationSub" data-id="'+d[key].id_kantor_polisi+'">'+
                                    '</div>'+ 
                                '</td>'+
                                '<td>'+no+'</td>'+
                                '<td>'+d[key].nama_kantor+'</td>'+
                                '<td>'+d[key].nama_kota+'</td>'+
                                '<td>'+d[key].tlp+'</td>'+
                                '<td>'+d[key].email+'</td>'+
                                '<td>'+
                                    '<div class="ui bottom pointing dropdown icon teal button ddPoliceStation">'+
                                      '<i class="rocket icon"></i>'+
                                      '<div class="menu">'+
                                        '<div class="item detailPoliceStation" data-id="'+d[key].id_kantor_polisi+'"><i class="user icon"></i></div>'+
                                        '<div class="item editPoliceStation" data-id="'+d[key].id_kantor_polisi+'"><i class="edit icon"></i></div>'+
                                        '<div class="item deletePoliceStation" data-id="'+d[key].id_kantor_polisi+'"><i class="remove user icon"></i></div>'+
                                      '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                no++;
            }
        }

        $("#tbPoliceStation").html('');
        $("#tbPoliceStation").html(list);
        initTablePoliceStation();
    }
    function initTablePoliceStation() {
        $('.ui.checkboxPoliceStation').checkbox();
        $('.ui.dropdown.ddPoliceStation').dropdown({
            on: 'hover'
        });

        // detail
        $('.item.detailPoliceStation').api({ 
            action: 'detailPoliceStation',
            method : 'GET',
            beforeSend: function(settings){
                d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               // isi modal
               $('.dNama').html(d.nama_kantor);
               $('.dEmail').html(d.email);
               $('.dAlamat').html(d.alamat +', '+d.nama_kota);
               $('.dKodePos').html(d.kode_pos);
               $('.dTlp').html(d.tlp);
               $('.dKeterangan').html(d.ket);
               $('.dLatitude').html(d.lat);
               $('.dLongitude').html(d.long);
               $('.dCreated').html(cekDate(d.created_at));
               $('.dUpdated').html(cekDate(d.updated_at));

               $('.modal.detailPoliceStation').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // delete
        $('.modal.deletePoliceStation')
          .modal('attach events', '.item.deletePoliceStation', 'show')
          .modal('setting', 'closable', false)
        ;
        $('.item.deletePoliceStation').on("click", function(e) {
            $('.button.deletePoliceStation').data('id',$(this).data('id'));
        });
        $('.button.deletePoliceStation').api({
            action: 'deletePoliceStation',
            method : 'GET',
            beforeSend: function(settings){
                var d = $(this).data("id");
                settings.urlData = {
                    id: d 
                  };
                return settings;
            },
            onSuccess: function(d) {
               $('.modal.deletePoliceStation').modal('hide');
               alertNoty('Delete Success','info');
               listPoliceStation();
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });

        // multiple delete
        $('.master.checkbox.checkboxPoliceStation')
            .checkbox({
            // check all children
            onChecked: function() {
              $(".hidden.cbPoliceStationSub").prop('checked', true);  
            },
            // uncheck all children
            onUnchecked: function() {
              $(".hidden.cbPoliceStationSub").prop('checked', false); 
            }
          });
        $('.btn.mDelete').api({
            action: 'mDeletePoliceStation',
            method : 'POST',
            beforeSend: function(set){
                alertNoty('Delete process','warning');
                var ids = []; 
                $(".hidden.cbPoliceStationSub:checked").each(function() {  
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
                listPoliceStation();
            },
            onFailure: function(d) {
                alertNoty('refresh page','warning'); 
            }
        });

        // create
        $('.modal.cPoliceStation')
          .modal('attach events', '.btn.addPoliceStation', 'show')
          .modal('setting', 'closable', false)
        ;
        // isi dropdown kota disini, jika create di klik
        $( ".btn.addPoliceStation , .item.editPoliceStation" ).on( "click", function(e) {
            dropdownKota();
        });
        $( ".button.savePoliceStation" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.cPoliceStation" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.button.savePoliceStation').api({
            action: 'createPoliceStation',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.cPoliceStation")[0]);
                return settings;
            },
            onSuccess: function(d) {
                alertNoty('Create Success','info');
                $('.modal.cPoliceStation').modal('hide');
                $('.form.cPoliceStation').form('clear');
                listPoliceStation();
            },
            onFailure: function(r) {
                // $('.form.eUser').form('validate form');                
                nf='<ul>';
                $.each( r, function( key, value ) {
                    nf += '<li>' + value + '</li>'; 
                });    
                nf+='</ul>';
                alertNoty(nf,'warning');
            }
        });

        // edit
        $( ".button.updatePoliceStation" ).on( "click", function(e) {
            e.preventDefault();
        });
        $( ".form.ePoliceStation" ).on( "submit", function(e) {
            e.preventDefault();
        });
        $('.item.editPoliceStation').api({ 
            action: 'detailPoliceStation',
            method : 'GET',
            urlData: {
              id: $(this).data("id")
            },
            onSuccess: function(d) {
               // isi form
               $('#keyPoliceStation').val(d.id_kantor_polisi);
               $('#e_nama_kantor').val(d.nama_kantor);
               $('#e_email').val(d.email);
               $('#e_alamat').val(d.alamat);
               $('.dropdown.kota').dropdown('set selected',d.id_kota.toString());
               $('#e_kode_pos').val(d.kode_pos);
               $('#e_tlp').val(d.tlp);
               $('#e_ket').val(d.ket);
               $('#e_lat').val(d.lat);
               $('#e_long').val(d.long);

               $('.modal.ePoliceStation').modal('show');
            },
            onFailure: function(r) {
               alertNoty('refresh page','warning'); 
            }
        });
        // update
        $('.button.updatePoliceStation').api({
            action: 'updatePoliceStation',
            method : 'POST',
            cache  : false,
            processData: false,
            contentType: false,
            beforeSend: function(settings){
                settings.data = new FormData($(".form.ePoliceStation")[0]);
                return settings;
            },
            onSuccess: function(d) {
                alertNoty('Create Success','info');
                $('.modal.ePoliceStation').modal('hide');
                $('.form.ePoliceStation').form('clear');
                listPoliceStation();
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

        // search
        $('.ui.search.policeStation')
            .search({
                apiSettings: {
                    action: 'cariPoliceStation',
                    method : 'POST',
                    beforeSend: function(settings) {
                        settings.data.key = $('.inpSearch').val();
                        return settings;
                    }
                },
                cache: false,
                fields: {
                    results     : 'data',
                    title       : 'nama_kantor',
                    description : 'nama_kota'
                },
                minCharacters : 3,
                onSelect: function(d) {
                    drawTablePoliceStation([d]);
                },
            })
        ;

    }

    function dropdownKota(d) {
        $('.admin').api({
            action: 'listKota',
            method: 'GET',
            on: 'now',
            onSuccess: function(d) {
                // draw
                list = '<option value="">...</option>';
                for(var key in d){
                    if(d.hasOwnProperty(key)){

                        list += '<option value="'+d[key].id+'">'+d[key].nama+'</option>';
                    }
                    // no++;
                }
                $("#ddKota").html('');
                $("#ddKota").html(list);

                $("#ddKotaEdit").html('');
                $("#ddKotaEdit").html(list);
            }
          });
    }

    function vButtonValidasiPolice(d) {
        switch(d){
            case 0:
                return " validasiPolice";
                break;
            case 1:
                return "";
                break;    
        }
    }

    function vValidasiPolice(d) {
        switch(d){
            case 0:
                return "";
                break;
            case 1:
                return " green";
                break;    
        }
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


    function alertNoty(m,ty){
        new Noty({
                theme   : 'relax',
                text    : m,
                type    : ty,
                timeout : 3000
              }).show()
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
        }
    }

    function vKelamin(d) {
        if(d == '1'){
            return 'Pria';
        }else{
            return 'Wanita';
        }
    }

    function changeDate(d){
        var dt      = d.split(" ");
        var date    = dt[0].split('-');
        date        = date[2]+'-'+date[1]+'-'+date[0]+' '+dt[1];
        return date;
    }

    function jabatanAdmin(d){
        if (d == 1) {
            d = 'Main Admin';
        }else{
            d = 'Member Admin';
        }
        return d;
    }

    function cekDate(d){
        if(d == null || d == null+' .'){
            d = '-';
        }else{
            d = changeDate(d)
        }
        return d;
    }
    
});