$(document).ready(function () {
    //alert('HI!');
    var params = window
        .location
        .search
        .replace('?', '')
        .split('&')
        .reduce(
            function (p, e) {
                var a = e.split('=');
                p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );
    var sleep_after_load = false;
    //require('cache/jsLanguage/en_us.js');
    var buttonName = SUGAR.language.get('app_list_strings','kanban_board').LBL_BUTTON_MENU;
    if(params.action == "ajaxui") {
        sleep_after_load = true;
        var anc = decodeURIComponent(window.location.hash.replace("#", ""));
        var url = getAllUrlParams(anc);
        params = url;
    }

    if (sleep_after_load){
        setTimeout(function (){
            show_button(params,buttonName);
        });
    } else {
        show_button(params,buttonName);
    }
});

function show_button(params,buttonName){
    if(!$('#actionMenuSidebar ul li').is('.kanban-button')) {
        $('#actionMenuSidebar ul').append("<li class=\"actionmenulinks kanban-button\" role=\"presentation\">\n" +
            "                                                <a href=\"index.php?module=BOARD&amp;action=index&amp;recipient_module=" + params.module + "&amp;\" data-action-name=\"BOARD\">\n" +
            "                                                    <div class=\"side-bar-action-icon\">\n" +
            "                                                        <span class=\"suitepicon suitepicon-action-vcard\"></span>\n" +
            "                                                    </div>\n" +
            "                                                    <div class=\"actionmenulink\">" + buttonName + "</div>\n" +
            "                                                </a>\n" +
            "                                            </li>");
    }
}

function getAllUrlParams(url) {

    // извлекаем строку из URL или объекта window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // объект для хранения параметров
    var obj = {};

    // если есть строка запроса
    if (queryString) {

        // данные после знака # будут опущены
        queryString = queryString.split('#')[0];

        // разделяем параметры
        var arr = queryString.split('&');

        for (var i=0; i<arr.length; i++) {
            // разделяем параметр на ключ => значение
            var a = arr[i].split('=');

            // обработка данных вида: list[]=thing1&list[]=thing2
            var paramNum = undefined;
            var paramName = a[0].replace(/\[\d*\]/, function(v) {
                paramNum = v.slice(1,-1);
                return '';
            });

            // передача значения параметра ('true' если значение не задано)
            var paramValue = typeof(a[1])==='undefined' ? true : a[1];

            // преобразование регистра
            //paramName = paramName.toLowerCase();
            //paramValue = paramValue.toLowerCase();

            // если ключ параметра уже задан
            if (obj[paramName]) {
                // преобразуем текущее значение в массив
                if (typeof obj[paramName] === 'string') {
                    obj[paramName] = [obj[paramName]];
                }
                // если не задан индекс...
                if (typeof paramNum === 'undefined') {
                    // помещаем значение в конец массива
                    obj[paramName].push(paramValue);
                }
                // если индекс задан...
                else {
                    // размещаем элемент по заданному индексу
                    obj[paramName][paramNum] = paramValue;
                }
            }
            // если параметр не задан, делаем это вручную
            else {
                obj[paramName] = paramValue;
            }
        }
    }

    return obj;
}