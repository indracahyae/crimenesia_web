var urlWeb = $('meta[name="url"]').attr('content');

// JS LOGIN
$(document).ready(function(){
	//set
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	$.fn.api.settings.api = {
        'login'        : 'setLoginAdmin'
    };

    //cek login
    $( ".button.login" ).on( "click", function(e) {
        e.preventDefault();
    });
    $('.button.login').api({
        action: 'login',
        method : 'POST',
        serializeForm: true,
        onSuccess: function(d) {
            if(d){
                location.href = urlWeb + '/homeAdmin';
            }else{
                $('.message.login').removeClass("hidden");
            }
            
        },
        onFailure: function(response) {
            alert('refresh page');
        }
    });

    //message
    $('.message.login .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
        ;
      })
    ;

});