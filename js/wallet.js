jQuery(document).ready(function ($){
    $('#sentbitcoinsform').submit(function (){
        var isValid = true;
        $('#sentbitcoinsform .input-error').removeClass('input-error');
        $('#send-bitcoins .message').remove();
        if($('#sentbitcoinsform #receiver').val() == ''){
            $('#sentbitcoinsform #receiver').addClass('input-error');
            isValid = false;
        }

        if($('#sentbitcoinsform #amount').val() == ''){
            $('#sentbitcoinsform #amount').addClass('input-error');
            isValid = false;
        }

        if($('#sentbitcoinsform #password').val() == ''){
            $('#sentbitcoinsform #password').addClass('input-error');
            isValid = false;
        }

        if(!isValid){
            $('#send-bitcoins .titles').after('<p class="message error">Please complete the fields in red.</p>');
        }

        return isValid;
    })
})