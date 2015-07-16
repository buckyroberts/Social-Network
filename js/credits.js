(function ($){
    //AutoComplete
    $('#receiver').autocomplete({
        appendTo: '#receiverholder', source: function (request, response){
            /*$.getJSON( "/credits.php?action=get-users", {
             term: request.term
             }, response );*/
            $.ajax({
                url: '/credits.php',
                data: {term: request.term, action: 'get-users'},
                dataType: 'json',
                type: 'post',
                success: response
            });
        }, search: function (){
            // custom minLength
            var term = this.value;
            if(term.length < 1){
                return false;
            }
        }, focus: function (){
            // prevent value inserted on focus
            return false;
        }, select: function (event, ui){
            //Add New Item
            $('#receiverholder').append('<span class="name">' + ui.item.label + ' <a href="#">x</a>' + '<input type="hidden" name="receiverID" value="' + ui.item.id + '" />' + '<input type="hidden" name="receiverIDHash" value="' + ui.item.hash + '" /></span>');
            $('#receiverholder #receiver').hide();
            return false;
        }, close: function (){
            $('#receiverholder #receiver').val('');
        }
    });

    //Remove Receivers
    $(document).on('click', '#receiverholder .name a', function (){
        $(this).parent().fadeOut('fast', function (){
            $(this).remove();
            $('#receiverholder #receiver').show();
        })
        return false;
    })

    $('#sendcreditsform').submit(function (){

        var amountObj = $('#sendcreditsform #amount');

        if($('#sendcreditsform input[name="receiverID"]').size() == 0){
            return false;
        }
        if(amountObj.val() == ''){
            alert('Please enter the amount that you want to send.');
            amountObj.focus();
            return false;
        }
        if(isNaN(amountObj.val())){
            alert('Please enter a valid number.');
            amountObj.focus();
            return false;
        }

        var fixedAmount = parseFloat(amountObj.val());
        fixedAmount = fixedAmount.toFixed(2);

        if(fixedAmount != parseFloat(amountObj.val())){

            alert('You could not be able to send credits using more than 2 decimal places.');
            amountObj.focus();

            return false;
        }


    })
})(jQuery)