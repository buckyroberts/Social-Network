function showTextAdForm(){
    $('#textAdForm').show();
    $('#imageAdForm').hide();
    //    $('#preview-ad-contr .text-ad').show();
    $('#preview-ad-contr .img-ad').hide();
    $('#ad-form-nav a:eq(0)').addClass('selected');
    $('#ad-form-nav a:eq(1)').removeClass('selected');
}


function showImageAdForm(){
    $('#textAdForm').hide();
    $('#imageAdForm').show();
    $('#preview-ad-contr .text-ad').hide();
    //    $('#preview-ad-contr .img-ad').show();
    $('#ad-form-nav a:eq(1)').addClass('selected');
    $('#ad-form-nav a:eq(0)').removeClass('selected');
}


(function ($){

    //Test Ad Preview
    $('#textAdForm #title, #textAdForm #description, #textAdForm #url, #textAdForm #display_url').on('input', function (){
        //Preview TexT Ad
        if($('#textAdForm #title').val() == '' && $('#textAdForm #description').val() == '' && $('#textAdForm #display_url').val() == ''){
            $('#preview-ad-contr .text-ad').hide();
        }else{
            var adHTML = '';

            if($('#textAdForm #title').val() != '')
                adHTML += '<p class="title">' + htmlEntities($('#textAdForm #title').val()) + '</p>';

            if($('#textAdForm #description').val() != '')
                adHTML += '<p class="desc">' + htmlEntities($('#textAdForm #description').val()) + '</p>';

            if($('#textAdForm #display_url').val() != '')
                adHTML += '<a href="' + htmlEntities($('#textAdForm #url').val()) + '" class="link">' + htmlEntities($('#textAdForm #display_url').val()) + '</a>';

            $('#preview-ad-contr .text-ad').html(adHTML);
            $('#preview-ad-contr .text-ad').show();
        }

    })
    $('#textAdForm #budget').on('input', function (){
        if(isNaN(this.value))
            $('#textAdForm .impressions-row .desc').html(0);else{
            $('#textAdForm .impressions-row .desc').html(Math.round(parseFloat(this.value) / 0.0001 * 1000));
            $('#textAdForm .impressions-row .desc').number(true);
        }
    })

    //Save Text Ad
    $('#textAdForm').submit(function (){
        var tfValid = true;

        if($('#textAdForm #title').val() == ''){
            $('#textAdForm #title').addClass('input-error');
            tfValid = false;
        }

        if($('#textAdForm #description').val() == ''){
            $('#textAdForm #description').addClass('input-error');
            tfValid = false;
        }

        if($('#textAdForm #url').val() == ''){
            $('#textAdForm #url').addClass('input-error');
            tfValid = false;
        }

        if($('#textAdForm #display_url').val() == ''){
            $('#textAdForm #display_url').addClass('input-error');
            tfValid = false;
        }

        if($('#textAdForm #name').val() == ''){
            $('#textAdForm #name').addClass('input-error');
            tfValid = false;
        }

        if($('#textAdForm #budget').val() == '' || isNaN($('#textAdForm #budget').val()) || parseFloat($('#textAdForm #budget').val()) <= 0){
            $('#textAdForm #budget').addClass('input-error');
            tfValid = false;
        }

        if(!tfValid){
            showMessage(this, 'Please complete the fields in red.', true);
        }else{
            $('#textAdForm .loading-wrapper').show();
        }

        return tfValid;
    })

    var fileUploaded = false;

    //Ajax Upload
    $('#ad_image').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/ads/ad_uploader.php',
        'buttonText': 'Choose File',
        'formData': {},
        'height': 19,
        'width': 76,
        'removeTimeout': 1,
        'multi': false,
        'fileSizeLimit': '4MB',
        'auto': true,
        'onSelect': function (){
            $('#ad_image').uploadify('settings', 'formData', {'size': $('#imageAdForm #size').val()}, null);
        },
        'onCancel': function (){

        },
        'onUploadSuccess': function (file, data, response){
            var rsp = $.parseJSON(data);
            $('#imageAdForm .loading-wrapper').hide();
            if(rsp.success == 0){
                showMessage($('#imageAdForm'), rsp.msg, true);
                hideMessage($('#imageAdForm'), 2);
                fileUploaded = false;
            }else{
                $('#imageAdForm #file_name').val(rsp.file);
                fileUploaded = true;
                $('#preview-ad-contr .img-ad').html('<img src="/image.php?image=' + rsp.file + '" />');
                $('#preview-ad-contr .img-ad').show();
            }
        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                showMessage($('#imageAdForm'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#imageAdForm'), 2);
                $('#ad_image').uploadify('cancel', '*');
            }else{
                $('#imageAdForm .loading-wrapper').show();
            }
        }
    });
    //Save Text Ad
    $('#imageAdForm').submit(function (){
        var tfValid = true;

        if($('#imageAdForm #url').val() == ''){
            $('#imageAdForm #url').addClass('input-error');
            tfValid = false;
        }

        if($('#imageAdForm #name').val() == ''){
            $('#imageAdForm #name').addClass('input-error');
            tfValid = false;
        }

        if($('#imageAdForm #budget').val() == '' || isNaN($('#imageAdForm #budget').val()) || parseFloat($('#imageAdForm #budget').val()) <= 0){
            $('#imageAdForm #budget').addClass('input-error');
            tfValid = false;
        }

        if(!fileUploaded){
            tfValid = false;
        }

        if(!tfValid){
            showMessage(this, 'Please complete the fields in red.', true);
            return false;
        }


        $('#imageAdForm .loading-wrapper').show();
        return tfValid;
    })

    $('#imageAdForm #budget').on('input', function (){
        if(isNaN(this.value))
            $('#imageAdForm .impressions-row .desc').html(0);else{
            $('#imageAdForm .impressions-row .desc').html(Math.round(parseFloat(this.value) / 0.0001 * 1000));
            $('#imageAdForm .impressions-row .desc').number(true);
        }
    })


})(jQuery)
function htmlEntities(str){
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}