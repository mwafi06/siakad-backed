$(function() {

    $('.captcha .refresh').click(function () {
        const spin = $(this).find('span');
        spin.addClass('fa-spin');
        $.get('/refresh-captcha/default','',function(cap){
            $('.captcha img').prop('src',cap);
            spin.removeClass('fa-spin');
        });
    });

    $('.submit').click(function () {
        const element = $(this);
        const loading = $('.login-loading');

        loading.css('display','inline-block');
    });

    $('body').delegate('.numeric', 'keydown', function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
