(function ($){

    //Save Basic Information
    $('#basicform').submit(function (){
        var isCompleted = true;
        var form = $(this);
        //form.find('.input, .select').each(function(){
        //            if(this.value == '')
        //            {
        //                isCompleted = false;
        //                $(this).addClass($(this).hasClass('input') ? 'input-error' : 'select-error');
        //            }
        //        })
        if(($('#birthdate_month').val() != '' || $('#birthdate_day').val() != '' || $('#birthdate_year').val() != '') && ($('#birthdate_month').val() == '' || $('#birthdate_day').val() == '' || $('#birthdate_year').val() == '')){
            if($('#birthdate_month').val() == '')
                $('#birthdate_month').addClass('select-error');
            if($('#birthdate_year').val() == '')
                $('#birthdate_year').addClass('select-error');
            if($('#birthdate_day').val() == '')
                $('#birthdate_day').addClass('select-error');

        }
        //if(isCompleted || confirm("Some fields are empty. Are you sure to save your information without them?"))
        //        {
        form.find('.loading-wrapper').show();
        //Save User Basic Information Using ajax

        $.ajax({
            url: "/info_basic.php",
            data: form.serialize() + "&action=save_basic_info",
            type: "post",
            success: function (rsp){
                if(rsp == 'Success'){
                    showMessage(form, 'Your Basic Information has been updated successfully!', false);
                }else{
                    showMessage(form, rsp, true);
                }
                form.find('.input-error').removeClass('input-error');
                form.find('.select-error').removeClass('select-error');
                form.find('.loading-wrapper').hide();
            },
            error: function (err){
                showMessage(this, err.responseText, true);
                form.find('.loading-wrapper').hide();
            }
        })
        //        }
        return false;
    })

    $('.user-info .add-new-row').click(function (){
        var newRow = $('<div class="row">' + $('#' + $(this).attr('data-new-row')).html() + '</div>');

        var idx = $(this).parents('form').find('.row').size();

        newRow.children('label').html($(this).attr('data-label') + ":");
        //        newRow.children('label').html($(this).attr('data-label') + (idx + 1) + ":");
        newRow.find('.visibility_options label:eq(0)').attr('for', $(this).attr('data-id') + '_visibility' + idx + '_public');
        newRow.find('.visibility_options label:eq(0) input').attr({
            'id': $(this).attr('data-id') + '_visibility' + idx + '_public',
            'name': $(this).attr('data-id') + '_visibility' + idx
        });
        newRow.find('.visibility_options label:eq(1)').attr('for', $(this).attr('data-id') + '_visibility' + idx + '_private');
        newRow.find('.visibility_options label:eq(1) input').attr({
            'id': $(this).attr('data-id') + '_visibility' + idx + '_private',
            'name': $(this).attr('data-id') + '_visibility' + idx
        });
        $(this).parents('form').find('.btn-row').before(newRow);
    });
    $(document).on('click', '.row .remove-row', function (){
        var tFormId = $(this).parents('form').attr('id');
        var tLabel = $(this).attr('data-label');
        var tId = $(this).attr('data-id');
        $(this).parents('.row').remove();
        reindexVisibilityOptionsNames(tFormId, tLabel, tId);
        return false;
    })

    //Re-index the visibility options for the Messenger Account Names
    function reindexVisibilityOptionsNames(formId, label, prefix){
        $('#' + formId).find('.row').each(function (idx){
            $(this).children('label').html(label + ":");
            //            $(this).children('label').html(label + (idx + 1) + ":");
            $(this).find('.visibility_options label:eq(0)').attr('for', prefix + '_visibility' + idx + '_public');
            $(this).find('.visibility_options label:eq(0) input').attr({
                'id': prefix + '_visibility' + idx + '_public', 'name': prefix + 'visibility' + idx
            });
            $(this).find('.visibility_options label:eq(1)').attr('for', prefix + '_visibility' + idx + '_private');
            $(this).find('.visibility_options label:eq(1) input').attr({
                'id': prefix + '_visibility' + idx + '_private', 'name': prefix + 'visibility' + idx
            });
        })
    }

    //Update User Mail Email
    $('#emailform').submit(function (){
        var form = $(this);
        var filter = /^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
        //Check Email has value
        /* if(form.find('#email').val() == '')
         {
         form.find('#email').addClass('input-error');
         showMessage(form, 'Please input your primary e-mail address.', true);
         return false;
         }*/
        //Check Email Validation
        /* if(!filter.test(form.find('#email').val()))
         {
         $(this).find('#email').addClass('input-error');
         showMessage(form, 'Please input a valid e-mail address', true);
         return false;
         }
         */
        //Save Primary Email Address
        form.find('.loading-wrapper').show();
        //Save User Basic Information Using ajax

        $.ajax({
            url: "/info_contact.php",
            data: form.serialize() + "&action=save_email",
            type: "post",
            success: function (rsp){
                if(rsp == 'Success'){
                    showMessage(form, 'Your E-mail privacy has been updated successfully!', false);
                }else{
                    showMessage(form, rsp, true);
                }
                form.find('.loading-wrapper').hide();
            },
            error: function (err){
                showMessage(form, err.responseText, true);
                form.find('.loading-wrapper').hide();
            }
        })
        return false;
    })

    //Update User Phone
    $('#phoneform').submit(function (){
        var form = $(this);

        //Save Primary Email Address
        form.find('.loading-wrapper').show();
        //Save User Basic Information Using ajax

        $.ajax({
            url: "/info_contact.php",
            data: form.serialize() + "&action=save_phone",
            type: "post",
            success: function (rsp){
                if(rsp == 'Success'){
                    showMessage(form, 'Your phone numbers have been saved successfully!', false);
                }else{
                    showMessage(form, rsp, true);
                }
                form.find('.loading-wrapper').hide();
            },
            error: function (err){
                showMessage(form, err.responseText, true);
                form.find('.loading-wrapper').hide();
            }
        })
        return false;
    })

    //Update User Address
    $('#addressform').submit(function (){
        var form = $(this);

        //Save Primary Email Address
        form.find('.loading-wrapper').show();
        //Save User Basic Information Using ajax

        $.ajax({
            url: "/info_contact.php",
            data: form.serialize() + "&action=save_address",
            type: "post",
            success: function (rsp){
                if(rsp == 'Success'){
                    showMessage(form, 'Your address has been saved successfully!', false);
                }else{
                    showMessage(form, rsp, true);
                }
                form.find('.loading-wrapper').hide();
            },
            error: function (err){
                showMessage(form, err.responseText, true);
                form.find('.loading-wrapper').hide();
            }
        })
        return false;
    })

    //Update User Messenger Messages
    $('#messengerform').submit(function (){
        var form = $('#messengerform');
        //Getting Data
        var acctName = new Array(), acctType = new Array(), acctVisibility = Array();
        //Check if all fields were completed
        var isCompleted = true;
        form.find('.row').each(function (){
            if($(this).find('input[type="text"]').val() == ''){
                isCompleted = false;
                $(this).find('input[type="text"]').addClass('input-error');
            }
            if($(this).find('select').val() == ''){
                isCompleted = false;
                $(this).find('select').addClass('select-error');
            }

            acctName.push($(this).find('input[type="text"]').val());
            acctType.push($(this).find('select').val());
            acctVisibility.push($(this).find('input[type="radio"]:checked').val());
        })
        if(isCompleted){
            form.find('.loading-wrapper').show();

            var data = {
                username: acctName,
                type: acctType,
                visibility: acctVisibility,
                action: 'save_messenger',
                userID: form.find('input[name="userID"]').val()
            };

            $.ajax({
                type: 'post', data: data, url: '/info_contact.php', success: function (rsp){
                    form.find('.input-error').removeClass('input-error');
                    form.find('.select-error').removeClass('select-error');
                    if(rsp == 'Success'){
                        showMessage(form, 'Your contact information has been saved successfully!', false);
                    }else{
                        showMessage(form, rsp, true);
                    }
                    form.find('.loading-wrapper').hide();
                }, error: function (err){
                    showMessage(form, err.responseText, true);
                    form.find('.loading-wrapper').hide();
                }
            })
        }else{
            //Show Error Message
            showMessage(form, 'There are empty fields. Please complete or remove them.', true);
        }
    })

    //Update User Education
    $('#educationform').submit(function (){
        var form = $(this);
        //Getting Data
        var schoolName = new Array(), from = new Array(), to = new Array(), schoolVisibility = Array();
        //Check if all fields were completed
        var isCompleted = true;
        form.find('.row').each(function (){
            if($(this).find('input[type="text"]').val() == ''){
                isCompleted = false;
                $(this).find('input[type="text"]').addClass('input-error');
            }

            if($(this).find('select:eq(0)').val() == ''){
                isCompleted = false;
                $(this).find('select:eq(0)').addClass('select-error');
            }

            if($(this).find('select:eq(1)').val() == ''){
                isCompleted = false;
                $(this).find('select:eq(1)').addClass('select-error');
            }


            schoolName.push($(this).find('input[type="text"]').val());
            from.push($(this).find('select:eq(0)').val());
            to.push($(this).find('select:eq(1)').val());
            schoolVisibility.push($(this).find('input[type="radio"]:checked').val());
        })
        if(isCompleted){
            form.find('.loading-wrapper').show();

            var data = {
                schoolname: schoolName,
                from: from,
                to: to,
                visibility: schoolVisibility,
                action: 'save_education',
                userID: form.find('input[name="userID"]').val()
            };

            $.ajax({
                type: 'post', data: data, url: '/info_education.php', success: function (rsp){
                    if(rsp == 'Success'){
                        form.find('.input-error').removeClass('input-error');
                        form.find('.select-error').removeClass('select-error');
                        showMessage(form, 'Your education information has been saved successfully!', false);
                    }else{
                        showMessage(form, rsp, true);
                    }
                    form.find('.loading-wrapper').hide();
                }, error: function (err){
                    showMessage(form, err.responseText, true);
                    form.find('.loading-wrapper').hide();
                }
            })
        }else{
            //Show Error Message
            showMessage(form, 'There are empty fields. Please complete or remove them.', true);
        }
    })

    //Update User Employment History
    $('#employmentform').submit(function (){
        var form = $(this);
        //Getting Data
        var employer = new Array(), from = new Array(), to = new Array(), schoolVisibility = Array();
        //Check if all fields were completed
        var isCompleted = true;
        form.find('.row').each(function (){
            if($(this).find('input[type="text"]').val() == ''){
                isCompleted = false;
                $(this).find('input[type="text"]').addClass('input-error');
            }

            if($(this).find('select:eq(0)').val() == ''){
                isCompleted = false;
                $(this).find('select:eq(0)').addClass('select-error');
            }

            if($(this).find('select:eq(1)').val() == ''){
                isCompleted = false;
                $(this).find('select:eq(1)').addClass('select-error');
            }


            employer.push($(this).find('input[type="text"]').val());
            from.push($(this).find('select:eq(0)').val());
            to.push($(this).find('select:eq(1)').val());
            schoolVisibility.push($(this).find('input[type="radio"]:checked').val());
        })
        if(isCompleted){
            form.find('.loading-wrapper').show();

            var data = {
                employer: employer,
                from: from,
                to: to,
                visibility: schoolVisibility,
                action: 'save_employment',
                userID: form.find('input[name="userID"]').val()
            };

            $.ajax({
                type: 'post', data: data, url: '/info_employment.php', success: function (rsp){
                    if(rsp == 'Success'){
                        form.find('.input-error').removeClass('input-error');
                        form.find('.select-error').removeClass('select-error');
                        showMessage(form, 'Your employment history has been saved successfully!', false);
                    }else{
                        showMessage(form, rsp, true);
                    }
                    form.find('.loading-wrapper').hide();
                }, error: function (err){
                    showMessage(form, err.responseText, true);
                    form.find('.loading-wrapper').hide();
                }
            })
        }else{
            //Show Error Message
            showMessage(form, 'There are empty fields. Please complete or remove them.', true);
        }
    })

    //Update User Links
    $('#linksform').submit(function (){
        var form = $(this);
        //Getting Data
        var title = new Array(), url = new Array(), visibility = Array();
        //Check if all fields were completed
        var isCompleted = true;

        var myRegExp = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;

        form.find('.row').each(function (){
            if($(this).find('input[type="text"]:eq(0)').val() == ''){
                isCompleted = false;
                $(this).find('input[type="text"]').addClass('input-error');
            }


            //if($(this).find('input[type="text"]:eq(1)').val() == '')
            if(!myRegExp.test($(this).find('input[type="text"]:eq(1)').val())){
                isCompleted = false;
                $(this).find('input[type="text"]').addClass('input-error');
            }

            title.push($(this).find('input[type="text"]:eq(0)').val());
            url.push($(this).find('input[type="text"]:eq(1)').val());
            visibility.push($(this).find('input[type="radio"]:checked').val());
        })
        if(isCompleted){
            form.find('.loading-wrapper').show();

            var data = {
                title: title,
                url: url,
                visibility: visibility,
                action: 'save_links',
                userID: form.find('input[name="userID"]').val()
            };

            $.ajax({
                type: 'post', data: data, url: '/info_links.php', success: function (rsp){
                    if(rsp == 'Success'){
                        form.find('.input-error').removeClass('input-error');
                        form.find('.select-error').removeClass('select-error');
                        showMessage(form, 'Your links have been saved successfully!', false);
                    }else{
                        showMessage(form, rsp, true);
                    }
                    form.find('.loading-wrapper').hide();
                }, error: function (err){
                    showMessage(form, err.responseText, true);
                    form.find('.loading-wrapper').hide();
                }
            })
        }else{
            //Show Error Message
            showMessage(form, 'There are invalid fields. Please complete or remove them.', true);
        }
    })


})(jQuery)