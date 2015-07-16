var bitcoinDecimalLength = 4;


function adjustZero(number){
    if(isNaN(number)){
        return number;
    }else{

        if(number == 0){
            return '.0000';
        }

        var numberParts = number.toString().split('.');
        if(number < 1){
            return "." + numberParts[1];
        }else{
            return number;
        }
    }
}

function isBitcoinDecimalLengthOK(number){

    if(isNaN(number)){
        return false;
    }

    var numberParts = number.toString().split('.');

    if(numberParts.length > 1 && numberParts[1].length > bitcoinDecimalLength)
        return falseelse
    return true;

}


/**
 * Delete shop Product
 */
function deleteShopProduct(productID){

    if(confirm('Are you sure to delete this item?') == true){

        showAjaxLoader();

        jQuery.ajax({
            url: '/shop/process.php',
            data: {action: 'deleteShopProduct', productID: productID},
            type: 'post',
            success: function (rsp){
                document.location.reload();
            }
        });
    }
}


/**
 * Search Related Parts
 */
(function ($){

    $('#shop_search_form').submit(function (){

        var fieldList = ['shop_s_q', 'shop_s_cat', 'shop_s_loc', 'shop_s_sort', 'shop_s_user'];
        var nodeCount = 0;
        for(idx = 0; idx < fieldList.length; idx++){
            if($("#" + fieldList[idx]).val() == ''){
                $("#" + fieldList[idx]).attr('disabled', true);
                nodeCount++;
            }
        }

        if(nodeCount == fieldList.length){
            document.location.href = $(this).attr("action");
            return false;
        }

        return true;
    });


    $(document).ready(function (){

        $(document).on('change', '#shop_search_location', function (){
            $("#shop_s_loc").val($(this).val());
            $("#shop_search_form").submit();
        });

        $(document).on('change', '#shop_search_sort', function (){
            $("#shop_s_sort").val($(this).val());
            $("#shop_search_form").submit();
        });

    });


})(jQuery);


/**
 * shop view related
 */

(function ($){

    $(document).ready(function (){

        $(".shop-view-images ul li").hover(function (){
            $("#shop_view_main_image").attr("src", $(this).find('.large').attr('src'));
        });

        $(".shop-view-images ul li").click(function (){
            $(".shop-view-images ul li").each(function (){
                $(this).removeClass('sel');
            });
            $(this).addClass('sel');
        });

        $(".shop-view-images .thumb").mouseleave(function (){
            $("#shop_view_main_image").attr("src", $(".shop-view-images ul li.sel").find('.large').attr('src'));
        });

        $(".show-buy-now-btn").click(function (){
            //show buy now button
            $(".shop-view-info").hide();
            $(".shop-view-owner").hide();
            $(".buy-product-panel").show();
        });

        $(".disabled-purchase-btn").click(function (){
            showMessage($('.shop-full-panel'), 'This item can not be shipped to your address. Check your shipping address or contact the owner.', true);
        });

        $("#btn_cancel_buy").click(function (){
            //show buy now page
            $(".shop-view-info").show();
            $(".shop-view-owner").show();
            $(".buy-product-panel").hide();
        });


        $("#btn_buy_now").click(function (){
            $("#buy_now_form").submit();
        });


    });


})(jQuery);


/*Completed shop*/

var currentActiveFloatingWindow;
var currentLeaveTrackingNoButton;
var currentOrderID;
var feedbackPlaceholder = 'Leave feedback here...';

(function ($){


    $(document).on('click', '.shop-mask', function (){
        $('.shop-mask').remove();
        currentActiveFloatingWindow.remove();
        var zIndex = currentActiveFloatingWindow.parent().parent().css('z-index');
        currentActiveFloatingWindow.parent().parent().css('z-index', zIndex - 1);
    });


    $(document).on('focus', '.edit-feedback-box textarea', function (){
        if($(this).val().toLowerCase() == feedbackPlaceholder.toLowerCase()){
            $(this).val('');
        }
    });

    $(document).on('blur', '.edit-feedback-box textarea', function (){
        if($(this).val().toLowerCase() == ''){
            $(this).val(feedbackPlaceholder);
        }
    });

    $(document).on('click', '.edit-feedback-box .thumbup', function (){
        if(!$(this).hasClass('thumb-sel'))
            $(this).addClass('thumb-sel');
        $('.edit-feedback-box .thumbdown').removeClass('thumb-sel');
    });

    $(document).on('click', '.edit-feedback-box .thumbdown', function (){
        if(!$(this).hasClass('thumb-sel'))
            $(this).addClass('thumb-sel');
        $('.edit-feedback-box .thumbup').removeClass('thumb-sel');
    });


    $(document).on('click', '.edit-feedback-box input[type="button"]', function (){
        if(!$(".edit-feedback-box .thumbup").hasClass('thumb-sel') && !$(".edit-feedback-box .thumbdown").hasClass('thumb-sel')){
            alert("Please choose thumb");
            return false;
        }

        if($(".edit-feedback-box textarea").val().toLowerCase() == feedbackPlaceholder.toLowerCase()){
            alert("Please input feedback");
            return false;
        }

        var score;

        if($(".edit-feedback-box .thumbup").hasClass('thumb-sel'))
            score = 1;else
            score = -1;

        $.ajax({
            url: '/shop/process.php', data: {
                action: 'saveFeedback',
                orderID: currentOrderID,
                score: score,
                feedback: $(".edit-feedback-box textarea").val()
            }, type: 'post', success: function (rsp){
                var responseObj = $.parseJSON(rsp);
                if(responseObj.success == 1){
                    currentActiveFloatingWindow.parent().find('.leave_feedback_btn').parent().remove();
                    showMessage($('.shop-completed-panel'), responseObj.msg, false);
                }else{
                    showMessage($('.shop-completed-panel'), responseObj.msg, true);
                }

                hideMessage($('.shop-completed-panel'), 4);

                $('.shop-mask').trigger('click');
                setTimeout(function (){
                    document.location.reload();
                }, 3000);


            }
        });


    });


    $(document).on('click', '.edit-tracking-number-box input[type="button"]', function (){
        var newTrackingNumber = $(this).parent().find('.tracknumber').val();
        if(newTrackingNumber != ''){
            //save tracking number
            $.ajax({
                url: '/shop/process.php',
                data: {action: 'saveTrackingNumber', orderID: currentOrderID, trackingNo: newTrackingNumber},
                type: 'post',
                success: function (rsp){
                    var responseObj = $.parseJSON(rsp);
                    if(responseObj.success == 1){
                        $("#my_tracking_number_" + currentOrderID).html(responseObj.trackingNo);
                        $("#my_tracking_number_" + currentOrderID).addClass('blue');

                        if(currentLeaveTrackingNoButton.length > 0){
                            currentLeaveTrackingNoButton.html('Edit Tracking Number');
                        }
                    }
                    $('.shop-mask').trigger('click');
                }
            });
        }
    });


    $(document).ready(function (){


        $(".leave_feedback_btn").click(function (){

            var orderID = $(this).parent().parent().find('.orderID').val();
            currentOrderID = orderID;

            $(this).parent().parent().append('<div class="edit-feedback-box"><div class="title">Feedback</div><a href="javascript:void(0)" class="thumbup feedback-thumb"></a><a href="javascript:void(0)" class="thumbdown feedback-thumb"></a><div class="clear"></div><textarea>' + feedbackPlaceholder + '</textarea><input type="button" class="red-btn" value="Submit"/></div>');

            $("body").append('<div class="shop-mask"></div>');
            $(".shop-mask").height($(document).outerHeight());

            currentActiveFloatingWindow = $(".edit-feedback-box");
            var zIndex = $(this).parent().parent().css('z-index');
            $(this).parent().parent().css('z-index', zIndex + 1);


        });


        $(".view_shipping_info_btn").click(function (){
            var orderID = $(this).parent().parent().find('.orderID').val();

            if($("#shipping_info_" + orderID).css('display') == 'none'){
                $("#shipping_info_" + orderID).show();
                $(this).html('Hide Shipping Info');
            }else{
                $("#shipping_info_" + orderID).hide();
                $(this).html('View Shipping Info');
            }
        });


        $(".leave_tracking_number_btn").click(function (event){

            var orderID = $(this).parent().parent().find('.orderID').val();
            currentOrderID = orderID;

            var currentTrackingCode = $("#my_tracking_number_" + orderID).html();
            if(currentTrackingCode.toLowerCase() == 'none')
                currentTrackingCode = '';

            $(this).parent().parent().append('<div class="edit-tracking-number-box"><div class="title">Tracking Number</div><input type="text" value="" class="tracknumber"><input type="button" class="red-btn" value="Submit"/></div>');
            $(this).parent().parent().find('.edit-tracking-number-box .tracknumber').val(currentTrackingCode);


            $("body").append('<div class="shop-mask"></div>');
            $(".shop-mask").height($(document).outerHeight());
            currentActiveFloatingWindow = $(".edit-tracking-number-box");
            var zIndex = $(this).parent().parent().css('z-index');
            $(this).parent().parent().css('z-index', zIndex + 1);

            currentLeaveTrackingNoButton = $(this);

        });


    });
})(jQuery);
