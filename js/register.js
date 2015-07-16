(function ($){
    $('#newaccount').submit(function (){
        var isValid = true;
        var form = $(this);
        var filter = /^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
        if(form.find('#firstName').val() == ''){
            isValid = false;
            form.find('#firstName').addClass('input-error');
        }
        if(form.find('#lastName').val() == ''){
            isValid = false;
            form.find('#lastName').addClass('input-error');
        }
        if(form.find('#email').val() == ''){
            isValid = false;
            form.find('#email').addClass('input-error');
        }
        if(form.find('#password').val() == ''){
            isValid = false;
            form.find('#password').addClass('input-error');
        }
        if(form.find('#password2').val() == ''){
            isValid = false;
            form.find('#password2').addClass('input-error');
        }
        /* Invite Code
         if( form.find('#inviteCode').val() == '' )
         {
         isValid = false;
         form.find('#inviteCode').addClass('input-error');
         }
         */
        if(!isValid){
            showMessage(form, 'Please complete the fields in red.', true);
            return false;
        }
        if(!filter.test(form.find('#email').val())){
            isValid = false;
            form.find('#email').addClass('input-error');
            showMessage(form, 'Please enter a valid E-mail address.', true);
            return false;
        }
        if(form.find('#password').val() != form.find('#password2').val()){
            form.find('#password').addClass('input-error');
            showMessage(form, 'The passwords don\'t match.', true);
            return false;
        }

        if(!validatePasswordStrength(form.find('#password').val())){
            showMessage(form, 'The password should be more than 8 characters and include at least 1 number.', true);
            form.find('#password').addClass('input-error');
            return false;
        }

        if(form.find('#recaptcha_response_field').val() == ''){
            isValid = false;
            form.find('#recaptcha_response_field').focus();
            showMessage(form, 'Please type the two words.', true);
            return false;
        }

        if(form.find('#agree_terms').prop('checked') == false){
            isValid = false;
            showMessage(form, 'You must accept the Terms and Conditions.', true);
            return false;
        }

        //Create an account by ajax
        form.find('.loading-wrapper').show();
        $.ajax({
            url: '/register.php',
            data: form.serialize() + '&action=create-account',
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                form.find('.loading-wrapper').hide();
                if($(rsp).find('status').text() == 'success'){
                    showMessage(form, $(rsp).find('message').text(), false);
                    form.find('input[type="text"], input[type="password"]').val('');
                }else{
                    showMessageHTML(form, $(rsp).find('message').text(), true);
                    javascript:Recaptcha.reload();
                    form.find('#recaptcha_response_field').val('');
                }
            },
            error: function (err){
                form.find('.loading-wrapper').hide();
                showMessage(form, err.responseText, true);
            }
        })
        return false;
    })
    $(document).ready(function (){
        $('.goto-forgotpwdform').click(function (){
            $('#loginform').fadeOut('fast', function (){
                $('#forgotpwdform').fadeIn();
            });
            return false;
        });
        $('.goto-loginform').click(function (){
            $('#forgotpwdform').fadeOut('fast', function (){
                $('#loginform').fadeIn();
            });

            return false;
        });

        //Reset Password Form
        $('#resetpwdform').submit(function (){
            var form = $(this);
            var isValid = true;

            if(form.find('#password').val() == ''){
                form.find('#password').addClass('input-error');
                isValid = false;
            }
            if(form.find('#password2').val() == ''){
                form.find('#password2').addClass('input-error');
                isValid = false;
            }
            if(!isValid){
                showMessage(form, 'Please enter your new password.', true);
            }
            if(isValid && form.find('#password').val() != form.find('#password2').val()){
                form.find('#password').addClass('input-error');
                isValid = false;
                showMessage(form, 'New password doesn\'t match.', true);
            }
            return isValid;
        })

    })
})(jQuery)