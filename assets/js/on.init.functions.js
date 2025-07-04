(function () {
    'use strict';
    if (!location.host.search('test')) window.scrollTo(0);
    // on init functions
    let directory = directory_uri.stylesheet_directory_uri;
    // Флаг, что скрипт уже загрузилась.
    var loadedScript = false,
        // Переменная для хранения таймера.
        timerId, rand = Math.floor(Math.random() * 1000) / 1000;
    const scripts = [
            directory + "/assets/js/reviews.js",
            directory + "/assets/js/vendor/select2.min.js",
            directory + "/assets/js/form.js",
            directory + "/assets/js/header.js",
            directory + "/assets/js/videos.js",
            directory + "/assets/js/doctors.js",
            directory + "/assets/js/carousel.js",
            directory + "/assets/js/certificates-carousel.js",
            directory + "/assets/js/branch-addresses.js",

], promise_script = [],
        styles = [
        ];
    let mobile_click = 0;
    // Для ботов грузим скрипт сразу без "отложки".
    // Подключаем скрипт, если юзер начал скроллить.
    window.addEventListener('scroll', loadScript, {passive: true});
    // Подключаем Метрику, если юзер коснулся экрана.
    window.addEventListener('touchstart', loadScript);
    // // Подключаем Метрику, если юзер дернул мышкой.
    document.addEventListener('mouseenter', loadScript);
    // // Подключаем Метрику, если юзер кликнул мышкой.
    document.addEventListener('click', loadScript);
    // Подключаем скрипты при полной загрузке DOM дерева,
    // если пользователь ничего вообще не делал (фоллбэк).
    document.addEventListener('DOMContentLoaded', loadFallback);

    function loadFallback() {
        timerId = setTimeout(loadScript, 10000);
    }

    function loadScript(e) {
        if (loadedScript) {
            return;
        }
        if (document.location.href.search(/\.int/gmi) === -1) {
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js',});
                var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-N8JZPM4');
        }
        // Отмечаем флаг, что скрипт загрузился,
        // чтобы не загружать его повторно при других
        // событиях пользователя и старте фоллбэка.
        loadedScript = true;
        styles.map(function (style) {
            let link = document.createElement('link');
            link.setAttribute('rel', 'stylesheet');
            link.setAttribute('media', 'all');
            link.setAttribute('href', style);
            document.head.appendChild(link);
        })

        loadScriptByIndex(0);

        // Очищаем таймер, чтобы избежать лишних утечек памяти.
        clearTimeout(timerId);
    }

    function loadScriptByIndex(i) {
        if (typeof (scripts[i]) != "string") return false;
        setTimeout(() => {
            promise_script[i] = loadScriptSrc(scripts[i]);
            promise_script[i].then(loadScriptByIndex(i + 1));
        }, 10)
    }
    function loadScriptSrc(src) {
        return new Promise((resolve, reject) => {
            if( !(window.isFancyLoaded && src.search('fancybox') > 0)) {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            }
        });
    }
})();