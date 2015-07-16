//Global variables for path
var shop_image_path = '/images/shop/';
var shop_image_tmp_path = '/images/shop/tmp/';

var upload_file_limit = 5;//you can upload upto 5 images.

var shippingPriceError = 0; //0 - no error, 1 - invalid number, 2 - more than 4 digit in decimal


function getShippingFeeMatrix(errorShowFlag){
    var matrix = [];

    jQuery('#shipping_fee_cont').find('.fee-row').each(function (){

        var countryID = jQuery(this).find('select[name=shipping_country]').val();
        var shippingPrice = jQuery(this).find('input[name=shipping_cost]').val();


        if(isNaN(shippingPrice)){
            if(errorShowFlag){
                jQuery(this).find('input[name=shipping_cost]').addClass('input-error');
            }
            shippingPriceError = 1;
        }

        if(!isBitcoinDecimalLengthOK(shippingPrice)){
            if(errorShowFlag){
                jQuery(this).find('input[name=shipping_cost]').addClass('input-error');
            }
            shippingPriceError = 2;
        }


        var addedFlag = false;
        for(var idx = 0; idx < matrix.length; idx++){
            if(matrix[idx]['locationID'] == countryID){
                addedFlag = true;
                break;
            }
        }

        if(addedFlag == false){
            if(!isNaN(shippingPrice) && isBitcoinDecimalLengthOK(shippingPrice))
                matrix[matrix.length] = {'locationID': countryID, 'price': shippingPrice};
        }
    });

    return matrix;
}


function addShippingField(selCountryID, cost){

    if(typeof noCashFlag != 'undefined' && noCashFlag == true){
        return false;
    }

    var outputHtml = '';

    if(cost == ''){
        cost = '.0000';
    }

    outputHtml += '<span class="le">To: </span>';
    outputHtml += getShippingCountryOptionHtml(selCountryID);

    outputHtml += '<span class="ri">Cost: </span>';
    outputHtml += '<input type="text" name="shipping_cost" value="' + cost + '" class="input input-short zero-omit"/>';
    outputHtml += '<span class="bt">BTC</span>';

    outputHtml += '<a href="javascript:void(0)" class="btn_remove_shipping_field">Remove</a>'


    outputHtml = '<div class="fee-row">' + outputHtml + '</div>';

    jQuery("#shipping_fee_cont").append(outputHtml);

}


/**
 * Get shipping country option list by HTML.
 *
 * @param selected : which is selected one.
 */
function getShippingCountryOptionHtml(selected){
    if(typeof countryCodeList === 'undefined' || countryCodeList == '' || countryCodeList.length == 0){
        //countryCodeList will be defined in additem.php file
        return '';
    }

    var retHtml = '<select name="shipping_country" class="input select"><option value="0">Worldwide</option>';

    for(var idx = 0; idx < countryCodeList.length; idx++){

        var selectedStr = '';
        if(selected == countryCodeList[idx].countryID){
            selectedStr = ' selected="selected" ';
        }

        retHtml += '<option value="' + countryCodeList[idx].countryID + '"' + selectedStr + '>' + countryCodeList[idx].country_title + '</option>';
    }

    retHtml += "</select>";

    return retHtml;

}


(function ($){

    //Validate the inputs before submit new message
    $('#shopEditForm').submit(function (){
        var isValid = true;
        var form = $(this);
        var listFeeFlag = true;
        var errorMsg = 'Please complete the fields in red below.';
        var disabledListingFee = false;
        var isDownloadable = $('#shopEditForm #category option:selected').attr('is-downloadable') == "1" ? true : false;

        $('#shopEditForm .message').remove();

        if($("#actionType").val() == 'edit'){
            disabledListingFee = true;
        }

        if(isDownloadable)
            var requiredFields = ['title', 'subtitle', 'description', 'category'];else
            var requiredFields = ['title', 'subtitle', 'description', 'category', 'location', 'return_policy'];

        for(idx = 0; idx < requiredFields.length; idx++){
            $("#" + requiredFields[idx]).val($.trim($("#" + requiredFields[idx]).val()));

            if($("#" + requiredFields[idx]).val() == ''){
                isValid = false;
                $("#" + requiredFields[idx]).addClass('input-error');
            }
        }


        //Price
        if($("#price").val() == '' || isNaN($("#price").val()) || $("#price").val() <= 0){
            isValid = false;
            $("#price").addClass('input-error');
        }

        if(!isBitcoinDecimalLengthOK($("#price").val())){
            if(isValid)
                errorMsg = 'All Bitcoin values must be 4 decimal places or less.';else
                errorMsg += ' <br/>- All Bitcoin values must be 4 decimal places or less.';

            isValid = false;
            $("#price").addClass('input-error');

        }


        if(!disabledListingFee){
            if(!$("input[name=listing_fee_type]").is(':checked')){
                if(isValid)
                    errorMsg = 'Please select listing fee.';else
                    errorMsg += ' <br/>-  Select listing fee.';
                isValid = false;

            }
        }

        shippingPriceError = 0;
        var feeMatrix = getShippingFeeMatrix(true);
        if(feeMatrix.length == 0){

            if(isValid)
                errorMsg = 'Please add shipping fee.';else
                errorMsg += ' <br/>- Add shipping fee.';
            isValid = false;
        }else{
            $("#shippingFeeVal").val(JSON.stringify(feeMatrix));
        }

        if(shippingPriceError === 1){
            if(isValid)
                errorMsg = 'Shipping price list has invalid number.';else
                errorMsg += ' <br/>- Shipping price list has invalid number.';
            isValid = false;

        }else
            if(shippingPriceError === 2){

                if(errorMsg.toLowerCase().indexOf('all bitcoin values must be 4 decimal places or less') == -1){
                    if(isValid)
                        errorMsg = 'All Bitcoin values must be 4 decimal places or less.';else
                        errorMsg += ' <br/>- All Bitcoin values must be 4 decimal places or less.';

                }

                isValid = false;
            }

        //If the selected categorys is digital goods
        if(jQuery("#actionType").val() == 'addShopProduct' && $('#shopEditForm #category option:selected').attr('is-downloadable') == "1" && $('#digital_goods_file-queue .uploadify-queue-item').size() == 0){
            if(isValid)
                errorMsg = 'Please select a zip file.'else
                errorMsg += ' <br/>Please select a zip file.';

            isValid = false;
        }

        if(!isValid){
            showMessage($('#shopEditForm'), errorMsg, true);

        }else{

            showAjaxLoader();

            if($('#digital_goods_file-queue .uploadify-queue-item').size() > 0 && $('#shopEditForm #category option:selected').attr('is-downloadable') == "1"){
                //Upload Zip File First
                $('#digital_goods_file').uploadify('upload', '*');
                showAjaxLoader();
            }else{ //General Product
                saveProduct();
            }
        }

        return false;
    });

    //Ajax Upload
    $('#image_upload_btn').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/shop/uploader.php',
        'buttonText': 'Choose File',
        'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
        'formData': {'type': 'image'},
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
                $('#shopEditForm .loading-wrapper').hide();
                showMessage($('#shopEditForm'), rsp.msg, true);
                hideMessage($('#shopEditForm'), 2);

                fileUploaded = false;
            }else{
                $("#image_list_container").show();
                current_img_files[current_img_files.length] = shop_image_tmp_path + rsp.file;

                displayUploadedImages(shop_image_tmp_path + rsp.file);

            }


        },
        'onUploadError': function (file, errorCode, errorMsg, errorString){
            $('#shopEditForm .loading-wrapper').hide();

            showMessage($('#shopEditForm'), errorString, true);
            hideMessage($('#shopEditForm'), 2);

            fileUploaded = false;

        },
        'onQueueComplete': function (queueData){

        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.jpg' && ext != '.jpeg' && ext != '.png' && ext != '.gif'){
                $('#image_upload_btn').uploadify('cancel', '*');

                showMessage($('#shopEditForm'), 'Invalid file type! Please upload JPG, JPEG, PNG or GIF file.', true);
                hideMessage($('#shopEditForm'), 2);

            }else{
                $('#shopEditForm .loading-wrapper').show();
                fileUploaded = true; //init, assume all process is fine

            }

        }
    });

    $('#shopEditForm #category').change(function (){
        if($('#shopEditForm #category option:selected').attr('is-downloadable') == "1"){//Digital Goods Category ID
            $('#shopEditForm #listing_duration').append('<option value="-1">Unlimited</option>');
            $('#digital_goods_file_row').show();
            $('#shipping-fee-list').hide();
            $('#item-location-row').hide();
            $('#return-policy-row').hide();
        }else{
            $('#shopEditForm #listing_duration option').each(function (){
                if($(this).text() == 'Unlimited')
                    $(this).remove();
            });
            $('#digital_goods_file_row').hide();
            $('#shipping-fee-list').show();
            $('#item-location-row').show();
            $('#return-policy-row').show();
        }
    })

    $('#digital_goods_file').uploadify({
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/shop/uploader.php',
        'buttonText': 'Upload Zip File',
        'fileTypeExts': '*.zip',
        'formData': {'type': 'digital_goods'},
        'height': 21,
        'width': 100,
        'fileSizeLimit': '300MB',
        'removeTimeout': 0,
        'multi': false,
        'auto': false,
        'uploadLimit': upload_file_limit,
        'onSelect': function (){

        },
        'onDialogClose': function (queueData){

        },
        'onCancel': function (){

        },
        'onUploadSuccess': function (file, data, response){

            var rsp = $.parseJSON(data);
            //            hideAjaxLoader();
            if(rsp.success == 0){
                hideAjaxLoader();
                $('#shopEditForm .loading-wrapper').hide();
                showMessage($('#shopEditForm'), rsp.msg, true);
                hideMessage($('#shopEditForm'), 2);


            }else{
                $('#filename').val(rsp.file);
                saveProduct();
            }


        },
        'onUploadError': function (file, errorCode, errorMsg, errorString){
            hideAjaxLoader();
            $('#shopEditForm .loading-wrapper').hide();

            showMessage($('#shopEditForm'), errorString, true);
            hideMessage($('#shopEditForm'), 2);

            fileUploaded = false;

        },
        'onQueueComplete': function (queueData){

        },
        'onUploadStart': function (file){
            //Check File Extension Validation
            var ext = file.name.substring(file.name.lastIndexOf(".")).toLowerCase();
            if(ext != '.zip'){
                $('#image_upload_btn').uploadify('cancel', '*');

                showMessage($('#shopEditForm'), 'Invalid file type! Please upload ZIP file.', true);
                hideMessage($('#shopEditForm'), 2);
                hideAjaxLoader();
            }
        }
    });

    $(document).ready(function (){


        $(document).on('blur', '.zero-omit', function (){
            $(this).val(adjustZero($(this).val()));
        });


        $(document).on('focus', '.input', function (){
            $(this).removeClass('input-error');
        })


        if(typeof noCashFlag != 'undefined' && noCashFlag == true){
            jQuery("#shopEditForm :input").attr("disabled", true);
            $("#image_upload_btn").hide();
        }


        if(typeof shippingFeeList != 'undefined' && shippingFeeList.length > 0){
            for(var idx = 0; idx < shippingFeeList.length; idx++){
                addShippingField(shippingFeeList[idx]['locationID'], shippingFeeList[idx]['price']);
            }
        }else{
            shippingFeeList = [];
            addShippingField('', '');
        }

        $(".btn_add_shipping_fee_field").click(function (){
            addShippingField('', '');
        });

        $(document).on('click', '.btn_remove_shipping_field', function (){
            $(this).closest('.fee-row').remove();

            if($("#shipping_fee_cont .fee-row").length == 0){
                addShippingField('', '');
            }

        });


        $(document).on('click', '.remove-img-btn', function (){

            var gTargetNode = $(this).parent();
            var gTargetImgSrc = $(this).parent().find('img').attr('src');

            if(confirm('Are you sure to delete this image?') == true){

                $.ajax({
                    url: '/shop/process.php',
                    data: {action: 'deleteShopProductImage', file: gTargetImgSrc, productID: $("#productID").val()},
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


function saveProduct(){
    var disabledListingFee = false;

    if($("#actionType").val() == 'edit'){
        disabledListingFee = true;
    }

    jQuery.ajax({
        url: '/shop/process.php', data: {
            action: jQuery("#actionName").val(),
            type: jQuery("#actionType").val(),
            productID: jQuery("#productID").val(),
            title: jQuery("#title").val(),
            subtitle: jQuery("#subtitle").val(),
            description: jQuery("#description").val(),
            category: jQuery("#category").val(),
            filename: jQuery("#filename").val(),
            images: current_img_files.join('|'),
            location: jQuery("#location").val(),
            return_policy: jQuery("#return_policy").val(),
            price: jQuery("#price").val(),
            shipping_price: jQuery("#shippingFeeVal").val(),
            listing_duration: jQuery("#listing_duration").val(),
            listing_fee_type: disabledListingFee ? '' : jQuery("input[name=listing_fee_type]:checked").val()
        }, type: 'post', success: function (data){

            hideAjaxLoader();

            var responseObj = jQuery.parseJSON(data);

            if(responseObj.success == 1){
                showMessage(jQuery('#shopEditForm'), responseObj.msg, false);
            }else{
                showMessage(jQuery('#shopEditForm'), responseObj.msg, true);
                return false;
            }


            hideMessage(jQuery('#shopEditForm'), 5);

            if(jQuery("#actionName").val() == 'addShopProduct'){

                setTimeout(function (){
                    document.location.href = "/shop/additem.php"
                }, 3000);

            }

            if(jQuery("#actionType").val() == 'relist'){

                setTimeout(function (){
                    document.location.href = "/shop/available.php"
                }, 3000);
            }

        }
    });
}