(function ($){
    $('#applymoderator').submit(function (){
        if($('#applymoderator input[name="action"]') != 'delete-candidate' && $('#moderator_text').css('display') == 'none'){
            $('#moderator_text').show();
            $(this).find('.redButton').val('Submit');
            return false;
        }
        if($('#applymoderator input[name="action"]') != 'delete-candidate' && $('#moderator_text').val() == ''){
            alert('Please tell us why you would make a good moderator.');
            $('#moderator_text').focus();
            return false;
        }
    })

    $('#addmoderator').submit(function (){
        if($('#applymoderator input[name="action"]') != 'delete-candidate' && $('#new_moderator_id').val() == ''){
            alert('Please enter the user id that you want to promote moderator.');
            $('#new_moderator_id').focus();
            return false;
        }
    })


    $('#delete-candidate-btn').click(function (){
        return confirm('Are you sure that you want to delete this application?');
    })

    //Thumb up
    $('.candidate-row a.thumb-up, .candidate-row a.thumb-down').click(function (){
        var link = $(this);
        link.parent().find('.loading-wrapper').show();
        $.ajax({
            url: '/moderator.php', data: {
                'candidateID': link.attr('data-id'),
                'candidateIDHash': link.attr('data-hashed'),
                'action': link.attr('class'),
                'type': $('#applymoderator #type').val(),
            }, type: 'post', dataType: 'xml', success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    link.parent().find('.votes-count').html($(rsp).find('votes').text());
                    link.parent().addClass('voted');
                }else{
                    alert($(rsp).find('message').text());
                }
            }, complete: function (){
                link.parent().find('.loading-wrapper').hide();
            }
        })
        return false;
    })
})(jQuery)