//JS ADMIN

 $(document).ready(function () {
    //set
    var urlWeb = "http://"+window.location.hostname+":8000";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'updateMyAccount'       : 'updateMyAccount',
        'showMyAccount'         : 'showMyAccount',
    };

    //set ui
    $('.ui.dropdown').dropdown({
        on: 'hover'
    }); // dropdown initialization
    $('.ui.sidebar')
        .sidebar('setting', 'transition', 'overlay')
        .sidebar('attach events', '.item.sidebar-button')
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

});