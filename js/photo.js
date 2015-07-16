(function ($){
    $(document).ready(function (){
        var jcropObj = null;
        var x1 = 0, y1 = 0, x2 = 230, y2 = 230;
        //Ajax Upload
        $('#file_upload').uploadify({
            'swf': '/js/uploadify/uploadify.swf',
            'uploader': '/photo_uploader.php',
            'buttonText': 'Choose File',
            'height': 22,
            'fileSizeLimit': '4MB',
            'width': 65,
            'removeTimeout': 1,
            'multi': false,
            'auto': false,
            'onSelect': function (){
                //Clear Queue
                /*if($('#file_upload-queue .uploadify-progress-bar').size() > 1){
                 $('#file_upload').uploadify('cancel');
                 }*/
                $('#add-photo-button').show();
                $('#addphotoform .file-row p').hide();
                $('#file_upload').hide();
                if(jcropObj != null)
                    jcropObj.destroy();
                jcropObj = null;
                $('#add-photo-button').unbind('click');
                $('#jcrop-row').html('').hide();
            },
            'onCancel': function (){
                $('#add-photo-button').hide();
                $('#addphotoform .file-row p').show();
                $('#file_upload').show();
            },
            'onUploadSuccess': function (file, data, response){
                var rsp = $.parseJSON(data);

                if(rsp.success == 0){
                    $('#addphotoform .loading-wrapper').hide();
                    showMessage($('#addphotoform'), rsp.msg, true);
                    hideMessage($('#addphotoform'), 2);
                }else{
                    //If checked profile
                    if($('#addphotoform input[name="photo_visibility"]:checked').val() == 2){

                        $('#addphotoform .loading-wrapper').hide();
                        //Show jCrop
                        $('#jcrop-row').html('<img src="/photos/tmp/' + rsp.file + '" />').show();
                        if(jcropObj != null)
                            jcropObj.destroy();

                        $('#jcrop-row img').Jcrop({
                            aspectRatio: 1, allowSelect: false, minSize: [50, 50], onChange: function (c){
                                x1 = c.x;
                                x2 = c.x2;
                                y1 = c.y;
                                y2 = c.y2;
                            }
                        }, function (){
                            jcropObj = this;
                            jcropObj.animateTo([0, 0, 230, 230]);
                        });
                        $('#add-photo-button').click(function (){
                            $('#addphotoform .loading-wrapper').show();
                            //Save Photo using ajax
                            var formData = {
                                'content': $('#addphotoform #content').val(),
                                'album': $('#addphotoform #album').val(),
                                'post_visibility': 1,
                                'profile': 1,
                                'x1': x1,
                                'x2': x2,
                                'y1': y1,
                                'y2': y2,
                                'file': rsp.file,
                                'action': 'save-photo'
                            }
                            $.ajax({
                                url: '/photo_add.php',
                                data: formData,
                                type: 'post',
                                dataType: 'xml',
                                success: function (rsp){
                                    $('#addphotoform .loading-wrapper').hide();
                                    if($(rsp).find('status').text() == 'success'){
                                        //Reset Form
                                        $('#addphotoform #content').val('');
                                        $('#addphotoform #album').val('');
                                        $('#addphotoform #photo_visibility_public').prop('checked', true);
                                        if(jcropObj != null)
                                            jcropObj.destroy();
                                        jcropObj = null;
                                        $('#add-photo-button').unbind('click');
                                        $('#jcrop-row').html('').hide();
                                        showMessageHTML($('#addphotoform'), $(rsp).find('message').text());
                                        hideMessage($('#addphotoform'), 3);
                                    }else{
                                        $('#addphotoform .loading-wrapper').hide();
                                        showMessage($('#addphotoform'), err.responseText, true);
                                        hideMessage($('#addphotoform'), 3);
                                    }
                                    $('#add-photo-button').hide();
                                    $('#addphotoform .file-row p').show();
                                    $('#file_upload').show();
                                },
                                error: function (err){
                                    $('#addphotoform .loading-wrapper').hide();
                                    showMessage($('#addphotoform'), err.responseText, true);
                                    hideMessage($('#addphotoform'), 3);
                                    $('#add-photo-button').hide();
                                    $('#addphotoform .file-row p').show();
                                    $('#file_upload').show();
                                }
                            })
                            return false;
                        })

                    }else{
                        //Save Photo using ajax
                        var formData = {
                            'content': $('#addphotoform #content').val(),
                            'album': $('#addphotoform #album').val(),
                            'post_visibility': $('#addphotoform input[name="photo_visibility"]:checked').val(),
                            'file': rsp.file,
                            'action': 'save-photo'
                        }
                        $.ajax({
                            url: '/photo_add.php',
                            data: formData,
                            type: 'post',
                            dataType: 'xml',
                            success: function (rsp){
                                $('#addphotoform .loading-wrapper').hide();
                                if($(rsp).find('status').text() == 'success'){
                                    //Reset Form
                                    $('#addphotoform #content').val('');
                                    $('#addphotoform #album').val('');
                                    $('#addphotoform #photo_visibility_public').prop('checked', true);
                                    showMessageHTML($('#addphotoform'), $(rsp).find('message').text());
                                    hideMessage($('#addphotoform'), 5);
                                }else{
                                    $('#addphotoform .loading-wrapper').hide();
                                    showMessage($('#addphotoform'), err.responseText, true);
                                    hideMessage($('#addphotoform'), 5);
                                }
                                $('#add-photo-button').hide();
                                $('#addphotoform .file-row p').show();
                                $('#file_upload').show();
                            },
                            error: function (err){
                                $('#addphotoform .loading-wrapper').hide();
                                showMessage($('#addphotoform'), err.responseText, true);
                                hideMessage($('#addphotoform'), 3);
                                $('#add-photo-button').hide();
                                $('#addphotoform .file-row p').show();
                                $('#file_upload').show();
                            }
                        })
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

        //Upload Photo
        $('#addphotoform').submit(function (){
            $('#file_upload').uploadify('upload', '*');
            return false;
        })
    })
})(jQuery)