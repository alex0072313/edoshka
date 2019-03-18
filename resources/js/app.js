
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

    $('.shop_pos_item').each(function () {
        var box = $(this),
            id = box.data('product-id'),
            add_to_cart = box.find('.add_to_cart'),
            view_link = box.find('.view_link'),
            modal_box = $('#shop_pos_item_modal_'+id),
            dishes_viewed = modal_box.find('.past'),
            dishes_viewed_list = dishes_viewed.children('.items'),
            drag = 0;

        this.addEventListener("mousedown", function(){
            drag = 0;
        }, false);

        this.addEventListener("mousemove", function(){
            drag = 1;
        }, false);

        box.on('click', function (ev) {
            if(!$(ev.target).hasClass('add_to_cart') && (drag === 0)){
                modal_box.modal('show');
                ajax_request({}, '/dishes_viewed_save/'+parseInt(id), 'json', 'post', null, function ($json) {
                    console.log($json);
                    if($json.dishes_viewed.length){
                        dishes_viewed.removeClass('d-none');

                        var html = '';

                        for (var i in $json.dishes_viewed) {
                            if($json.dishes_viewed[i].id){

                                var cls = ' mt-2';

                                if(i > 0){
                                    cls = ' border-top mt-2 pt-2';
                                }

                                html += '<div class="item d-flex align-items-center'+cls+'">' +
                                            '<div class="image">' +
                                                '<img src="'+$json.dishes_viewed[i].img +'" alt="">' +
                                            '</div>' +
                                            '<div class="flex-grow-1 ml-2 font-weight-bold">' +
                                                $json.dishes_viewed[i].name +
                                                '<span class="ml-2 text-secondary font-weight-normal">' +
                                                    $json.dishes_viewed[i].short_description +
                                                '</span>' +
                                            '</div>' +
                                            '<div class="h4 mb-0 mr-2 text-nowrap price">';
                                                if($json.dishes_viewed[i].new_price){
                                                    html += '<span class="new">'+$json.dishes_viewed[i].new_price + ' &#8381;</span>';
                                                }else{
                                                    html += $json.dishes_viewed[i].price + ' &#8381;';
                                                }
                                            html +='</div>';
                                        html +='<div>' +
                                                '<button class="btn btn-success btn-sm word text-nowrap add_to_cart" data-dish-id="'+$json.dishes_viewed[i].id+'">В корзину</button>' +
                                            '</div>' +
                                        '</div>';
                            }
                        }

                        dishes_viewed_list.html(html);
                    }else{
                        dishes_viewed.addClass('d-none');
                        dishes_viewed_list.html('');
                    }
                });
            }
        });

    });

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
            return cart_update($json);
            console.log($json);
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
    $('[id^="shop_pos_item_modal"]').modal('hide');

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
if($('.products_nav').length){
    $(function () {

        $('body').scrollspy({
            target: '.products_nav',
            offset: 10
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

        $('.products_nav .nav-link').click(function(event){
            event.preventDefault();
            if (this.hash !== "") {

                var hash = this.hash;
                console.log(hash);
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

//Каталог - моб меню
if($('.filter_mobile').length){
    $(function () {
        window.onscroll = function () {
            filter_mobile_init()
        };

        var navbar = $('.filter_mobile');
        var sticky = navbar.offset().top;

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

// Оформление заказа
if($('.order_form').length){

    $('.order_form .submit').on('click', function(submit_standart){
        submit_standart.preventDefault();
        var form      = $('.order_form'),
            form_data = {};

        form.find('[name]').each(function(){
            form_data[$(this).attr('name')] = $(this).val()
        });

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
                        '<td class="font-weight-bold">' +
                            data.content[i].name;
                        if(data.content[i].attributes.short_description){
                            html += '<span class="ml-2 text-secondary font-weight-normal">'+data.content[i].attributes.short_description+'</span>';
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




