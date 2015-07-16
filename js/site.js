function showMessage(form, message, error){
    $(form).find('.message').remove();
    if($(form).find('.row').size() > 0){
        $(form).find('.row:eq(0)').before('<p class="message ' + (error ? 'error' : 'success') + '" style="display: none">' + message + '</p>');
    }else{
        $(form).prepend('<p class="message ' + (error ? 'error' : 'success') + '" style="display: none">' + message + '</p>');
    }

    $(form).find('.message').fadeIn('fast');
}

function hideMessage(form, delay){
    if(typeof delay != 'undefined' && delay > 0)
        setTimeout(function (){
            $(form).find('.message').remove();
        }, delay * 1000);else
        $(form).find('.message').remove();

}

function showMessageHTML(form, message){
    $(form).find('.message').remove();
    if($(form).find('.row').size() > 0){
        $(form).find('.row:eq(0)').before(message);
    }else{
        $(form).prepend(message);
    }

    $(form).find('.message').fadeIn('fast');
}

function showAjaxLoader(){
    if(jQuery('body .ajax-mask').size() == 0){
        jQuery('body').append('<div class="ajax-mask"><div class="ajax-mask-loading"></div></div>');
        jQuery('.ajax-mask').width(jQuery(window).width());
        jQuery('.ajax-mask').height(jQuery(window).height());
    }else{
        jQuery('body .ajax-mask').show();
    }

}

function hideAjaxLoader(){
    jQuery('.ajax-mask').remove();
}

function validatePasswordStrength(password){
    if(password.length < 8 || !password.match(/[0-9]+/)){
        return false;
    }

    return true;
}

(function ($){
    $(document).ready(function (){
        //Frame Buster
        if(top != self){
            document.write('<p>You are viewing this page in a unauthorized frame window</p>');
            return;
        }

        $('.input').focus(function (){
            $(this).removeClass('input-error');
        })
        $('.select').change(function (){
            $(this).parent().find('select').removeClass('select-error');
        })
        $('.textarea').focus(function (){
            $(this).removeClass('input-error');
        })

        if($('#footer_menu').size() > 0){
            //Footer menu
            $('#footer_menu').on('mouseover', 'li.has-submenu', function (){
                $(this).addClass('hover');
            });
            $('#footer_menu').on('mouseout', 'li.has-submenu', function (){
                $(this).removeClass('hover');
            });


            $('#footer_menu').click(function (e){
                e.stopPropagation();
            })
            $(window).click(function (){
                $('#footer_menu li.hover').removeClass('hover');
            })
        }
        $('.table #chk_all').click(function (){
            if(this.checked)
                $(this).parents('.table').find('.tr .td-chk input[type="checkbox"]').prop('checked', true);else
                $(this).parents('.table').find('.tr .td-chk input[type="checkbox"]').prop('checked', false);
        })
        $('table #chk_all').click(function (){
            if(this.checked)
                $(this).parents('table').find('.td-chk input[type="checkbox"]').prop('checked', true);else
                $(this).parents('table').find('.td-chk input[type="checkbox"]').prop('checked', false);
        })

        if($('#forum-left-bar').size() > 0 && $('#forum-left-bar').height() > $('#forum-content-wrapper').height()){
            $('#forum-content-wrapper').height($('#forum-left-bar').height());
        }

    })

    $(document).on('click', 'a.report-link', function (){

        if(confirm('Are you sure to report?')){
            var link = $(this);
            link.html('<img src="/images/loading1.gif" />');
            $.ajax({
                url: '/report_object.php', type: 'post', data: {
                    'type': link.attr('data-type'),
                    'id': link.attr('data-id'),
                    'idHash': link.attr('data-idHash'),
                    'action': 'report'
                }, dataType: 'xml', success: function (rsp){
                    link.parent().find('.message').remove();
                    if($(rsp).find('status').text() == 'success'){
                        link.after('<p class="message success">' + $(rsp).find('message').text() + "</p>");
                        link.remove();
                    }else{
                        link.after('<p class="message error">' + $(rsp).find('message').text() + "</p>");
                        link.html('Report');
                    }
                }, error: function (rsp){
                    link.parent().find('.message').remove();
                    link.after('<p class="message error">' + rsp.responseText + "</p>");
                    link.html('Report');
                }
            });
        }

        return false;
    })

    //Process Ajax Actions
    $('body').on('click', 'a[data-type="buckys-ajax-link"]', function (){
        var oLink = $(this);
        var oldText = oLink.html();

        oLink.html('<img src="/images/loading1.gif" />');

        $.ajax({
            type: 'get', url: oLink.attr('href') + '&buckys_ajax=1', dataType: 'xml', success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    oLink.html($(rsp).find('html').text());
                    oLink.attr('href', $(rsp).find('link').text());

                    //Process Extra Action
                    if(typeof (buckys_ajax_action_success) != 'undefined'){
                        buckys_ajax_action_success(oLink);
                    }else{
                        if($(rsp).find('action').text()){
                            switch($(rsp).find('action').text()){
                                case 'send-friend-request':
                                case 'delete-friend-request':
                                case 'unfriend':
                                    break;
                                case 'accept-friend-request':
                                case 'decline-friend-request':
                                    oLink.parent().find('a, br:gt(0)').not(oLink).fadeOut('fast', function (){
                                        $(this).remove()
                                    });
                                    break;
                            }
                        }
                    }
                }else{
                    oLink.html(oldText);
                    alert($(rsp).find('message').text());
                }
            }, error: function (err){
                alert(err.responseText);
            }
        })

        return false;
    })

    jQuery.fn.selectText = function (){
        var doc = document;
        var element = this[0];

        if(doc.body.createTextRange){
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        }else
            if(window.getSelection){
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }
    };


    $(".onclick-select-all").click(function (){
        $(this).selectText();
    });


    $(document).ready(function (){
        $('#fixed_footer .notificationLinks').click(function (){
            var currentNode = $(this);
            var currentDropdownShown;

            $('#fixed_footer .notificationLinks').each(function (){
                if(currentNode.attr('id') != $(this).attr('id')){
                    if($(this).find('.dropDownNotificationList').is(':visible')){
                        $(this).find('.dropDownNotificationList').hide();
                        loadReadNotification($(this));
                    }
                }
            });


            //Toggle
            $(this).find('.dropDownNotificationList').toggle();
            currentDropdownShown = $(this).find('.dropDownNotificationList').is(':visible');

            //Lit up / fade out

            /*if ($('#my-notifications-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }
             if ($('#friend-notifications-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }
             if ($('#forum-notifications-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }
             if ($('#emails-notifications-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }
             if ($('#trade-notify-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }
             if ($('#shop-notify-icon').find('.dropDownNotificationList').is(':visible')) { currentNode.removeClass('inactive-notify'); } else {currentNode.addClass('inactive-notify'); }*/


            if(!currentDropdownShown){
                loadReadNotification(currentNode);
            }else{
                currentNode.removeClass('inactive-notify');
            }


        });
    });


    function loadReadNotification(targetObj){
        var actionType = '';
        //Get latest 5 notifications
        switch(targetObj.attr("id")){
            case 'my-notifications-icon':

                //Fadeout first
                targetObj.addClass('inactive-notify');

                if(!targetObj.hasClass('load-read-notification')){
                    targetObj.addClass('load-read-notification');
                    //Load read-notification
                    targetObj.find('.notification-count').html('0');
                    actionType = 'my';
                }

                break;

            case 'friend-notifications-icon':

                if(targetObj.hasClass('no-data')){
                    targetObj.addClass('inactive-notify');
                }
                //Do Nothing
                break;

            case 'forum-notifications-icon':

                //Fadeout first
                targetObj.addClass('inactive-notify');

                if(!targetObj.hasClass('load-read-notification')){
                    targetObj.addClass('load-read-notification');
                    //Load read-notification
                    actionType = 'forum';
                }

                break;

            case 'emails-notifications-icon':
                if(targetObj.hasClass('no-data')){
                    targetObj.addClass('inactive-notify');
                }
                //Do Nothing
                break;

            case 'trade-notify-icon':
                //Fadeout first
                targetObj.addClass('inactive-notify');

                if(!targetObj.hasClass('load-read-notification')){
                    targetObj.addClass('load-read-notification');
                    //Load read-notification
                    actionType = 'trade';
                }

                break;

            case 'shop-notify-icon':
                //Fadeout first
                targetObj.addClass('inactive-notify');

                if(!targetObj.hasClass('load-read-notification')){
                    targetObj.addClass('load-read-notification');
                    //Load read-notification
                    actionType = 'shop';
                }

                break;

        }


        if(actionType != ''){
            $.ajax({
                url: '/notification_object.php', type: 'post', data: {
                    'type': actionType, 'action': 'read'
                }, success: function (rsp){
                    var responseObj = $.parseJSON(rsp);
                    if(responseObj.success == 1){
                        targetObj.find('.dropDownNotificationList').html(responseObj.content);
                    }
                }
            });
        }

    }


    $(document).ready(function (){
        if(window.location.hash == '#bottom'){
            window.scrollTo(0, document.body.scrollHeight);
        }
    });


    /*$(document).on('click', document, function() {
     $('#fixed_footer .notificationLinks .dropDownNotificationList').hide();
     });*/


})(jQuery)