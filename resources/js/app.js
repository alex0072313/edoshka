import $ from 'jquery';
window.$ = window.jQuery = $;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

global.queryString = require('query-string');

require('jquery-mousewheel/jquery.mousewheel');

require('popper.js');
require('./bootstrap');
require('./helpers');

require('bootstrap/dist/js/bootstrap.min');

import {tns} from 'tiny-slider/src/tiny-slider';

require('malihu-custom-scrollbar-plugin');

require('jquery-mask-plugin');

import LazyLoad from "vanilla-lazyload";

const gallery = require('gallery');

// Init galleries found inside document
gallery(document);

// Init galleries found inside specific node
if($('.gallery').length){
    gallery(document.querySelector('.gallery'));
}

import swal from 'sweetalert';
require('../js/login');
require('../js/order');
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

//Слайдер акций
if($('.specials_slider').length){

    if($('.specials_slider').children('.inner').length > 1) {
        var slider = tns({
            container: '#specials_slider',
            items: 1,
            slideBy: 1,
            loop: false,
            //autoWidth: true,
            mouseDrag: true,
            controls: true,
            controlsText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            nav: false,
            swipeAngle: false,
            autoHeight: true,
            responsive: {
                576: {
                    items: 1,
                    slideBy: 2,
                },
                768: {
                    items: 2,
                    slideBy: 3,
                },
                992: {
                    items: 2,
                    slideBy: 4,
                }
            }
        });
    }


    $(window).on('resize load', function () {
        $('.specials_slider .card-img-overlay > div').each(function () {
            var height = $(this).innerHeight();

            $(this).parent('div').parent('div').css('height', height);
        });
        if($('.specials_slider').children('.inner').length > 1) slider.updateSliderHeight();
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
            if(!box.hasClass('open_in_rest')){
                if(!$(ev.target).hasClass('add_to_cart')){
                    load_dish_modal(id);
                }
            }else {
                if(!$(ev.target).hasClass('open_in_rest')){
                    box.addClass('load');
                    window.location.href = box.data('url');
                }
            }
        });
    });

}

global.load_dish_modal = function(id, try_by = false) {

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
                var price = eval(variants_box.data('price')) ? eval(variants_box.data('price')) : 0;
                var weight = eval(variants_box.data('weight')) ? eval(variants_box.data('weight')) : 0;

                shortname = [];
                var variants = {},
                    shortname= [];

                $(this).closest('.dish_variants_group').find('.required').remove();

                variants_box.find('input:checked').each(function () {
                    weight = weight + (eval($(this).data('weight')) ? eval($(this).data('weight')) : 0);
                    price = price + (eval($(this).data('price')) ? eval($(this).data('price')) : 0);

                    shortname.push($(this).data('shortname') ? $(this).data('shortname') : $(this).data('name'));
                    variants[$(this).closest('.dish_variants_group').data('name')] = $(this).data('name');
                });

                var t_weight = weight;
                var t_price = price;

                variants_price_holder.text(t_price);
                variants_shortname_holder.text((t_weight ? (t_weight+'г/') : '') + (shortname.length ? shortname.join('/') : ''));

                if(variants){
                    btn_add_to_cart.attr('data-variants', JSON.stringify(variants));
                }

                btn_add_to_cart.attr('data-price', t_price);
                btn_add_to_cart.attr('data-weight', t_weight);

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

                return add_to_cart(btn.data('dish-id'), btn.data('variants'), btn.data('weight'), btn.data('price'));

                // ajax_request({
                //         'action': 'add',
                //         'dish_id': btn.data('dish-id'),
                //         'variants': btn.data('variants'),
                //         'weight': btn.data('weight'),
                //         'price': btn.data('price'),
                //     }, '/dishes_cart', 'json', 'post',
                //     function () {
                //         btn.addClass('adding').addClass('disabled');
                //         $('#card__module_modal .card_products').addClass('added');
                //     },
                //     function ($json) {
                //         btn.removeClass('adding').removeClass('disabled');
                //         $('#card__module_modal .card_products').removeClass('load');
                //
                //         if(typeof $json.worktime_invalid !== "undefined"){
                //             return swal({
                //                 title: 'В данное время Ресторан не работает!',
                //                 icon: "warning",
                //                 button: {
                //                     text: "Ок",
                //                     className: "btn btn-primary",
                //                 },
                //                 content: 'Время работы '+$json.worktime_invalid.name + ' с '+$json.worktime_invalid.worktime_to + ' до ' + $json.worktime_invalid.worktime_do
                //             });
                //         }
                //         return cart_update($json);
                //     });
            }
        });
        if(try_by){
            $('.modal_add_to_cart').trigger('click');
        }
    }
}


global.add_to_cart = function(dish_id, variants = null, weight = null, price = null){
    var btn = $('button[data-dish-id=\"'+dish_id+'\"]');

    var params = {'action': 'add', 'dish_id': dish_id};

    if(variants) params.variants = variants;
    if(weight) params.weight = weight;
    if(price) params.price = price;

    ajax_request(params, '/dishes_cart', 'json', 'post',
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

            //заказ только в 1 ресторане за раз
            if(typeof $json.rest_exist !== "undefined"){

                return swal('В корзине уже есть блюда из ресторана '+ $json.rest_exist.name+'. \nОни будут удалены для добавления новых', {
                    title: 'Обновить корзину?',
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Отмена",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Очистить и добавить новое",
                            value: dish_id,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    },
                })
                .then((add_dish_id) => {
                    if(add_dish_id){
                        //Очищаем
                        ajax_request({
                                'action': 'clear',
                            }, '/dishes_cart', 'json', 'post',
                            null,
                            function ($json) {
                                //Добавляем новое блюдо
                                cart_update($json);
                                $('body').removeClass('cleared');
                                return add_to_cart(add_dish_id, variants, weight, price);
                            });
                    }
                });
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
};

//Корзина
$(document).on("click", '.add_to_cart', function(){
    return add_to_cart($(this).data('dish-id'));
});

//Переход и открытие
$(document).on("click", 'button.open_in_rest', function(){
    var box     = $(this).parents('.shop_pos_item'),
        dish_id = box.data('product-id'),
        go_url  = box.data('url');

    box.addClass('load');
    window.location.href = go_url;
    return false;
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
global.products_show_more2 = function (btn) {
    var btn = $(btn),
        container = btn.parents('.products_items'),
        hiddens = container.children('.row').children('div:hidden').length,
        holders = btn.data('switch').split('|');

    btn.text(holders[0]);

    if (container.hasClass('compact')) {
        container.removeClass('compact');
        btn.text(holders[1]);
    } else {
        container.addClass('compact');
        btn.text(holders[0]);
    }

    return false;

};

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
if($('#products_search').length && $('#products .shop_pos_item').length){

    $('#products_search').on('keyup', function () {
        var input = $(this),
            query = TrimStr(input.val()).toLowerCase(),
            scroll = null,
            find = false;

        $('#products .shop_pos_item').each(function () {
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


global.mod_massage = function (title, text, autoclose = true) {
    $('#mod_massage__module .title').text(title);
    $('#mod_massage__module .text').html(text);

    $('#mod_massage__module').modal('show');

    if (autoclose) {
        setTimeout(function () {
            $('#mod_massage__module').modal('hide');
        }, 4000);
    }

}
function TrimStr(s) {
    s = s.replace(/^\s+/g, '');
    return s.replace(/\s+$/g, '');
}

// global.ajax_request = function (data, action, datatype, type, on_submit, success, error) {
//
//     //до ответа сервера
//     if(typeof on_submit === 'function') on_submit(data);
//     //...
//
//     var datatype = datatype ? datatype : 'JSON',
//         type = type ? type : 'post',
//         fields = (fields !== undefined) ? fields : {};
//
//     $.ajax({
//         url: action,
//         dataType: datatype,
//         data: data,
//         type: type,
//         success:function(response){
//             //сервер ответил
//             if(typeof success === 'function') success(response, fields);
//             //...
//         },
//         error:function(jqXHR, textStatus, errorThrown){
//             //какая то ошибка
//             if(typeof error === 'function'){
//                 error();
//             }else{
//                 console.log('// Ошибка при отправке:');
//                 console.log(jqXHR.status);
//                 console.log(textStatus);
//                 console.log(errorThrown);
//                 console.log('//');
//             }
//             //...
//         }
//     });
// }

global.cart_update = function (data) {
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
        $('#card__module_modal').modal('hide');
    }

    if(data.small_order){
        $('#card__module_modal .card_order_actions').addClass('disabled_box');
    }else{
        $('#card__module_modal .card_order_actions').removeClass('disabled_box');
    }

    $('#card__module_modal .card_products .items').html(data.content);

}




