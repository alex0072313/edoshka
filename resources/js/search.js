$(function ($) {
    if($('.search__module').length){
        $('.search__module').each(function () {
            init($(this));
        });
    }

    function init(box)
    {
        var box = box,
            results_box = box.find('.results_box'),
            items = results_box.find('.items'),
            input = box.find('input');

        input.on('keyup', delay(function () {
            var q = $(this).val();
            return q ? load(q) : close();
        }, 800));

        input.on('focus', delay(function () {
            if($(this).val()){
                box.addClass('focus');
                $('body').addClass('position-relative');
            }
        },0));

        function load(q)
        {
            ajax_request(
                {q:q},
                '/search',
                'json',
                'post',
                function(){
                    results_box.removeClass('notfound');
                    return preload();
                },
                function (json) {
                    return open(json);
                }
            );
        }

        function preload(cancel = false)
        {
            if(cancel){
                results_box.removeClass('waiting');
            }else{
                results_box.addClass('waiting');
            }
        }

        function close()
        {
            box.removeClass('focus');
            $('body').removeClass('position-relative');
        }

        function open(json)
        {
            analytics_action('poisk');

            $(document).on('click', function (el) {
                var el = el.target;
                if(!$(el).parents('.search__module').length){
                    return close();
                }
            });

            var html = '';

            if(json.length !== 0){

                for (var r in json.restaurants){

                    html += '<div class="shop">' +
                                '<a href="'+json.restaurants[r].href+'" title="'+json.restaurants[r].name+'" class="info d-flex">';
                                if(json.restaurants[r].image){
                                    html += '<div>' +
                                                '<img src="'+json.restaurants[r].image+'" alt="'+json.restaurants[r].name+'">' +
                                            '</div>';
                                }
                            html += '<div class="flex-grow-1">' +
                                        '<div class="h5 mb-0">'+json.restaurants[r].name+'</div>';
                                            if(json.restaurants[r].categories){
                                                html += '<span class="text-secondary font-weight-light">' +
                                                            json.restaurants[r].categories +
                                                        '</span>';
                                            }
                                        html += '</div>' +
                                '</a>' +
                                '<div class="items">';

                        for (var d in json.restaurants[r].dishes){
                            html += '<div class="item">' +
                                        '<a href="'+json.restaurants[r].dishes[d].href+'" title="'+json.restaurants[r].dishes[d].name+'" class="d-block">' +
                                            '<div class="d-flex">' +
                                                '<div>' +
                                                    '<img src="'+json.restaurants[r].dishes[d].image+'" alt="'+json.restaurants[r].dishes[d].name+'">' +
                                                '</div>' +
                                                '<div class="ml-2">' +
                                                    '<div class="text-black">'+json.restaurants[r].dishes[d].name+'</div>' +
                                                    '<span class="text-secondary font-weight-light'+(json.restaurants[r].dishes[d].newprice ? ' text-danger' : '')+'">'+(json.restaurants[r].dishes[d].newprice ? json.restaurants[r].dishes[d].newprice : json.restaurants[r].dishes[d].price)+' ₽</span>' +
                                                '</div>' +
                                            '</div>' +
                                        '</a>' +
                                    '</div>';
                        }
                    html += '</div>' +
                        '</div>';
                }

            }else{

                results_box.addClass('notfound');
            }

            items.html(html).promise().done(function(){
                box.addClass('focus');
                $('body').addClass('position-relative');

                preload(true);
            });

        }

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

    }


});

