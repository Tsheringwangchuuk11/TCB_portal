$(document).ready(function () {
    $('.form-confirm').on('click', function(e) {
        e.preventDefault();
        var el = $(this).next();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');

        $('#form-confirm')
        .find('#form-body').html(msg)
        .end().find('#form-title').html(title)
        .end().modal('show');

        $('#form-confirm').find('#form-submit').attr('data-form', dataForm);
    });

    $('#form-confirm').on('click', '#form-submit', function(e) {
        var id = $(this).attr('data-form');
        $(id).submit();
    });
});