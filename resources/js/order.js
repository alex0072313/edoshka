// Оформление заказа
if($('.order_form').length){

    $('.order_form .submit').on('click', function(submit_standart){
        submit_standart.preventDefault();
        var form      = $('.order_form'),
            form_data = {};

        form.find('[name]').each(function(){
            if($(this).attr('type') == 'radio'){
                if($(this).prop('checked') == true){
                    form_data[$(this).attr('name')] = $(this).val();
                }
            }else if($(this).attr('type') == 'checkbox'){
                if($(this).prop('checked') == true){
                    form_data[$(this).attr('name')] = $(this).val();
                }
            }
            else{
                form_data[$(this).attr('name')] = $(this).val();
            }

        });

        console.log(form_data);

        ajax_request(
            form_data,
            form.data('action'),
            'json',
            'post',
            function ($json) {
                $('.order_form').addClass('load');
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();
            },
            function ($json) {
                console.log($json);
                $('.order_form').removeClass('load');
                if($json.errors){
                    for(var i in $json.errors){
                        var input = form.find('[name="'+i+'"]');

                        input.addClass('is-invalid');

                        if(input.parent('.custom-checkbox').length){
                            input.parent('.custom-checkbox').after('<div class="invalid-feedback d-block">'+$json.errors[i][0]+'</span>');
                        }else{
                            input.after('<div class="invalid-feedback">'+$json.errors[i][0]+'</span>');
                        }

                    }
                }else if($json.success){
                    cart_update();

                    ga('send', 'event', 'zakaz', 'click', 'confirm');
                    ym(53176072, 'reachGoal', 'order');

                    if($json.redirect){
                        $('#mod_massage__module').on('hidden.bs.modal', function (e) {
                            window.location.href = $json.redirect;
                        })
                    }

                    return mod_massage($json.success.title, $json.success.text);
                }
            },
            null
        );
    });

    if($('.order_form .card_register').length){
        var card_register = $('.order_form .card_register'),
            check_text = '',
            check_text_box = card_register.find('.check_text'),
            check = card_register.find('[name="reg_type"]');

        check.on('change', change_reg_type).trigger('change');

        function change_reg_type(){
            check.each(function () {
                var check = $(this),
                    check_text = check.data('select-text'),
                    val = check.val();

                if(check.prop('checked') == true){
                    if(val == 'phone'){
                        if($('.order_form [name="phone"]').val()){
                            check_text = check_text.replace("%p",'<b>'+$('.order_form [name="phone"]').val()+'</b>');
                        }else{
                            check_text = '<span class="text-danger">Укажите телефон!</span>';
                            $('.order_form [name="phone"]').on('change', function () {
                                check.trigger('change');
                            });
                        }
                    }else if(val == 'email'){
                        if($('.order_form [name="email"]').val()){
                            check_text = check_text.replace("%e",'<b>'+$('.order_form [name="email"]').val()+'</b>');
                        }else{
                            check_text = '<span class="text-danger">Укажите Email!</span>';
                            $('.order_form [name="email"]').on('change', function () {
                                check.trigger('change');
                            });
                        }
                    }
                    check_text_box.html(check_text);
                }
            });
        }

    }
}
