$(function() {
    $(document).on('submit','.cp-form', function(e) {
        e.preventDefault();
        var $form = $(this);
        var btn_text = $('.btn:submit').html();
        $('.btn:submit').attr('disabled', 'disabled');
        $('.btn:submit').html('loading...');
        $form.ajaxSubmit(function(resp, x, xhr) {
            var status = xhr.getResponseHeader('X-Resp-Status');
            var redirect = xhr.getResponseHeader('X-Resp-Redirect');
            var just_msg = xhr.getResponseHeader('X-Resp-Msg');
            if (status == 'ERROR') {
                if(just_msg == 'TRUE'){
                    toastr.error(resp || 'Some Error Occured');
                }else{
                    var data_parsed = JSON.parse(resp);
                    $('small.has-error').remove();
                    $('.form-group').removeClass('has-error');
                    for (var u in data_parsed){
                        var u2 = u.replace(/\./g, '\\.');
                        $('#'+u2+'_div').parent().addClass('has-error');
                        $('#'+u2+'_div_inside').append('<small class="has-error">'+data_parsed[u][0]+'</small>');
                    }
                }
                $('.btn:submit').removeAttr('disabled');
                $('.btn:submit').html(btn_text);
            } else if (status == 'OK') {
                toastr.success(resp || 'Operation done successfully');
                if (redirect) {
                    setTimeout(function() {
                        window.location.replace(redirect)
                    }, 1500);
                }
            } else {
                console.log("Unknown Error!");
                $('.btn:submit').removeAttr('disabled');
            }
        });
    });
});
