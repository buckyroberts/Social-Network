//Global variables for path
var trade_image_path = '/images/trade/';
var trade_image_tmp_path = '/images/trade/tmp/';

var upload_file_limit = 5;//you can upload upto 5 images.

(function ($){

    //Validate the inputs before submit new message
    $('#tradeEditForm').submit(function (){
        var isValid = true;
        var form = $(this);
        var errorMsg = 'Please complete the fields in red.';
        var disabledListingFee = true; // FreeTradeListings (change to false to enable listing fees)

        if($("#actionType").val() == 'edit'){
            disabledListingFee = true;
        }


        var requiredFields = ['title', 'subtitle', 'description', 'category', 'location'];

        for(idx = 0; idx < requiredFields.length; idx++){
            $("#" + requiredFields[idx]).val($.trim($("#" + requiredFields[idx]).val()));

            if($("#" + requiredFields[idx]).val() == ''){
                isValid = false;
                $("#" + requiredFields[idx]).addClass('input-error');
            }
        }

        if(!disabledListingFee){
            if(!$("input[name=listing_fee_type]").is(':checked')){
                if(isValid)
                    errorMsg = 'Please select listing fee.';else
                    errorMsg += ' And select listing fee.';
                isValid = false;

            }
        }

        if(!isValid){
            showMessage($('#tradeEditForm'), errorMsg, true);

        }else{

            showAjaxLoader();
            //SUBMIT HERE
            $.ajax({
                url: '/trade/process.php', data: {
                    action: $("#actionName").val(),
                    type: $("#actionType").val(),
                    itemID: $("#itemID").val(),
                    title: $("#title").val(),
                    subtitle: $("#subtitle").val(),
                    description: $("#description").val(),
                    items_wanted: $("#items_wanted").val(),
                    images: current_img_files.join('|'),
                    category: $("#category").val(),
                    location: $("#location").val(),
                    listing_duration: $("#listing_duration").val(),
                    listing_fee_type: disabledListingFee ? '' : $("input[name=listing_fee_type]:checked").val()
                }, type: 'post', success: function (data){

                    hideAjaxLoader();

                    var responseObj = $.parseJSON(data);

                    if(responseObj.success == 1){
                        showMessage($('#tradeEditForm'), responseObj.msg, false);
                    }else{
                        showMessage($('#tradeEditForm'), responseObj.msg, true);
                        return false;
                    }


                    hideMessage($('#tradeEditForm'), 5);

                    if($("#actionName").val() == 'addTradeItem'){

                        /*document.getElementById("tradeEditForm").reset();
                         current_img_files = [];
                         $("#image_list_container").html('');
                         $("#image_upload_btn").show();*/

                        setTimeout(function (){
                            document.location.href = "/trade/additem.php"
                        }, 3000);

                    }

                    if($("#actionType").val() == 'relist'){

                        setTimeout(function (){
                            document.location.href = "/trade/available.php"
                        }, 3000);
                    }

                }
            });

        }

        return false;
    });


    //Ajax Upload
    $('#image_upload_btn').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/trade/uploader.php',
        'buttonText': 'Choose File',
        'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
        'height': 21,
        'width': 80,
        'fileSizeLimit': '4MB',
        'removeTimeout': 0,
        'multi': true,
        'auto': true,
        'uploadLimit': upload_file_limit,
        'onSelect': function (){

        },
        'onDialogClose': function (queueData){

        },
        'onCancel': function (){

        },
        'onUploadSuccess': function (file, data, response){
            var rsp = $.parseJSON(data);

            if(rsp.success == 0){
                $('#tradeEditForm .loading-wrapper').hide();
                showMessage($('#tradeEditForm'), rsp.msg, true);
                hideMessage($('#tradeEditForm'), 2);

                fileUploaded = false;
            }else{
                $("#image_list_container").show();
                current_img_files[current_img_files.length] = trade_image_tmp_path + rsp.file;

                displayUploadedImages(trade_image_tmp_path + rsp.file);

            }


        },
        'onUploadError': function (file, errorCode, errorMsg, errorString){
            $('#tradeEditForm .loading-wrapper').hide();

            showMessage($('#tradeEditForm'), errorString, true);
            hideMessage($('#tradeEditForm'), 2);

            fileUploaded = false;

        },
        'onQueueComplete': function (queueData){

        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                $('#image_upload_btn').uploadify('cancel', '*');

                showMessage($('#tradeEditForm'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#tradeEditForm'), 2);

            }else{
                $('#tradeEditForm .loading-wrapper').show();
                fileUploaded = true; //init, assume all process is fine

            }

        }
    });


    $(document).ready(function (){


        if(typeof noCashFlag != 'undefined' && noCashFlag == true){
            jQuery("#tradeEditForm :input").attr("disabled", true);
            $("#image_upload_btn").hide();
        }


        $(document).on('click', '.remove-img-btn', function (){

            var gTargetNode = $(this).parent();
            var gTargetImgSrc = $(this).parent().find('img').attr('src');

            if(confirm('Are you sure to delete this image?') == true){

                $.ajax({
                    url: '/trade/process.php',
                    data: {action: 'deleteTradeItemImage', file: gTargetImgSrc, itemID: $("#itemID").val()},
                    type: 'post',
                    success: function (rsp){
                        gTargetNode.remove();

                        for(idx = 0; idx < current_img_files.length; idx++){
                            if(current_img_files[idx] == gTargetImgSrc){
                                current_img_files.splice(idx, 1);
                            }
                        }

                        if(current_img_files.length < upload_file_limit){
                            $("#image_upload_btn").show();
                        }
                    }
                });
            }
        });


        //Show Images when you edit the pages
        if(current_img_files.length > 0){

            for(idx = 0; idx < current_img_files.length; idx++){
                displayUploadedImages(current_img_files[idx]);
            }
        }


        //Upload button correct size
        setFlashObjectSize();
    });


    /**
     * Display uploaded images by image url
     */
    function displayUploadedImages(imgUrl){

        $("#image_list_container").show();
        $("#image_list_container").append('<div class="img-node"><div class="remove-img-btn"></div><img src="' + imgUrl + '" /></div>');

        if(current_img_files.length >= upload_file_limit){
            $("#image_upload_btn").hide();
        }
    }


    function setFlashObjectSize(){
        var width = jQuery("#image_upload_btn").outerWidth();
        var height = jQuery("#image_upload_btn").outerHeight();

        jQuery("#SWFUpload_0").width(width);
        jQuery("#SWFUpload_0").height(height);

    }


})(jQuery);
