$(document).ready(() => {
    $('#reason').change(function () {
        if ($('#reason').val() == 'other') {
            $('#note').closest('.form-group').removeClass('hidden').fadeIn();
            $("#note").prop('required',true);
        } else {
            $('#note').closest('.form-group').addClass('hidden').fadeIn();
        }
    });

    $('#type').change(function () {
        if ($('#type').val() == 'dao_cif') {
            $('#cif').closest('.form-group').removeClass('hidden').fadeIn();
            $('#acct_no').closest('.form-group').addClass('hidden').fadeIn();
            $('#customer_name').closest('.form-group').addClass('hidden').fadeIn();
        } else {
            $('#cif').closest('.form-group').addClass('hidden').fadeIn();
            $('#acct_no').closest('.form-group').removeClass('hidden').fadeIn();
            $('#customer_name').closest('.form-group').removeClass('hidden').fadeIn();
        }
    });

    $(".datepicker").datepicker({
        maxDate: new Date()
    });
});