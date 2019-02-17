
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import $ from 'jquery';
window.$ = window.jQuery = $;

require('popper.js');
require('./bootstrap');

require('bootstrap/dist/js/bootstrap.min');

import {tns} from 'tiny-slider/src/tiny-slider';

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

//Добавление в козину + просмотр
if($('.shop_pos_item').length) {

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
                $('#shop_pos_item_modal_'+id).modal('show');
            }
        });

        add_to_cart.on('click', function () {
            if(drag === 0){
                console.log('В корзине!');
            }
        });

    });


}

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

function TrimStr(s) {
    s = s.replace(/^\s+/g, '');
    return s.replace(/\s+$/g, '');
}




