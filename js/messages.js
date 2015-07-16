(function ($){
    //Remove Error Messages
    $('#messagelistform .td-chk input').click(function (){
        $('#messagelistform p.message').remove();
    })
    //Validate the inputs before submit new message
    $('#composeform').submit(function (){
        var isValid = true;
        var form = $(this);
        if($('#receiverholder .name').size() < 1){
            $('#receiver').addClass('input-error');
            isValid = false;
        }
        if($('#subject').val() == ''){
            $('#subject').addClass('input-error');
            isValid = false;
        }
        if($('#body').val() == ''){
            $('#body').addClass('input-error');
            isValid = false;
        }
        if(!isValid){
            showMessage($('#composeform'), 'Please complete the fields in red.', true);
        }else{
            //Saving Data using ajax
            form.find('.loading-wrapper').show();
            $.ajax({
                url: '/messages_compose.php',
                data: form.serialize(),
                type: 'post',
                dataType: 'xml',
                success: function (rsp){
                    form.find('.loading-wrapper').hide();
                    hideMessage(form);
                    showMessageHTML(form, $(rsp).find('message').text());

                    //Reset Form
                    if($(rsp).find('status').text() == 'success'){
                        form.find('#receiverholder .name').remove();
                        form.find('#subject').val('');
                        form.find('#body').val('');
                    }

                    fixReceivers();
                },
                error: function (err){
                    showMessage(form, err.responseText, true);
                    form.find('.loading-wrapper').hide();
                }
            });
        }

        return false;
    });

    //confirm before delete messages
    $('#delete-messages').click(function (){
        var form = $(this).parents('form');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No message selected!', true);
            return;
        }
        if(confirm('Are you sure that you want to delete the selected messages?')){
            form.submit();
        }
    })

    $('#messagedetailform #delete-message').click(function (){
        $('#messagedetailform #action').val('delete_message');
        $('#messagedetailform').submit();
    })
    $('#messagedetailform #delete-forever').click(function (){
        $('#messagedetailform #action').val('delete_forever');
        $('#messagedetailform').submit();
    })
    $('#messagedetailform #reply-message').click(function (){
        document.location.href = "/messages_compose.php?reply=" + $(this).attr('data-id') + "&to=" + $('#messagedetailform input[name="senderID"]').val();
    })

    //Fix the left of names
    if($('#receiverholder').size() > 0){
        fixReceivers();
    }
    //AutoComplete
    $('#receiver').autocomplete({
        appendTo: '#receiverholder', source: function (request, response){
            $.getJSON("/get_friends.php", {
                term: request.term
            }, response);
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
            $('#receiverholder').append('<span class="name">' + ui.item.label + ' <a href="#">x</a><input type="hidden" name="to[]" class="receiver-ids" value="' + ui.item.id + '" /></span>');
            fixReceivers();
            $('#receiverholder #receiver').val('');
            return false;
        }, close: function (){
            $('#receiverholder #receiver').val('');
        }
    });
    //Remove Receivers
    $(document).on('click', '#receiverholder .name a', function (){
        $(this).parent().fadeOut('fast', function (){
            $(this).remove();
            fixReceivers();
        })
        return false;
    })

    function fixReceivers(){
        var inputWidth = $('#receiverholder #receiver').width();
        var marginLeft = 0;
        $('#receiverholder .name').each(function (){
            $(this).css('left', marginLeft + 2);
            marginLeft += $(this).outerWidth() + 2; //2 = margin-left;

        });

        inputWidth -= marginLeft;
        if(inputWidth < 150)
            inputWidth = 150;
        if(marginLeft + inputWidth < 300)
            inputWidth = 300 - marginLeft;
        $('#receiverholder #receiver').width(inputWidth).css('margin-left', marginLeft);
    }
})(jQuery)