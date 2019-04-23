
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import $ from 'jquery';
window.$ = window.jQuery = $;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

require('jquery-mousewheel/jquery.mousewheel');

require('popper.js');
require('./bootstrap');

require('bootstrap/dist/js/bootstrap.min');

import {tns} from 'tiny-slider/src/tiny-slider';

require('malihu-custom-scrollbar-plugin');

require('jquery-mask-plugin');

import LazyLoad from "vanilla-lazyload";

import swal from 'sweetalert';

require('../js/search');

if($('input.holdered').length){
    $(function () {

        $('input.holdered').each(function () {
            var input = $(this),
                placeholder = input.val();

            input.on('focus', function () {
                if($(this).val() == placeholder){
                    input.val('');
                }

            }).on('blur', function () {
                if($(this).val() == ''){
                    input.val(placeholder);
                }
            });
        });



    });
}


// //Поиск в шапке
// if($('.search__module').length){
//     $('.search__module').each(function () {
//         var box = $(this),
//             input = box.find('input');
//
//         input.on('focus', function () {
//             box.addClass('focus');
//             $('body').addClass('position-relative');
//
//             $(document).on('click', function (el) {
//                 var el = el.target;
//
//                 if(!$(el).parents('.search__module').length){
//                     box.removeClass('focus');
//                     $('body').removeClass('position-relative');
//                 }
//                 console.log(el);
//
//             });
//
//         });
//     });
// }

//Скроллбары
if($('.custom_scrollbar').length){
    $('.custom_scrollbar').each(function () {
        $(this).mCustomScrollbar({
            scrollInertia: 300,
            mouseWheel:{
                enable: true
            }
        });
    });
}

//Слайдер на главной
if($('#greetin .slider').length){
    tns({
        container: '#greetin .slider',
        items: 1,
        //autoWidth: true,
        mouseDrag: true,
        slideBy: 'page',
        mode: 'gallery',
        animateIn: 'jello',
        animateOut: "rollOut",
        controls: false,
        nav: false,
        swipeAngle: false,
        autoHeight: true,
        autoplay: true,
        autoplayButtonOutput: false
    });
}

//Слайдер продуктов
if($('.shop_slider_inner').length){
    $('.shop_slider_inner').each(function () {
        var slider_id = $(this).attr('id');

        tns({
            container: '#'+slider_id,
            items: 1,
            slideBy:1,
            loop:false,
            //autoWidth: true,
            mouseDrag: true,
            controls: true,
            controlsText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            nav: false,
            swipeAngle: false,
            autoHeight: true,
            responsive: {
                576: {
                    items: 2,
                    slideBy:2,
                },
                768: {
                    items: 3,
                    slideBy:3,
                },
                992: {
                    items: 4,
                    slideBy:4,
                }
            }
        });
    });

}

//Маска
if($('.phone_input').length) {
    $('.phone_input').mask('+7 (000) 000-00-00');
}

//Добавление в козину + просмотр
if($('.shop_pos_item').length) {
    var modal_box = $('#shop_item_dish_modal');

    $('.shop_pos_item').each(function () {
        var box = $(this),
            id = box.data('product-id'),
            add_to_cart = box.find('.add_to_cart'),
            view_link = box.find('.view_link'),
            drag = 0;

        this.addEventListener("mousedown", function(){
            drag = 0;
        }, false);

        this.addEventListener("mousemove", function(){
            drag = 1;
        }, false);

        box.on('click', function (ev) {
            if(!$(ev.target).hasClass('add_to_cart') && (drag === 0)){
                load_dish_modal(id);
            }
        });

    });

}

function load_dish_modal(id, try_by = false) {
    modal_box
        .find('.modal-body')
        .html('<div class="text-center"><h5 class="text-orange mb-0 font-weight-bolder"><i class="fas fa-spinner fa-spin fa-1x mr-1"></i> Подождите..</h5></div>')
        .promise()
        .done(function () {
            modal_box.modal('show');
        });

    ajax_request({dish:id}, '/get_dish_for_modal', 'json', 'post', null, function ($json) {
        modal_box
            .find('.modal-body')
            .html($json.html).promise().done(init_variants_onchange, init_modal_add_to_cart); // продукт загружен в окно

    });

    function init_variants_onchange() {
        var variants_box = $('#dish_'+id+'_variants'),
            variants_price_holder = $('#dish_'+id+'_variants_price_holder'),
            variants_shortname_holder = $('#dish_'+id+'_variants_shortname_holder'),
            btn_add_to_cart = $('.modal_add_to_cart');

        if(variants_box.length){
            //Есть варианты для выбора
            variants_box.find('input').on('change', function () {
                price = variants_box.data('price');
                weight = variants_box.data('weight');
                shortname = [];
                var variants = {},
                    shortname= [];

                $(this).closest('.dish_variants_group').find('.required').remove();

                variants_box.find('input:checked').each(function () {
                    weight += $(this).data('weight');
                    price += $(this).data('price');
                    shortname.push($(this).data('shortname') ? $(this).data('shortname') : $(this).data('name'));
                    variants[$(this).closest('.dish_variants_group').data('name')] = $(this).data('name');
                });

                var price = eval(price),
                    weight = eval(weight);

                variants_price_holder.text(price);
                variants_shortname_holder.text((weight ? (weight+'г') : '') + (shortname.length ? '/'+shortname.join('/') : ''));

                if(variants){
                    btn_add_to_cart.attr('data-variants', JSON.stringify(variants));
                }

                btn_add_to_cart.attr('data-price', price);
                btn_add_to_cart.attr('data-weight', weight);

            });

        }
    }

    function init_modal_add_to_cart() {
        $('.modal_add_to_cart').on('click', function () {
            var btn = $(this),
                variants_box = $('#dish_'+id+'_variants'),
                status = true;

            if(variants_box.length){
                variants_box.children('.dish_variants_group').each(function () {
                    if(!$(this).find('input:checked').length){
                        if(!$(this).find('.required').length){
                            $(this).append('<div class="required text-danger mb-2">Необходимо выбрать!</div>');
                        }
                        status = false;
                    }else {

                        $(this).find('.required').remove();
                    }
                });
            }

            if(status){
                ajax_request({
                        'action': 'add',
                        'dish_id': btn.data('dish-id'),
                        'variants': btn.data('variants'),
                        'weight': btn.data('weight'),
                        'price': btn.data('price'),
                    }, '/dishes_cart', 'json', 'post',
                    function () {
                        btn.addClass('adding').addClass('disabled');
                        $('#card__module_modal .card_products').addClass('added');
                    },
                    function ($json) {
                        btn.removeClass('adding').removeClass('disabled');
                        $('#card__module_modal .card_products').removeClass('load');

                        if(typeof $json.worktime_invalid !== "undefined"){
                            return swal({
                                title: 'В данное время Ресторан не работает!',
                                icon: "warning",
                                button: {
                                    text: "Ок",
                                    className: "btn btn-primary",
                                },
                                content: 'Время работы '+$json.worktime_invalid.name + ' с '+$json.worktime_invalid.worktime_to + ' до ' + $json.worktime_invalid.worktime_do
                            });
                        }
                        return cart_update($json);
                    });
            }
        });
        if(try_by){
            $('.modal_add_to_cart').trigger('click');
        }
    }
}

//Корзина
$(document).on("click", '.add_to_cart', function(){
    var dish_id = $(this).data('dish-id'),
        btn = $(this);

    ajax_request({
            'action': 'add',
            'dish_id': dish_id,
        }, '/dishes_cart', 'json', 'post',
        function () {
            btn.addClass('adding').addClass('disabled');
            $('#card__module_modal .card_products').addClass('added');
        },
        function ($json) {
            btn.removeClass('adding').removeClass('disabled');
            $('#card__module_modal .card_products').removeClass('load');

            //нужно выбрать вариант
            if(typeof $json.variants_invalid !== "undefined"){
                return load_dish_modal(dish_id, true);
            }
            //

            if(typeof $json.worktime_invalid !== "undefined"){
                return swal({
                    title: 'В данное время Ресторан не работает!',
                    icon: "warning",
                    button: {
                        text: "Ок",
                        className: "btn btn-primary",
                    },
                    content: 'Время работы '+$json.worktime_invalid.name + ' с '+$json.worktime_invalid.worktime_to + ' до ' + $json.worktime_invalid.worktime_do
                });
            }

            return cart_update($json);
        });
});

$(document).on("click", '.remove_from_cart', function(){
    var dish_id = $(this).data('dish-id');

    ajax_request({
            'action': 'remove',
            'dish_id': dish_id,
        }, '/dishes_cart', 'json', 'post',
        function () {
            $('#card__module_modal .card_products').addClass('load');
        },
        function ($json) {
            $('#card__module_modal .card_products').removeClass('load');
            return cart_update($json);
        });
});

$(document).on("click", '.quintity_cart_m, .quintity_cart_p', function(){
    var btn = $(this),
        q = btn.hasClass('quintity_cart_p') ? +1 : -1,
        input = btn.hasClass('quintity_cart_m') ? btn.parent('.input-group-prepend').next('input') : btn.parent('.input-group-append').prev('input'),
        val = input.val(),
        dish_id = input.data('dish-id'),
        quantity = parseInt(input.val())+q;

    if(btn.parents('.items ').length){
        input.val(quantity);
    }else{

        if(btn.hasClass('quintity_cart_m') && (quantity < input.attr('min'))){
            return false;
        }
        input.val(quantity);
    }
    if(btn.parents('.items ').length){
        ajax_request({
                'action': 'quantity',
                'dish_id': dish_id,
                'remove': !quantity ? 1 : 0,
                'quantity': parseInt(q),
            }, '/dishes_cart', 'json', 'post',
            function () {
                $('#card__module_modal .card_products').addClass('load');
            },
            function ($json) {
                $('#card__module_modal .card_products').removeClass('load');
                return cart_update($json);
            });
    }

});

$(document).on("click", '.order_modal_show', function(){
    $('#shop_item_dish_modal').modal('hide');

    //setTimeout(function () {
    $('#card__module_modal').modal('show');
    //}, 500);
});

$('#card__module_modal').on('show.bs.modal', function (e) {
    $('body').removeClass('card__module_show').addClass('show_order');
});

$('#card__module_modal').on('hide.bs.modal', function (e) {
    $('body').removeClass('show_order');
    if(!$('body').hasClass('cleared')) $('body').addClass('card__module_show');
});

//Каталог - навигация
if($('.products_nav_desctop').length){
    $(function () {

        $('body').scrollspy({
            target: '.products_nav',
            offset: 50
        });

        var height = $('#howto').innerHeight();
        var windowHeight = $(window).height();

        if(height < windowHeight){
            $('body').css("padding-bottom", windowHeight-height + "px");
        }

        $(window).resize(function(event){
            var height = $('#howto').innerHeight();
            var windowHeight = $(window).height();

            if(height < windowHeight){
                $('body').css("padding-bottom", windowHeight-height + "px");
            }
        });

        $('.products_nav_desctop .nav-link').click(function(event){
            event.preventDefault();
            if (this.hash !== "") {

                var hash = this.hash;
                $('.products_group').removeClass("focus");
                $(hash).addClass("focus");

                setTimeout(function(){
                    $(hash).removeClass("focus");
                }, 2000);

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 300, function(){
                    //window.location.hash = hash;
                });

                //$(".navbar-collapse").collapse('hide');
            }

        });

        $(window).scroll(function(){
            $('.products_nav').each(function(){
                if(!$(this).find('a.active').length){
                    $(this).find('li').first().children('a').addClass('active');
                }
            });
        });


    });
}

//Каталог - развертывание
if($('.products_items_show_more').length){
    $(window).on('load resize', products_show_more);
}

function products_show_more() {
    $('.products_items_show_more').each(function () {

        var btn = $(this),
            container = btn.parents('.products_items'),
            hiddens = container.children('.row').children('div:hidden').length,
            holders = btn.data('switch').split('|');

        // if(!hiddens){
        //     btn.parent('div').addClass('d-none');
        // }else{
        //     btn.parent('div').removeClass('d-none');
        // }

        btn.text(holders[0]+' '+hiddens);

        var lastCall = 0;
        btn.on('click', function () {
            var now = Date.now();
            if(now - lastCall > 3e3) {
                if (container.hasClass('compact')) {
                    container.removeClass('compact');
                    btn.text(holders[1]);
                    alert('open');
                } else {
                    container.addClass('compact');
                    btn.text(holders[0] + ' ' + hiddens);
                    alert('close');
                }

                lastCall = now;
            }
        });

    });
}

//Каталог - моб меню
if($('.filter_mobile').length){
    $(function () {

        var navbar = $('.filter_mobile'),
            sticky = navbar.offset().top,
            open_btn = navbar.find('.open'),
            close_btn = navbar.find('.close');

        $(window).on('scroll', function () {
            filter_mobile_init();
        }).trigger('scroll');

        function filter_mobile_init() {
            if(navbar.css('display') == 'none') return false;
            if (window.pageYOffset >= sticky) {
                navbar.addClass("sticky");
                $('#products').css('paddingTop', navbar.innerHeight());
            } else {
                navbar.removeClass("sticky");
                $('#products').css('paddingTop', 0);
            }
        }

        open_btn.on('click', function () {
            //$('body').addClass("overflow-hidden");
            navbar.addClass('opened');
        });

        close_btn.on('click', function () {
            //$('body').removeClass("overflow-hidden");
            navbar.removeClass('opened');
        });

        navbar.find('.nav-link').click(function(event){

            if(!$('.products_nav_mobile').hasClass('links')){
                event.preventDefault();
            }

            if (this.hash !== "") {
                var hash = this.hash;
                navbar.removeClass('opened');


                var top = $(hash).offset().top;
                if($('.filter_mobile').hasClass('sticky')){
                    top -= 50;
                }

                $('html, body').scrollTop(top);
            }

        });

    });
}

//Корзина
if($('.card__module').length){

}

//Каталог - поиск
if($('#products_search').length && $('#products .products .shop_pos_item').length){

    $('#products_search').on('keyup', function () {
        var input = $(this),
            query = TrimStr(input.val()).toLowerCase(),
            scroll = null,
            find = false;

        $('#products .products .shop_pos_item').each(function () {
            var item = $(this),
                title = item.find('.title');

            title.html(title.text()); // чистим теги

            if(title.text().toLowerCase().indexOf(query) > 0){
                var result = title.html().replace(new RegExp(query, 'gi'), function(str) {
                    return '<span class="_searched">'+str +'</span>';
                });
                title.html(result);

                if(scroll == null) scroll = item;
                find = true;
            }
        });

        // if(!find){
        //     if(query){
        //         input.popover({
        //             content: 'В меню такого нет'
        //         });
        //         input.popover('show');
        //         input.popover('destroy');
        //     }
        // }else{
        //     input.popover('hide');
        //     input.popover('destroy');
        // }

        if(scroll){
            $('html, body').animate({
                scrollTop: scroll.offset().top - 10
            }, 300);
            scroll = null;
            //input.popover('hide');
        }

    });

    // $(function () {
    //     var lastResFind = ""; // последний удачный результат
    //     var copy_page = ""; // копия страницы в ихсодном виде
    //
    //     $('#products_search').on('change', function () {
    //         return FindOnPage($(this).val());
    //     });
    //
    //     function FindOnPage(value) {//ищет текст на странице, в параметр передается ID поля для ввода
    //         var textToFind;
    //
    //         textToFind = TrimStr(value);//обрезаем пробелы
    //
    //         document.getElementById('products').innerHTML.replace(eval("/" + textToFind + "/gi"), "<a class='fined_products' name=" + textToFind + " style='background:red'>" + textToFind + "</a>"); //Заменяем найденный текст ссылками с якорем;
    //
    //         if( $('.fined_products').length){
    //             $('html, body').animate({
    //                 scrollTop: $('.fined_products').offset().top - 10
    //             }, 300);
    //         }
    //
    //         //window.location = '#' + textToFind;//перемещаем скрол к последнему найденному совпадению
    //     }
    // });
}

var myLazyLoad = new LazyLoad({
    elements_selector: ".lazy",
    //load_delay: 300 //adjust according to use case
});

// Оформление заказа
if($('.order_form').length){

    $('.order_form .submit').on('click', function(submit_standart){
        submit_standart.preventDefault();
        var form      = $('.order_form'),
            form_data = {};

        form.find('[name]').each(function(){
            form_data[$(this).attr('name')] = $(this).val()
        });

        console.log(form_data);

        ajax_request(
            form_data,
            form.data('action'),
            'json',
            'post',
            function ($json) {
                $('.order_form').addClass('load');
                form.find('.is-invalid').removeClass('is-invalid').next('.invalid-feedback').remove();
            },
            function ($json) {
                console.log($json);
                $('.order_form').removeClass('load');
                if($json.errors){
                    for(var i in $json.errors){
                        form.find('[name="'+i+'"]').addClass('is-invalid').after('<div class="invalid-feedback">'+$json.errors[i][0]+'</span>');
                    }
                }else if($json.success){
                    cart_update();
                    ga('send', 'event', 'zakaz', 'click', 'confirm');
                    ym(53176072, 'reachGoal', 'order');
                    return mod_massage($json.success.title, $json.success.text);
                }
            },
            null
        );
    });
}

function mod_massage(title, text) {
    $('#mod_massage__module .title').text(title);
    $('#mod_massage__module .text').text(text);

    $('#mod_massage__module').modal('show');

    setTimeout(function () {
        $('#mod_massage__module').modal('hide');
    }, 4000);
}

function TrimStr(s) {
    s = s.replace(/^\s+/g, '');
    return s.replace(/\s+$/g, '');
}

global.ajax_request = function (data, action, datatype, type, on_submit, success, error) {

    //до ответа сервера
    if(typeof on_submit === 'function') on_submit(data);
    //...

    var datatype = datatype ? datatype : 'JSON',
        type = type ? type : 'post',
        fields = (fields !== undefined) ? fields : {};

    $.ajax({
        url: action,
        dataType: datatype,
        data: data,
        type: type,
        success:function(response){
            //сервер ответил
            if(typeof success === 'function') success(response, fields);
            //...
        },
        error:function(jqXHR, textStatus, errorThrown){
            //какая то ошибка
            if(typeof error === 'function'){
                error();
            }else{
                console.log('// Ошибка при отправке:');
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('//');
            }
            //...
        }
    });
}

function cart_update(data) {
    var html = '';

    if(data === undefined){
        var data = {};
        data.total = 0;
        data.sum = 0;
        data.content = {};
    }

    console.log(data);

    $('.card__module .quantity').text(data.total);
    $('.card__module .sum').text(data.sum);
    if(data.total > 0){
        if(!$('body').hasClass('show_order')) $('body').addClass('card__module_show');
    }else {
        $('body').addClass('cleared').removeClass('card__module_show');
    }

    var size = 0, key;
    for (key in data.content) {
        if (data.content.hasOwnProperty(key)) size++;
    }

    if(size){
        for(var i in data.content){
            html +=  '<tr class="item">' +
                        '<td>';
                            if(data.content[i].attributes.image){
                                html += '<div class="image">' +
                                            '<img src="'+data.content[i].attributes.image+'" alt="">' +
                                        '</div>';
                            }
                        html += '</td>' +
                        '<td class="">' +
                            '<div class="font-weight-bold">'+data.content[i].name+'</div>';
                                if(data.content[i].attributes.variants){
                                    var _i = 0;
                                    var variant_str = '';
                                    for (var variant in data.content[i].attributes.variants){
                                        variant_str += (_i ? ', ' : '')+variant + ': ' + data.content[i].attributes.variants[variant];
                                        _i++;
                                    }
                                    html += '<small class="text-secondary font-weight-normal">';
                                        html += variant_str;
                                    html += '</small>';
                                    html += '<input type="hidden" name="dishes_variants['+data.content[i].id+']" value="'+variant_str+'">';
                                }else if(data.content[i].attributes.short_description){
                                    html += '<small class="text-secondary font-weight-normal">'+data.content[i].attributes.short_description+'</small>';
                                    html += '<input type="hidden" name="dishes_variants['+data.content[i].id+']" value="'+data.content[i].attributes.short_description+'">';
                                }else if(data.content[i].attributes.weight){
                                    html += '<small class="text-secondary font-weight-normal">'+data.content[i].attributes.weight+'г</small>';
                                    html += '<input type="hidden" name="dishes_variants['+data.content[i].id+']" value="'+data.content[i].attributes.weight+'г">';
                                }


                        html += '</td>' +
                        '<td class="count">' +
                            '<div class="input-group count_input float-right">' +
                                '<div class="input-group-prepend">' +
                                    '<button class="btn btn-sm quintity_cart_m" type="button"><i class="fas fa-minus fa-sm"></i></button>' +
                                '</div>' +
                                '<input type="number" min="0"  name="dishes['+data.content[i].id+']" readonly value="'+data.content[i].quantity+'" data-dish-id="'+data.content[i].id+'" class="bg-white form-control form-control-sm">' +
                                '<div class="input-group-append">' +
                                    '<button class="btn btn-sm quintity_cart_p" type="button"><i class="fas fa-plus fa-sm"></i></button>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td class="text-nowrap text-center">' +
                            '<div class="h4 mb-0">' +
                            data.content[i].price + ' ₽' +
                            '</div>' +
                        '</td>' +
                        '<td class="remove">' +
                            '<a href="javascript:;" class="remove_from_cart" data-dish-id="'+data.content[i].id+'"><i class="fas fa-times"></i></a>' +
                        '</td>' +
                    '</tr>';
        }
        html +=  '<tr>' +
                    '<td colspan="3" class="text-right">' +
                        '<div class="h4 text-secondary font-weight-light mb-0">Сумма заказа</div>' +
                    '</td>' +
                    '<td class="text-nowrap text-center">' +
                        '<div class="h4 mb-0">' +
                            data.sum + ' ₽' +
                        '</div>' +
                    '</td>' +
                    '<td></td>' +
                '</tr>';
    }else{
        html +=  '<tr class="item"><td colspan="5">Нет блюд в корзине!</td></tr>';
        $('#card__module_modal').modal('hide');
    }

    $('#card__module_modal .card_products .items').html(html);
}




