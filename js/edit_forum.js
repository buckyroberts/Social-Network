jQuery(document).ready(function ($){
    var fileUploaded = false;
    var jcropObj = null;

    //Ajax Upload
    $('#file_upload').uploadify({
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
            //Clear Queue      
            if(jcropObj != null)
                jcropObj.destroy();
            jcropObj = null;
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();
            fileUploaded = false;
            $('.file-row').addClass('hide');
        },
        'onCancel': function (){
            //$('#editforumform .file-row p').show();
            $('.file-row').removeClass('hide');
            fileUploaded = false;
        },
        'onUploadSuccess': function (file, data, response){

            var rsp = $.parseJSON(data);

            $('#editforumform .loading-wrapper').hide();

            if(rsp.success == 0){
                $('#editforumform .loading-wrapper').hide();
                showMessage($('#editforumform'), rsp.msg, true);
                hideMessage($('#editforumform'), 2);
                //            $('#editforumform .file-row p').show();
                $('.file-row').removeClass('hide');
                fileUploaded = false;
            }else{
                $('#jcrop-row').html('<img src="/photos/tmp/' + rsp.file + '" />').show();

                if($('#preview-photo-row .has-cropped-img').length < 1){
                    $('#preview-photo-row').append('<div class="has-cropped-img"></div>');
                }

                $('#preview-photo-row .has-cropped-img').append('<img src="/photos/tmp/' + rsp.file + '" />');

                $('#jcrop-row-wrapper').show();
                $('#done-crop-btn').show();
                if(jcropObj != null)
                    jcropObj.destroy();

                $('#jcrop-row img').Jcrop({
                    aspectRatio: 1, boxWidth: 543, allowSelect: false, minSize: [50, 50], onChange: function (c){
                        $('#editforumform #x1').val(c.x);
                        $('#editforumform #x2').val(c.x2);
                        $('#editforumform #y1').val(c.y);
                        $('#editforumform #y2').val(c.y2);
                        $('#editforumform #width').val($('#jcrop-row .jcrop-holder').width());
                    }
                }, function (){
                    jcropObj = this;
                    jcropObj.animateTo([0, 0, 350, 350]);
                });
                fileUploaded = true;
                $('#editforumform').append('<input type="hidden" name="categoryFile" value="' + rsp.file + '" />');

            }
        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                showMessage($('#editforumform'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#editforumform'), 2);
                $('#file_upload').uploadify('cancel', '*');
            }else{
                $('#editforumform .loading-wrapper').show();
            }

        }
    });

    $('#preview-photo-row .cancel-photo').click(function (){
        $('#preview-photo-row').fadeOut('fast', function (){
            $('.file-row').removeClass('hide');
            $('#editforumform input[name="categoryFile"]').remove();
            $('#preview-photo-row').find('img').remove();
            $('#preview-photo-row').hide();

        });
        fileUploaded = false;

        return false;
    })

    $('#jcrop-row-wrapper .cancel-photo').click(function (){
        $('#jcrop-row').fadeOut('fast', function (){
            $('.file-row').removeClass('hide');
            $('#editforumform input[name="categoryFile"]').remove();
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();
            $('#done-crop-btn').hide();
        });
        fileUploaded = false;

        return false;
    })

    $('#done-crop-btn').click(function (){
        $('#preview-photo-row').show();

        var selectedWidth = parseInt($('#x2').val()) - parseInt($('#x1').val());
        var visibleWidth = $('#preview-photo-row .has-cropped-img').width();
        var ratio = visibleWidth / selectedWidth;

        var sW = $('#jcrop-row > img').width();
        var sH = $('#jcrop-row > img').height();

        $('#preview-photo-row img').css({'height': 'auto', 'width': 'auto'});

        if(sW > sH){
            $('#preview-photo-row img').width(sW * ratio);
        }else{
            $('#preview-photo-row img').height(sH * ratio);
        }

        $('#preview-photo-row img').css({
            'left': -1 * parseInt($('#x1').val()) * ratio, 'top': -1 * parseInt($('#y1').val()) * ratio,
        });

        $('#jcrop-row').fadeOut('fast', function (){
            $('#jcrop-row').html('');
            $('#jcrop-row-wrapper').hide();
            $('#done-crop-btn').hide();
        });
        return false;
    })
})