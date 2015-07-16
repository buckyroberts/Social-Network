(function ($){
    $('#newPageForm #add-new-link').click(function (){
        $(this).before('<span class="inputholder">' + '<input type="text" name="title[]" placeholder="Title" maxlength="60" class="input link-title" value="" />' + '<input type="text" name="url[]" placeholder="URL" class="input link-url" value="" />' + '<a href="javascript: void(0)" class="remove-link">Remove</a>' + '</span>');
        return false;
    })

    $('#newPageForm').on('click', '.remove-link', function (){
        $(this).parent().fadeOut('fast', function (){
            $(this).remove();
        })
    })


    var jcropObj = null;

    //Ajax Upload
    $('#pageLogo').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/photo_uploader.php',
        'buttonText': 'Choose File',
        'height': 19,
        'width': 76,
        'removeTimeout': 1,
        'multi': false,
        'fileSizeLimit': '4MB',
        'auto': true,
        'onSelect': function (){
            $('#pageLogo').addClass('hide');
            $('#newPageForm .file-row small').hide();
            if(jcropObj != null)
                jcropObj.destroy();
            jcropObj = null;

            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();

        },
        'onCancel': function (){
            $('#pageLogo').removeClass('hide');
            $('#newPageForm .file-row small').show();

        },
        'onUploadSuccess': function (file, data, response){
            var rsp = $.parseJSON(data);

            $('#newPageForm .loading-wrapper').hide();

            if(rsp.success == 0){
                $('#newPageForm .loading-wrapper').hide();
                showMessage($('#newPageForm'), rsp.msg, true);
                hideMessage($('#newPageForm'), 2);
            }else{
                //Show jCrop
                $('#jcrop-row').html('<img src="/photos/tmp/' + rsp.file + '" />');
                $('#jcrop-row-wrapper').show();
                if(jcropObj != null)
                    jcropObj.destroy();

                $('#jcrop-row img').Jcrop({
                    aspectRatio: 1, boxWidth: 543, allowSelect: false, minSize: [50, 50], onChange: function (c){
                        $('#newPageForm #x1').val(c.x);
                        $('#newPageForm #x2').val(c.x2);
                        $('#newPageForm #y1').val(c.y);
                        $('#newPageForm #y2').val(c.y2);
                        $('#newPageForm #width').val($('#jcrop-row .jcrop-holder').width());
                    }
                }, function (){
                    jcropObj = this;
                    jcropObj.animateTo([0, 0, 230, 230]);
                });
                fileUploaded = true;
                $('#newPageForm').append('<input type="hidden" name="file" value="' + rsp.file + '" />');
            }
        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                showMessage($('#newPageForm'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#newPageForm'), 2);
                $('#pageLogo').uploadify('cancel', '*');
            }else{
                $('#newPageForm .loading-wrapper').show();
            }

        }
    });

    $('#jcrop-row-wrapper .cancel-photo').click(function (){
        $('#jcrop-row-wrapper').fadeOut('fast', function (){
            $('#pageLogo').removeClass('hide');
            $('#newPageForm .file-row small').show();

            $('#newPageForm input[name="file"]').remove();
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();

        });
        fileUploaded = false;

        return false;
    })

    $('#newPageForm').submit(function (){
        var isValid = true;

        if($(this).find('#pageName').val() == ''){
            $(this).find('#pageName').focus();
            showMessage($(this), 'Please input page name.', true);
            return false;
        }

        if($(this).find('input[name="file"]').size() == 0){
            showMessage($(this), 'Please upload an image for page logo.', true);
            return false;
        }

        $('#newPageForm .loading-wrapper').show();

        return true;
    })

})(jQuery)