(function ($){
    var fileUploaded = false;
    var jcropObj = null;

    //Add New Post
    $('#addphotoform').submit(function (){
        if(!fileUploaded){
            if($('#file_upload-queue .uploadify-progress-bar').size() < 1){
                showMessage($(this), 'Please choose a image.', true);
            }else{
                //                $('#file_upload').uploadify('upload', '*');
                $('#addphotoform .loading-wrapper').hide();
                $('#addphotoform').submit();
            }
            return false;
        }
    })


    //Ajax Upload
    $('#file_upload').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/photo_uploader.php',
        'buttonText': 'Choose File',
        'height': 19,
        'width': 76,
        'removeTimeout': 1,
        'fileSizeLimit': '4MB',
        'multi': false,
        'auto': true,
        'onSelect': function (){
            //Clear Queue                        
            $('#file_upload').addClass('hide');
            if(jcropObj != null)
                jcropObj.destroy();
            jcropObj = null;
            //            $('#add-photo-button').unbind('click');
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();
            fileUploaded = false;
        },
        'onCancel': function (){
            $('#add-photo-button').hide();
            $('#file_upload').removeClass('hide');
            fileUploaded = false;
        },
        'onUploadSuccess': function (file, data, response){
            var rsp = $.parseJSON(data);

            $('#addphotoform .loading-wrapper').hide();

            if(rsp.success == 0){
                showMessage($('#addphotoform'), rsp.msg, true);
                hideMessage($('#addphotoform'), 2);
                $('#add-photo-button').hide();
                $('#file_upload').removeClass('hide');
                fileUploaded = false;
            }else{
                $('#add-photo-button').show();
                fileUploaded = true;
                //If checked profile
                if($('#addphotoform input[name="post_visibility"]:checked').val() == 2){

                    //Show jCrop
                    $('#jcrop-row').html('<img src="/photos/tmp/' + rsp.file + '" />');
                    $('#jcrop-row-wrapper').show();
                    if(jcropObj != null)
                        jcropObj.destroy();

                    $('#jcrop-row img').Jcrop({
                        aspectRatio: 1, allowSelect: false, boxWidth: 544, minSize: [50, 50], onChange: function (c){
                            $('#addphotoform #x1').val(c.x);
                            $('#addphotoform #x2').val(c.x2);
                            $('#addphotoform #y1').val(c.y);
                            $('#addphotoform #y2').val(c.y2);
                            $('#addphotoform #width').val($('#jcrop-row .jcrop-holder').width());
                        }
                    }, function (){
                        jcropObj = this;
                        jcropObj.animateTo([0, 0, 230, 230]);
                    });

                    $('#addphotoform').append('<input type="hidden" name="file" value="' + rsp.file + '" />');
                }else{
                    $('#addphotoform').append('<input type="hidden" name="file" value="' + rsp.file + '" />');
                    $('#preview-photo-row').append('<img src="/photos/tmp/' + rsp.file + '" />').show();
                    //                    $('#addphotoform').submit();
                }
            }
        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                showMessage($('#addphotoform'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#addphotoform'), 2);
                $('#file_upload').uploadify('cancel', '*');
            }else{
                $('#addphotoform .loading-wrapper').show();
            }

        }
    })

    $('#preview-photo-row .cancel-photo').click(function (){
        $('#preview-photo-row').fadeOut('fast', function (){
            $('#add-photo-button').hide();
            $('#file_upload').removeClass('hide');
            $('#addphotoform input[name="file"]').remove();
            $('#preview-photo-row').find('img').remove();
            $('#preview-photo-row').hide();
        });
        fileUploaded = false;
    })


    $('#jcrop-row-wrapper .cancel-photo').click(function (){
        $('#preview-photo-row').fadeOut('fast', function (){
            $('#add-photo-button').hide();
            $('#file_upload').removeClass('hide');
            $('#addphotoform input[name="file"]').remove();
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();

        });
        fileUploaded = false;

        return false;
    })

    $('#post_visibility_profile').click(function (){
        if($('#jcrop-row-wrapper').css('display') == 'none' && fileUploaded){
            var tFile = $('#addphotoform input[name="file"]').val();

            //Hide Preview Photo
            $('#save-btn').hide();
            $('#addphotoform input[name="file"]').remove();
            $('#preview-photo-row').find('img').remove();
            $('#preview-photo-row').hide();

            //Drop            
            $('#save-btn').show();

            $('#jcrop-row').html('<img src="/photos/tmp/' + tFile + '" />');
            $('#jcrop-row-wrapper').show();

            setTimeout(function (){
                if(jcropObj != null)
                    jcropObj.destroy();

                $('#jcrop-row img').Jcrop({
                    aspectRatio: 1, allowSelect: false, boxWidth: 544, minSize: [50, 50], onChange: function (c){
                        $('#addphotoform #x1').val(c.x);
                        $('#addphotoform #x2').val(c.x2);
                        $('#addphotoform #y1').val(c.y);
                        $('#addphotoform #y2').val(c.y2);
                        $('#addphotoform #width').val($('#jcrop-row .jcrop-holder').width());
                    }
                }, function (){
                    jcropObj = this;
                    jcropObj.animateTo([0, 0, 230, 230]);
                });

            }, 100);

            $('#addphotoform').append('<input type="hidden" name="file" value="' + tFile + '" />');
        }
    })
})(jQuery)