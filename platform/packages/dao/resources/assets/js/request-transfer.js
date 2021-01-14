$(document).ready(() => {
    $('#reason').change(function () {
        if ($('#reason').val() == 'other') {
            $('#note').closest('.form-group').removeClass('hidden').fadeIn();
            $("#note").prop('required', true);
        } else {
            $('#note').closest('.form-group').addClass('hidden').fadeIn();
        }
    });

    $('#type').change(function () {
        if ($('#type').val() == 'ld') {
            $('.ref_no_label').text("LD").fadeIn();
        } else if ($('#type').val() == 'stk') {
            $('.ref_no_label').text("Số Tài Khoản").fadeIn();
        } else if ($('#type').val() == 'al') {
            $('.ref_no_label').text("AL").fadeIn();
        } else if ($('#type').val() == 'md') {
            $('.ref_no_label').text("MD").fadeIn();
        } else {
            $('.ref_no_label').text("CIF").fadeIn();
        }
    });

    $(".datepicker").datepicker({
        maxDate: new Date()
    });
});