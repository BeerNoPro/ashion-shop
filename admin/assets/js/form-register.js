$(document).ready(function() {

    const btnRegister = $('#btn-register')

    btnRegister.on('click', function(e) {

        const pwd = $('#password').val();
        const confirmPwd = $('#password_confirmation').val();
        const getParent = $('#password_confirmation').closest('.form-group');
        const formMes = $(getParent).find('.form-message');

        // check password confirmation
        if (pwd != confirmPwd) {
            e.preventDefault();
            $(getParent).addClass('invalid');
            $(formMes).addClass('invalid');
            $(formMes).text('Mật khẩu nhập lại không chính xác!');
        } else {
            $(btnRegister).submit();
        }

        // check close error input
        $('#password_confirmation').on('input', function () {
            $(getParent).removeClass('invalid');
            $(formMes).removeClass('invalid');
            $(formMes).text('');
        })

        
    });
    
    // const getInvalid = $('.invalid');
    //     const getFormGroup = $(getInvalid).closest('.form-group');
    //     console.log(getInvalid)

        // // check error email add border red
        // if (getInvalid[0].innerText != '') {
        //     $(getFormGroup).addClass('invalid');
        // }

        // // on input remove class error
        // $('#email').on('input', function() {
        //     $(getFormGroup).removeClass('invalid');
        //     $(getInvalid).css('display', 'none');
        // })

});