jQuery(document).ready(function($) {
    //инициализация select2
    if ($('.select2-enable').length) {
        $('.select2-enable').each(function () {
            var _class = $(this).hasClass('topnav-location') ? 'locations-list' : '';
            $(this).select2({
                selectionCssClass: _class,
            });
        })
    }
})