(function ($){
    var privateMessengerTimer = null;
    var stopMessengerTimer = false;

    $(document).ready(function (){

        //Programs -> Private Messenger 
        $('#private_messenger_nav').click(function (){
            if($('#footer_menu li#private_messenger_li').size() == 0){
                $('#footer_menu li#lft-last-li').before('<li id="private_messenger_li" class="has-submenu"><a href="#" class="privateMessengerButtonText">Private Messenger</a></li>');
                openPrivateMessenger();
            }
            //Hide Opened Menu on the footer menu
            $('#footer_menu li.hover').removeClass('hover');
            return false;
        });

        //Load Private Messenger
        if($('#footer_menu li#private_messenger_li').size() > 0){
            openPrivateMessenger();
        }

        //Init Private Messenger Settings
        if($('#messenger_settings_wrapper').size() > 0){
            initPrivateMessengerSettingsForm();
        }

        //Resize Private Messenger
        $(window).resize(function (){
            resizePrivateMessenger();
        })

        //Private Messenger Update Timer
        privateMessengerTimer = setTimeout(updatePrivateMessenger, 3000);
    })

    function openPrivateMessenger(){
        //Open/Hide Private Messenger By clicking Private Messenger Menu on the footer
        $('#footer_menu #private_messenger_li > a').click(function (){
            if($('#private_messenger_main_wrap').size() > 0) //If the private messenger has already been opened,
            {
                $(this).parent().toggleClass('active');
                if($(this).parent().hasClass('active')){
                    resizePrivateMessenger();
                    $('#footer_menu #private_messenger_li #total-new-msg-count').hide();
                    $('#footer_menu #private_messenger_li #messenger_minimized').hide();
                    if($('#private_messenger_conversation_wrap .private_messenger_conversation_contr').size() > 0)
                        $('#private_messenger_conversation_wrap').show();
                }else{
                    $('#private_messenger_li #total-new-msg-count').show();
                    $('#footer_menu #private_messenger_li #messenger_minimized').hide();
                }
            }else{ //If the messenger has not opened yet, Load it
                loadPrivateMessenger();
            }
            return false;
        })
    }

    //Load Private Messenger
    function loadPrivateMessenger(){
        //To prevent multi-clicks
        if($('#footer_menu li#private_messenger_li').hasClass('loading'))
            return false;

        //Add loading message
        $('#footer_menu li#private_messenger_li').addClass('loading');

        //Getting Private Messenger Using Ajax
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=load-messenger',
            type: 'post',
            dataType: 'html',
            success: function (rsp){
                //Remove Old things to prevent the messenger adding twice
                $('#private_messenger_main_wrap').remove();
                $('#private_messenger_conversation_wrap').remove();
                //Add Messenger Buddy List
                $('#footer_menu li#private_messenger_li').append(rsp);

                //Show Private Messenger
                $('#footer_menu li#private_messenger_li').addClass('active');

                //Remove New Message Count                
                $('#footer_menu li#private_messenger_li #total-new-msg-count').remove();

                //Init Minimize Icon of Private Messenger Main Wrap
                /*$('#private_messenger_main_wrap .minimize_box_link').click(function(){
                 $('#footer_menu li#private_messenger_li > a').click();
                 })*/
                //Init Close Icon of Private Messenger Main Wrap
                $('#private_messenger_main_wrap .close_box_link').click(function (){
                    //                    closePrivateMessenger();
                    $('#footer_menu li#private_messenger_li > a').click();
                })

                //Close Messenger Conversation Box
                $('#private_messenger_conversation_wrap .close_box_link').click(function (){
                    closeAllMessengerConversationWrap();
                    return false;
                })
                //Minimize Messenger Conversation Box
                $('#private_messenger_conversation_wrap .minimize_box_link').click(function (){
                    $('#private_messenger_conversation_wrap').hide();
                    $('#footer_menu #private_messenger_li #messenger_minimized').show();
                    return false;
                })
                //Maximize Messenger Conversation Box
                $('#footer_menu #private_messenger_li #messenger_minimized').click(function (){
                    $('#private_messenger_conversation_wrap').show();
                    $('#footer_menu #private_messenger_li #total-new-msg-count').hide();
                    $('#footer_menu #private_messenger_li #messenger_minimized').hide();
                    return false;
                })

                //Show Settings Box
                $('#settings_messenger_btn').click(function (){
                    $('#messenger_settings_wrapper').show();
                    $('#messenger_settings_wrapper #messenger_settings_box').fadeIn();
                })

                //Show Conversation Box
                $('#private_messenger_buddies_list').on('click', 'a', function (){
                    openConversationWindow($(this).attr('data-id'), $(this).attr('data-hash'));
                })

                //Change Conversation Window
                $('#private_messenger_opened_chats').on('click', 'a', function (e){
                    if(!$(this).hasClass('actived')){
                        changeConversationWindow($(this).attr('data-id'));
                    }
                    e.stopPropagation();
                })

                //Close Conversation Button
                $('#private_messenger_opened_chats').on('click', '.close-conversation', function (e){
                    closeConversationWindow($(this).parent().attr('data-id'), $(this).parent().attr('data-encrypted'));
                    e.stopPropagation();
                })


                //Init Right Menu on the Buddy list
                initRightMenuForBuddylist();

                //Init Send Message Form
                initSendMessageForm();

                //Init Options Menu
                initOptionsMenu();

                //Init Add user to buddy list form
                initAddUserToBuddylistForm();

                //Resize Messenger BuddyList
                resizePrivateMessenger();
                if($('#private_messenger_conversation_wrap .private_messenger_conversation_contr:visible').size() > 0){
                    $('#private_messenger_conversation_wrap .private_messenger_conversation_contr:visible').scrollTop($('#private_messenger_conversation_wrap .private_messenger_conversation_contr:visible')[0].scrollHeight);
                    $('#new_private_message').focus();
                }
            },
            complete: function (){
                $('#footer_menu li#private_messenger_li').removeClass('loading');
            }
        });
    }

    //Close Messenger
    function closePrivateMessenger(){
        //Send Ajax Request
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=close-messenger',
            type: 'post',
            dataType: 'html',
            success: function (rsp){
                $('#footer_menu li#private_messenger_li').remove();
                if(privateMessengerTimer != null)
                    clearTimeout(privateMessengerTimer);
            },
            error: function (err){

            }
        })
    }

    //Close All coversations Wrap
    function closeAllMessengerConversationWrap(){
        //Send Ajax Request
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=close-all-conversation',
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                $('#private_messenger_opened_chats a').remove();
                $('#private_messenger_conversation_wrap .private_messenger_conversation_contr').remove();
                $('#private_messenger_conversation_wrap').hide();
            },
            error: function (err){

            }
        })
    }

    //Minimize Private Messenger Conversation Wrap
    function minimizeMessengerConversationWrap(){
        $('#private_messenger_conversation_wrap').hide();
        $('#footer_menu #private_messenger_li #messenger_minimized').show();
    }

    //Maximize Private Messenger Conversation Wrap
    function maximizeMessengerConversationWrap(){
        $('#private_messenger_conversation_wrap').show();
        $('#footer_menu #private_messenger_li #total-new-msg-count').hide();
        $('#footer_menu #private_messenger_li #messenger_minimized').hide();
    }

    //Function Right Menu 
    function initRightMenuForBuddylist(){
        $.contextMenu({
            selector: '#private_messenger_buddies_list a.single_chat_user', callback: function (key, options){
                var sObj = $('#private_messenger_buddies_list a.single_chat_user_hover');
                if(key == 'block'){
                    //Block user
                    blockUser(sObj.attr('data-id'), sObj.attr('data-hash'));
                }else
                    if(key == 'delete'){
                        //Delete Buddy
                        removeBuddy(sObj.attr('data-id'), sObj.attr('data-hash'));
                    }else
                        if(key == 'profile'){
                            window.open('/profile.php?user=' + sObj.attr('data-id'), '_blank');
                        }
            }, items: {
                'profile': {name: 'View'}, 'delete': {name: 'Delete'}/*,
                 'block': {name: 'Block'}*/
            }
        });
        $('#private_messenger_buddies_list').on('mouseover', 'a', function (){
            $('#private_messenger_buddies_list .single_chat_user_hover').removeClass('single_chat_user_hover');
            $(this).addClass('single_chat_user_hover');
        });
        $('#private_messenger_buddies_list').on('contextmenu', 'a', function (){
            $('#private_messenger_buddies_list .single_chat_user_hover').removeClass('single_chat_user_hover');
            $(this).addClass('single_chat_user_hover');
        })
    }

    //Add user to buddylist form
    function initAddUserToBuddylistForm(){
        $('#adduserform').submit(function (){
            if(!$('#add-user-to-buddylist-input').hasClass('ui-autocomplete-loading') && $('#add-user-to-buddylist-inputholder span.name').size() > 0){
                $('#add-user-to-buddylist-input').addClass('ui-autocomplete-loading')
                $.ajax({
                    url: "/private_messenger.php",
                    data: $('#adduserform').serialize() + '&action=add-user-to-buddylist',
                    type: 'post',
                    dataType: 'xml',
                    success: function (rsp){
                        if($(rsp).find('status').text() == 'error'){
                            showMessage($('#adduserform'), $(rsp).find('message').text(), true);
                            hideMessage($('#adduserform'), 3);
                        }else{
                            $('#add-user-to-buddylist-inputholder span.name').remove();
                            $('#private_messenger_buddies_list').html($(rsp).find('html').text());
                        }
                    },
                    error: function (err){

                    },
                    complete: function (){
                        $('#add-user-to-buddylist-input').removeClass('ui-autocomplete-loading');
                    }
                });
            }
            $('#')
            return false;
        })

        //Use autocomplete for add buddy list form
        $('#add-user-to-buddylist-input').click(function (){
            $('#add-user-to-buddylist-inputholder span.name').remove();
        })
        $('#add-user-to-buddylist-input').autocomplete({
            appendTo: '#add-user-to-buddylist', source: function (request, response){
                $.ajax({
                    url: '/private_messenger.php',
                    data: {term: request.term, action: 'get-users'},
                    dataType: 'json',
                    type: 'post',
                    success: response
                })
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
                $('#add-user-to-buddylist-inputholder').append('<span class="name">' + ui.item.label + ' <a href="#">x</a><input type="hidden" name="added-id" value="' + ui.item.id + '" /><input type="hidden" name="added-id-hash" value="' + ui.item.hash + '" /></span>');
                $('#add-user-to-buddylist-inputholder').find('.name a').click(function (){
                    $(this).parent().remove();
                })
                $('body').click();
                return false;
            }, close: function (){
                $('#add-user-to-buddylist-input').val('');
            }
        });
    }

    function initOptionsMenu(){
        $('#private-messenger-options-link').click(function (){
            $(this).toggleClass('options_link_active');
        });
        $('#pm-box-clear-history-link').click(function (){
            if($('#private_messenger_opened_chats a.actived').size() == 1){
                clearChatHistory($('#private_messenger_opened_chats a.actived').attr('data-id'), $('#private_messenger_opened_chats a.actived').attr('data-encrypted'));
            }
            $('#private-messenger-options-link').removeClass('options_link_active');
            return false;
        })
        $('#pm-box-block-user-link').click(function (){
            if($('#private_messenger_opened_chats a.actived').size() == 1){
                blockUser($('#private_messenger_opened_chats a.actived').attr('data-id'), $('#private_messenger_opened_chats a.actived').attr('data-encrypted'));
            }
            $('#private-messenger-options-link').removeClass('options_link_active');
            return false;
        })
    }

    //Clear chat history
    function clearChatHistory(userID, idHash){
        $.ajax({
            url: '/private_messenger.php',
            data: 'userID=' + userID + '&idHash=' + idHash + '&action=clear-history',
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($(rsp).find('status').text() == 'success')
                    $('#private_messenger_conversation_contr' + userID).html('');
            }
        })
    }

    //Block User
    function blockUser(userID, idHash){
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=block-user&blockedID=' + userID + '&blockedIDHash=' + idHash,
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    $('#block_list').append('<li data-id="' + $(rsp).find('id').text() + '"><img src="' + $(rsp).find('icon').text() + '" /> ' + $(rsp).find('name').text() + '</li>');
                    $('#private_messenger_buddies_list a[data-id="' + userID + '"]').remove();
                    _closeConversationWindow(userID);
                }
            }
        })
    }

    //Remove User From the buddylist
    function removeBuddy(userID, idHash){
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=remove-user&userID=' + userID + '&userIDHash=' + idHash,
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    if($(rsp).find('type').text() == 'block')
                        $('#block_list').append('<li data-id="' + $(rsp).find('id').text() + '"><img src="' + $(rsp).find('icon').text() + '" /> ' + $(rsp).find('name').text() + '</li>');
                    $('#private_messenger_buddies_list a[data-id="' + userID + '"]').remove();
                    _closeConversationWindow(userID);
                }
            }
        })
    }


    //Send Message
    function initSendMessageForm(){
        $('#newmessageform').submit(function (){
            //Getting Selected user id and encrypted data
            if($('#private_messenger_opened_chats a.actived').size() > 0 && $.trim($('#newmessageform #new_private_message').val()) != ''){
                var link = $('#private_messenger_opened_chats a.actived');
                var receiverID = link.attr('data-id');
                var receiverIDEncrypted = link.attr('data-encrypted');
                var message = $('#newmessageform #new_private_message').val();
                $('#newmessageform #new_private_message').val('');
                //Send Ajax Request
                $.ajax({
                    url: '/private_messenger.php', data: {
                        'action': 'send-message',
                        'message': message,
                        'userID': receiverID,
                        'encrypted': receiverIDEncrypted
                    }, type: 'post', dataType: 'xml', success: function (rsp){
                        if($(rsp).find('status').text() == 'success'){
                            $('#private_messenger_conversation_contr' + receiverID).append($(rsp).find('message').text());
                            //Scroll Down
                            $('#private_messenger_conversation_contr' + receiverID).scrollTop($('#private_messenger_conversation_contr' + receiverID)[0].scrollHeight)
                        }else{
                            if($(rsp).find('message').text() == 'blocked' || $(rsp).find('message').text() == 'not_improved' || $(rsp).find('message').text() == 'offline')
                                showMessage($('#newmessageform'), 'Your message was not sent because the user is offline.', true);else
                                showMessage($('#newmessageform'), $(rsp).find('message').text(), true);
                            hideMessage($('#newmessageform'), 2);
                        }
                    }, error: function (rsp){
                        showMessage($('#newmessageform'), rsp.responseText, true);
                        hideMessage($('#newmessageform'), 2);
                    }
                })
            }
            return false;
        })
    }

    //Switch Conversation Window
    function changeConversationWindow(userID){
        $('#private_messenger_opened_chats a[data-id="' + userID + '"]').stop().css('backgroundColor', 'transparent');
        $('#private_messenger_opened_chats a.actived').removeClass('actived');
        $('#private_messenger_opened_chats a[data-id="' + userID + '"]').addClass('actived');
        $('#private_messenger_opened_chats a.actived .new-msg-count').remove();
        $('#private_messenger_opened_chats a[data-id="' + userID + '"] .new-msg-count').remove();
        $('.private_messenger_conversation_contr:visible').hide();
        $('#private_messenger_conversation_contr' + userID).show();
        $('#private_messenger_conversation_contr' + userID).scrollTop($('#private_messenger_conversation_contr' + userID)[0].scrollHeight)
        $('#new_private_message').focus();
    }

    //Show Conversation Box and add New user to conversation list
    function openConversationWindow(userID, idHash){
        //Send Ajax Request
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=open-conversation&userID=' + userID + '&idHash=' + idHash,
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    //Add the user to conversation list
                    $('#private_messenger_conversation_rgt .private_messenger_conversation_contr').hide();
                    $('#private_messenger_send_message_contr').before('<div class="private_messenger_conversation_contr" id="private_messenger_conversation_contr' + $(rsp).find('id').text() + '">' + $(rsp).find('content').text() + '</div>');
                    $('#private_messenger_opened_chats a.actived').removeClass('actived');
                    $('#private_messenger_opened_chats').append('<a href="#" class="actived" data-id="' + $(rsp).find('id').text() + '" data-encrypted="' + $(rsp).find('encrypted').text() + '">' + $(rsp).find('name').text() + '<span class="close-conversation">X</span></a>');
                    $('#private_messenger_buddies_list a[data-id="' + userID + '"] .new-msg-count').remove();
                    if($('#private_messenger_conversation_wrap:visible').size() < 1){
                        $('#private_messenger_conversation_wrap').show();
                    }
                    $('#new_private_message').focus();
                    resizePrivateMessenger();
                }else
                    if($(rsp).find('status').text() == 'exist'){
                        changeConversationWindow(userID);
                    }else{ //Error

                    }
            },
            error: function (err){

            }
        })
        if($('#private_messenger_conversation_rgt:visible').size() < 1){
            //Show Messenger Conversation List
            $('#private_messenger_conversation_rgt').show();
        }


        //Add the new to conversation list

    }

    //Close Conversation Window
    function closeConversationWindow(userID, idHash){
        //Send Ajax Request
        $.ajax({
            url: '/private_messenger.php',
            data: 'action=close-conversation&userID=' + userID + '&idHash=' + idHash,
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($(rsp).find('status').text() == 'success'){
                    _closeConversationWindow(userID);
                }
            },
            error: function (err){

            }
        })
    }

    //Close the user to conversation list
    function _closeConversationWindow(userID){
        $('#private_messenger_conversation_contr' + userID).remove();
        $('#private_messenger_opened_chats a[data-id="' + userID + '"]').remove();
        if($('.private_messenger_conversation_contr').size() < 1){
            $('#private_messenger_conversation_wrap').hide()
        }else
            if($('.private_messenger_conversation_contr:visible').size() < 1){
                //Show First Conversation List
                $('#private_messenger_opened_chats a:eq(0)').addClass('actived');
                $('#private_messenger_conversation_contr' + $('#private_messenger_opened_chats a.actived').attr('data-id')).show();
                $('#new_private_message').focus();
            }
    }

    function resizePrivateMessenger(){
        //Resize Messenger Buddy List
        var totalHeight = $(window).height() - $('#fixed_footer').height();

        var topMargin = 100; //Space between 
        var padding = 6;
        var headerHeight = $('#private_messenger_main_wrap h2').outerHeight();
        var buddyListPadding = 5 + 1 + 5; //Padding: 5px; Border: 1px; Margin: 5px;        
        var addBuddyBoxHeight = $('#add-user-to-buddylist').outerHeight(true); //Including Margin
        var messengerBtnBoxHeight = $('#private_messenger_main_wrap #messenger_btn_box').outerHeight(true); //Including Margin

        buddyListHeight = totalHeight - topMargin - padding * 2 - headerHeight - addBuddyBoxHeight - buddyListPadding * 2 - messengerBtnBoxHeight;

        if(buddyListHeight < 200){
            topMargin = 10;
            buddyListHeight += 90;
        }
        /*else if(buddyListHeight > 400){

         }
         */

        $('#private_messenger_buddies_list').height(buddyListHeight);

        //Resize Messenger Conversation List        
        var messengerConvWrapOptionsBoxHeight = $('#private_messenger_conversation_wrap .box_nav_row').height();
        $('.private_messenger_conversation_contr').height(totalHeight - topMargin - messengerConvWrapOptionsBoxHeight - 22 - 22 - $('#private_messenger_send_message_contr').outerHeight());
        $('#private_messenger_opened_chats').css('max-height', totalHeight - topMargin - 20 - 22 - 22);
    }

    /***************************************************************************************************
     Private Messenger Settings
     ***************************************************************************************************/

    //Update Private Messenger Settings
    function updatePrivateMessengerSettings(){
        $('#messenger_settings_form .loading-wrapper').show();
        $.ajax({
            url: '/private_messenger.php',
            data: $('#messenger_settings_form').serialize() + '&action=save-settings',
            type: 'post',
            dataType: 'xml',
            success: function (rsp){
                if($('#messenger_privacy_all').prop('checked'))
                    $('#add-user-to-buddylist').addClass('add-user-to-buddylist-hidden');else
                    $('#add-user-to-buddylist').removeClass('add-user-to-buddylist-hidden');
                $('#private_messenger_buddies_list').html($(rsp).find('html').text());
            },
            complete: function (){
                $('#messenger_settings_form .loading-wrapper').hide();
            }
        })
    }

    function initPrivateMessengerSettingsForm(){
        $('#messenger_settings_box input[type="checkbox"], #messenger_settings_box input[type="radio"]').change(function (){
            updatePrivateMessengerSettings();
        });

        $('#messenger_settings_box .close_box_link').click(function (){
            $('#messenger_settings_box').fadeOut(function (){
                $('#messenger_settings_wrapper').hide();
            })
            return false;
        })
        //AutoComplete for Block User
        $('#block-username').autocomplete({
            appendTo: '#messenger_settings_wrapper', source: function (request, response){
                $.ajax({
                    url: '/private_messenger.php',
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
                //Remove Previous Item
                $('#blocked-users #blocked_id').remove();
                $('#blocked-users #blocked_id_hash').remove();
                //Add New Item
                $('#blocked-users').append('<input type="hidden" id="blocked_id" value="' + ui.item.id + '" />');
                $('#blocked-users').append('<input type="hidden" id="blocked_id_hash" value="' + ui.item.hash + '" />');
                $('#blocked-users #block-username').val(ui.item.value);
                return false;
            }, close: function (){
                //                $('#blocked-users #block-username').val('');
            }
        });


        //Add Blockers
        $('#messenger_settings_form').submit(function (){
            if($('#messenger_settings_form #blocked_id').size() < 1){
                return false;
            }
            $('#messenger_settings_form .loading-wrapper').show();
            $.ajax({
                url: '/private_messenger.php',
                data: 'action=block-user&blockedID=' + $('#blocked_id').val() + '&blockedIDHash=' + $('#blocked_id_hash').val(),
                type: 'post',
                dataType: 'xml',
                success: function (rsp){
                    if($(rsp).find('status').text() == 'success'){
                        $('#block_list').append('<li data-id="' + $(rsp).find('id').text() + '"><img src="' + $(rsp).find('icon').text() + '" /> ' + $(rsp).find('name').text() + '</li>');
                        $('#block-username').val('');
                        $('#messenger_settings_form #blocked_id').remove();
                        $('#messenger_settings_form #blocked_id_hash').remove();
                        $('#private_messenger_buddies_list').html($(rsp).find('html').text());
                        //Remove Opened Users
                        $('#private_messenger_buddies_list a[data-id="' + $(rsp).find('id').text() + '"]').remove();
                        _closeConversationWindow($(rsp).find('id').text());
                    }else{
                        showMessage($('#messenger_settings_form'), $(rsp).find('message').text(), true);
                        hideMessage($('#messenger_settings_form'), 3);

                    }
                    $('#messenger_settings_form .loading-wrapper').hide();
                },
                error: function (err){
                    showMessage($('#messenger_settings_form'), err.responseText, true);
                    hideMessage($('#messenger_settings_form'), 3);
                    $('#messenger_settings_form .loading-wrapper').hide();
                }
            })
            return false;
        })

        //Remove Blockers
        $('#block_list').on('click', 'li', function (){
            $(this).toggleClass('selected');
        })

        $('#messenger_settings_form .remove-from-blocklist').click(function (){
            if($('#block_list li.selected').size() < 1){
                alert('Please select users that you want to unblock');
            }else{
                //Getting Ids
                var ids = '';
                $('#block_list li.selected').each(function (){
                    ids += '&id[]=' + $(this).attr('data-id');
                })
                $('#messenger_settings_form .loading-wrapper').show();
                $.ajax({
                    url: '/private_messenger.php',
                    data: 'action=unblock-user&1=1' + ids,
                    type: 'post',
                    dataType: 'xml',
                    success: function (rsp){
                        if($(rsp).find('status').text() == 'success'){
                            $('#block_list li.selected').fadeOut(function (){
                                $(this).remove();
                            });
                            $('#private_messenger_buddies_list').html($(rsp).find('html').text());
                        }else{
                            showMessage($('#messenger_settings_form'), $(rsp).find('message').text(), true);
                            hideMessage($('#messenger_settings_form'), 3);

                        }
                        $('#messenger_settings_form .loading-wrapper').hide();
                    },
                    error: function (err){
                        showMessage($('#messenger_settings_form'), err.responseText, true);
                        hideMessage($('#messenger_settings_form'), 3);
                        $('#messenger_settings_form .loading-wrapper').hide();
                    }
                })
                return false;
            }
            return false;
        })

    }


    /***************************************************************************************************
     Update Private Messenger By real time
     ***************************************************************************************************/
    var updatePrivateMessenger = function (){
        var messengerStatus = 'closed';
        if($('#footer_menu #private_messenger_main_wrap').size() > 0)
            messengerStatus = 'opened';

        $.ajax({
            url: '/private_messenger.php',
            data: 'action=update-messenger&status=' + messengerStatus,
            type: 'post',
            dataType: 'xml',
            success: function (rsp){

                if(messengerStatus == 'closed'){
                    $('#private_messenger_li #total-new-msg-count').remove();
                    if(parseInt($(rsp).find('newmessages').text()) > 0){
                        $('#private_messenger_li').append('<span id="total-new-msg-count" class="new-msg-count">' + $(rsp).find('newmessages').text() + '</span>');
                        //                        shakeNewMessageCountSpan($('#private_messenger_li #total-new-msg-count'));
                    }
                }else{
                    //Update Messenger User List
                    $('#private_messenger_buddies_list').html($(rsp).find('users').text());

                    var totalNewMsgCount = 0;

                    //Update Messages
                    $(rsp).find('message').each(function (){
                        var id = $(this).attr('id');

                        if($('#private_messenger_conversation_contr' + id).size() > 0){ //If already opened, update the conversation contr
                            $('#private_messenger_conversation_contr' + id).append($(this).text());
                        }else{ //If it is not opened, open it.
                            $('#private_messenger_send_message_contr').before('<div class="private_messenger_conversation_contr" id="private_messenger_conversation_contr' + id + '" style="display: none">' + $(this).text() + '</div>');
                            $('#private_messenger_opened_chats').append('<a href="#" data-id="' + id + '" data-encrypted="' + $(this).attr('encrypted') + '">' + $(this).attr('name') + '<span class="close-conversation">X</span></a>');

                            if($('#private_messenger_conversation_wrap:visible').size() < 1){
                                $('#private_messenger_conversation_wrap').show();
                                $('#private_messenger_conversation_contr' + id).show();
                                $('#private_messenger_opened_chats a[data-id="' + id + '"]').addClass('actived');
                            }
                            resizePrivateMessenger();
                        }

                        //Scroll down
                        if($('#private_messenger_opened_chats a[data-id="' + id + '"]').hasClass('actived')){
                            $('#private_messenger_conversation_contr' + id).scrollTop($('#private_messenger_conversation_contr' + id)[0].scrollHeight);
                        }else{
                            //Show New Message Count
                            var newMsgCount = 0;
                            if($('#private_messenger_opened_chats a[data-id="' + id + '"] .new-msg-count').size() > 0)
                                newMsgCount = parseInt($('#private_messenger_opened_chats a[data-id="' + id + '"] .new-msg-count').html());
                            newMsgCount += parseInt($(this).attr('count'));
                            //Update New Message Count
                            $('#private_messenger_opened_chats a[data-id="' + id + '"] .new-msg-count').remove();
                            if(newMsgCount > 0){
                                $('#private_messenger_opened_chats a[data-id="' + id + '"]').append('<span class="new-msg-count">' + newMsgCount + '</span>');
                                shakeNewMessageCountSpan($('#private_messenger_opened_chats a[data-id="' + id + '"] .new-msg-count'));
                            }
                            totalNewMsgCount += newMsgCount;
                        }
                    })
                }
            },
            complete: function (){
                privateMessengerTimer = setTimeout(updatePrivateMessenger, 3000);
            }
        })
    }
})(jQuery)


function shakeNewMessageCountSpan(obj){
    $(obj).stop().effect("shake", {times: 5, direction: 'up', distance: 3}, 1500);
}