import bsBreakpoints from "bs-breakpoints";

global.events = {};

global.setEv = function (ev, val = null) {
    return events[ev] = val;
}
global.getEv = function (ev) {
    return (typeof events[ev] !== 'undefined') ? events[ev] : null;
}
global.rmEv = function (ev) {
    return (typeof events[ev] !== 'undefined') ? delete events[ev] : false;
}
global.setCookie = function (name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; domain=.azur.ru; path=/";
}
global.getCookie = function (name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
global.eraseCookie = function (name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}
global.ajax_request = function (data, action, datatype, type, on_submit, success, error) {

    //до ответа сервера
    if (typeof on_submit === 'function') on_submit(data);
    //...

    var result = null;

    var datatype = datatype ? datatype : 'json',
        type = type ? type : 'post',
        fields = (fields !== undefined) ? fields : {};

    $.ajax({
        url: action,
        dataType: datatype,
        data: data,
        type: type,
        success: function (response) {
            //сервер ответил
            if (typeof success === 'function') {
                success(response, fields);
            } else {
                result = response;
                return response;
            }
            //...
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //какая то ошибка
            if (typeof error === 'function') {
                error();
            } else {
                console.log('// Ошибка при отправке:');
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('//');
            }
            //...
        }
    });

    return result;
}
global.request = function (data, action, datatype, type, on_submit) {

    //до ответа сервера
    if (typeof on_submit === 'function') on_submit(data);
    //...

    var result = null;

    var datatype = datatype ? datatype : 'json',
        type = type ? type : 'post';

    return $.ajax({
        url: action,
        dataType: datatype,
        data: data,
        type: type,
        async: false,
        error: function (jqXHR, textStatus, errorThrown) {
            //какая то ошибка
            if (typeof error === 'function') {
                error();
            } else {
                console.log('// Ошибка при отправке:');
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('//');
            }
            //...
        }
    }).responseJSON;

}
global.deepEqual = function (obj1, obj2) {
    return JSON.stringify(obj1) === JSON.stringify(obj2);
}
global.isMobile = function () {

    function mobilecheck() {
        var check = false;
        (function (a) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };

    if (mobilecheck() || ((bsBreakpoints.getCurrentBreakpoint() == 'small') || (bsBreakpoints.getCurrentBreakpoint() == 'xSmall'))) {
        return true;
    }

    return false;
}
global.nowdate = function (format = 'dd/mm/yyyy', offset = 0) {

    var today = new Date();
    var dd = today.getDate()+offset;
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

    if(dd<10){ dd='0'+dd }
    if(mm<10){ mm='0'+mm }
    //var today = dd+'/'+mm+'/'+yyyy;
    var r = format.replace('dd', dd).replace('mm', mm).replace('yyyy', yyyy);

    return r;

}
global.redirect = function (href, blank = false) {
    if((href.indexOf('http://') == -1) && (href.indexOf('https://') == -1)){
        href = 'http://'+href;
    }
    window.open(href, blank ? '_blank' : '');
    return false;
};
global.scrollToElement = function (elem, speed = 700, offset = 0, callback = null) {
    $([document.documentElement, document.body]).animate({
        scrollTop: elem.offset().top - offset,
        complete : (typeof callback === 'function') ? callback() : null
    }, speed);
};
global.pluralform = function (number, after, onlyword = false) {
    number = parseInt(number);
    if(number < 0) return  null;
    var cases = [2, 0, 1, 1, 1, 2];
    return (!onlyword ? number+' ' :'') + after[(number%100>4 && number%100<20)? 2: cases[Math.min(number%10, 5)]];
};
