//Логин


if($('#login_form').length){
    var login_form = $('#login_form'),
        login_form_btn_submit = login_form.find('.submit');

    login_form_btn_submit.on('click', function(submit_standart){
        submit_standart.preventDefault();
        var form_data = {};

        login_form.find('[name]').each(function(){

            if($(this).attr('type') == 'checkbox'){
                if($(this).prop('checked') === true) form_data[$(this).attr('name')] = 1;
            }else{
                form_data[$(this).attr('name')] = $(this).val()
            }

        });

        ajax_request(
            form_data,
            login_form.data('action'),
            'json',
            'post',
            function ($json) {
                login_form.addClass('load');
                login_form.find('.is-invalid').removeClass('is-invalid').next('.invalid-feedback').remove();
            },
            function ($json) {
                console.log($json);
                login_form.removeClass('load');
                if($json.errors){
                    login_form.children('.invalid_login').remove();
                    for(var i in $json.errors){
                        login_form.find('[name="'+i+'"]').addClass('is-invalid').after('<div class="invalid-feedback">'+$json.errors[i][0]+'</span>');
                    }
                }else if($json.invalid_login){
                    if(!login_form.children('.invalid_login').length){
                        login_form.prepend('<div class="invalid_login text-danger mb-3">Неверный Email и/или Пароль!</div>');
                    }
                }else if($json.success){
                    window.location.href = $json.success;
                }
            },
            null
        );


    });

}
