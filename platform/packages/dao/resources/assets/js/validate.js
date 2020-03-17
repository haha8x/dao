class DaoValidate {
    handleDaoValidate() {

        $('.dao-check-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                branch_id: {
                    required: true
                },
                staff_id: {
                    required: true
                },
                email: {
                    required: true
                },
                cmnd: {
                    required: true
                }
            },

            messages: {
                branch_id: {
                    required: 'Bạn chưa chọn Chi nhánh'
                },
                staff_id: {
                    required: 'Bạn chưa nhập Mã nhân viên'
                },
                email: {
                    required: 'Bạn chưa nhập Email'
                },
                cmnd: {
                    required: 'Bạn chưa nhập CMND'
                }
            },

            invalidHandler: () => { //display error alert on form submit
                $('.alert-danger', $('.dao-check-form')).show();
            },

            highlight: (element) => { // highlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: (label) => {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: (error, element) => {
                error.insertAfter(element.closest('.form-control'));
            },

            submitHandler: (form) => {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.dao-check-form input').keypress((e) => {
            if (e.which === 13) {
                if ($('.dao-check-form').validate().form()) {
                    $('.dao-check-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    init() {
        this.handleDaoValidate();
    }
}

$(document).ready(() => {
    new DaoValidate().init();
});