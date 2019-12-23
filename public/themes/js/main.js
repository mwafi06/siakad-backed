$(function() {

    $('.btn-refresh').click(function () {
        $(this).find('i').addClass('fa-spin');
    });

    $('.required').each(function(){
        $(this).append('&nbsp;<span class="required-text">*</span>');
    });

    /*
     * form action section
     */
    $('.form-action-add').click(function () {
        let href = $(this).data('href');
        return window.location.href = href;
    });

    $('.form-action-edit').click(function () {
        let href = $(this).data('href');
        let id = $('.checkbox-table:checkbox:checked:first').data('id');

        if(typeof id === 'undefined')
        {
            return alert('No data selected! please select data to process');
        }
        return window.location.href = href+'/'+id;
    });

    $('.form-action-delete').click(function () {
        let href = $(this).data('href');
        let id = $('.checkbox-table:checkbox:checked:first').data('id');

        if(typeof id === 'undefined')
        {
            return alert('No data selected! please select data to process');
        }

        if (confirm('Are you confirm to delete data?'))
        {
            return window.location.href = href+'/'+id;
        }
    });

    $('.form-action-cancel').click(function () {
        let href = $(this).data('href');
        return window.location.href = href;
    });

    $('.form-action-save').click(function () {
        let target = $(this).data('target');
        return $(target).submit();
    });




    /*
     * see password function
     */
    $('.see-password').click(function () {
        let target = $(this).data('target');
        target = $(target);

        if (typeof target === 'undefined')
        {
            return;
        }

        let type = target.attr('type');

        if (type === 'text')
        {
            target.attr('type','password');
        }

        if (type === 'password')
        {
            target.attr('type','text');
        }
    });

    /*
     * auto hide alert
     */
    setTimeout(function () {
        $('.alert').fadeOut();
    },2000)

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
