/**
 * Delete trade item
 */
function deleteTradeItem(itemID){

    if(confirm('Are you sure to delete this item?') == true){
        jQuery.ajax({
            url: '/trade/process.php',
            data: {action: 'deleteTradeItem', itemID: itemID},
            type: 'post',
            success: function (rsp){
                document.location.reload();
            }
        });
    }
}


/**
 * Delete offer
 */
function deleteOffer(offerID){

    if(confirm('Are you sure to delete this offer?') == true){
        jQuery.ajax({
            url: '/trade/process.php',
            data: {action: 'deleteOffer', offerID: offerID},
            type: 'post',
            success: function (rsp){
                var responseObj = $.parseJSON(rsp);
                if(responseObj.success == 1){
                    setTimeout(function (){
                        document.location.reload();
                    }, 2000);
                }

                showMessage($('.offer-received'), responseObj.msg, false);
                hideMessage($('.offer-received'), 4);
            }
        });
    }
}


/**
 * Accept offer by offer ID
 */
function acceptOffer(offerID){
    if(confirm('Are you sure to accept this offer?') == true){
        jQuery.ajax({
            url: '/trade/process.php',
            data: {action: 'acceptOffer', offerID: offerID},
            type: 'post',
            success: function (rsp){
                var responseObj = $.parseJSON(rsp);

                if(responseObj.success == 1){
                    setTimeout(function (){
                        document.location.reload();
                    }, 2000);
                }

                showMessage($('.offer-received'), responseObj.msg, false);
                hideMessage($('.offer-received'), 4);
            }
        });
    }
}


/**
 * Accept decline offer
 */
function declineOffer(offerID){
    if(confirm('Are you sure to decline this offer?') == true){
        jQuery.ajax({
            url: '/trade/process.php',
            data: {action: 'declineOffer', offerID: offerID},
            type: 'post',
            success: function (rsp){
                var responseObj = $.parseJSON(rsp);

                if(responseObj.success == 1){
                    setTimeout(function (){
                        document.location.reload();
                    }, 2000);
                }

                showMessage($('.offer-received'), responseObj.msg, false);
                hideMessage($('.offer-received'), 4);
            }
        });
    }
}

/**
 * Validate shipping info form
 */
function validateShippingInfoForm(){
    var requiredFields = ['shippingFullName', 'shippingAddress', 'shippingCity', 'shippingState', 'shippingZip', 'shippingCountryID'];
    var isValid = true;

    for(idx = 0; idx < requiredFields.length; idx++){
        jQuery("#" + requiredFields[idx]).val(jQuery.trim(jQuery("#" + requiredFields[idx]).val()));

        if(jQuery("#" + requiredFields[idx]).val() == ''){
            isValid = false;
            jQuery("#" + requiredFields[idx]).addClass('input-error');
        }
    }

    if(!isValid){
        showMessage(jQuery('#shippingInfoForm'), 'Please complete the fields in red.', true);
    }else{
        jQuery("#shippingInfoForm").submit();
    }


}


/**
 * Search Related Parts
 */
(function ($){

    $('#trade_search_form').submit(function (){

        var fieldList = ['trade_s_q', 'trade_s_cat', 'trade_s_loc', 'trade_s_sort', 'trade_s_user'];
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

        $(document).on('change', '#trade_search_location', function (){
            $("#trade_s_loc").val($(this).val());
            $("#trade_search_form").submit();
        });

        $(document).on('change', '#trade_search_sort', function (){
            $("#trade_s_sort").val($(this).val());
            $("#trade_search_form").submit();
        });

    });


})(jQuery);


/**
 * trade view related
 */

(function ($){

    $(document).ready(function (){


        $(".trade-view-images ul li").hover(function (){
            $("#trade_view_main_image").attr("src", $(this).find('.large').attr('src'));
        });

        $(".trade-view-images ul li").click(function (){
            $(".trade-view-images ul li").each(function (){
                $(this).removeClass('sel');
            });
            $(this).addClass('sel');
        });

        $(".trade-view-images .thumb").mouseleave(function (){
            $("#trade_view_main_image").attr("src", $(".trade-view-images ul li.sel").find('.large').attr('src'));
        });


        $(".make-an-offer").click(function (){
            if(currentOfferProductCount > 0){
                //show make an offer page
                $(".trade-view-info").hide();
                $(".trade-view-owner").hide();
                $(".make-offer-panel").show();
            }else{
                alert("You have no items to offer.");
            }

        });

        $("#cancel_an_offer_btn").click(function (){
            //show make an offer page
            $(".trade-view-info").show();
            $(".trade-view-owner").show();
            $(".make-offer-panel").hide();
        });

        $("#make_an_offer_btn").click(function (){
            if($('input[name=available_item]:checked', '#offer_available_items').length > 0){
                var offerItemID = $('input[name=available_item]:checked', '#offer_available_items').parent().find('input[type=hidden]').val();

                $("#offer_available_items").parents('.needmask:first').append('<div class="mask"></div>');

                //Make an offer
                jQuery.ajax({
                    url: '/trade/process.php',
                    data: {action: 'makeAnOffer', targetItemID: $("#targetItemID").val(), offerItemID: offerItemID},
                    type: 'post',
                    success: function (rsp){

                        var responseObj = $.parseJSON(rsp);

                        if(responseObj.success == 1){
                            setTimeout(function (){
                                document.location.reload();
                            }, 4000);
                            showMessage($('.make-offer-panel'), responseObj.msg, false);
                        }else{
                            showMessage($('.make-offer-panel'), responseObj.msg, true);
                        }


                        hideMessage($('.make-offer-panel'), 4);


                    }
                });

            }else{
                if(currentOfferProductCount > 0){
                    alert("Please choose one of your items to offer.");
                }

            }
        });


    });


})(jQuery);


/*Offer declined related*/
(function ($){

    $(document).ready(function (){

        $("#remove_declined_offers").click(function (){
            var selectedOffers = [];
            $(".chk-offer-row").each(function (){
                if($(this).is(':checked'))
                    selectedOffers[selectedOffers.length] = $(this).attr('id').replace('chk_offer_row_', '');
            });

            if(selectedOffers.length == 0){
                alert("Please choose one of items listed.");
                return false;
            }else{
                //Remove item
                if(confirm('Are you sure to remove selected declined offer(s)?') == true){
                    $.ajax({
                        url: '/trade/process.php', data: {
                            action: 'removeDeclinedOffers',
                            offerIDs: selectedOffers.join(','),
                            type: $("#offer_declined_type").val()
                        }, type: 'post', success: function (rsp){
                            var responseObj = $.parseJSON(rsp);

                            if(responseObj.success == 1){
                                setTimeout(function (){
                                    document.location.reload();
                                }, 2000);
                                showMessage($('.offer-received'), responseObj.msg, false);
                            }else{
                                showMessage($('.offer-received'), responseObj.msg, true);
                            }
                            hideMessage($('.offer-received'), 4);
                        }
                    });
                }
            }

        });

        $("#select_all_offers").change(function (){
            $(".chk-offer-row").each(function (){
                if($("#select_all_offers").is(':checked'))
                    $(this).prop('checked', true);else
                    $(this).prop('checked', false);
            });
        });
    });
})(jQuery);


/*Completed Trade*/

var currentActiveFloatingWindow;
var currentLeaveFeedbackButton;
var currentTradeID;
var feedbackPlaceholder = 'Leave feedback here...';

(function ($){


    $(document).on('click', '.trade-mask', function (){
        $('.trade-mask').remove();
        currentActiveFloatingWindow.remove();
        var zIndex = currentActiveFloatingWindow.parent().parent().css('z-index');
        currentActiveFloatingWindow.parent().parent().css('z-index', zIndex - 1);
    });

    $(document).on('click', '.edit-tracking-number-box input[type="button"]', function (){

        if($(this).parent().find('.tracknumber').val() != ''){
            //save tracking number
            $.ajax({
                url: '/trade/process.php', data: {
                    action: 'saveTrackingNumber',
                    tradeID: currentTradeID,
                    trackingNo: $(this).parent().find('.tracknumber').val()
                }, type: 'post', success: function (rsp){
                    var responseObj = $.parseJSON(rsp);
                    if(responseObj.success == 1){
                        $("#my_tracking_number_" + currentTradeID).html($(this).parent().find('.tracknumber').val());

                        if(currentLeaveFeedbackButton.length > 0){
                            currentLeaveFeedbackButton.html('Edit Tracking Number');
                        }
                    }
                    $('.trade-mask').trigger('click');
                }
            });
        }
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
            url: '/trade/process.php', data: {
                action: 'saveFeedback',
                tradeID: currentTradeID,
                score: score,
                feedback: $(".edit-feedback-box textarea").val()
            }, type: 'post', success: function (rsp){
                var responseObj = $.parseJSON(rsp);
                if(responseObj.success == 1){
                    currentActiveFloatingWindow.parent().find('.leave_feedback_btn').parent().remove();
                    showMessage($('.trade-completed-panel'), responseObj.msg, false);
                }else{
                    showMessage($('.trade-completed-panel'), responseObj.msg, true);
                }

                hideMessage($('.trade-completed-panel'), 4);

                $('.trade-mask').trigger('click');
                setTimeout(function (){
                    document.location.reload();
                }, 3000);


            }
        });


    });


    $(document).ready(function (){

        $(".view_shipping_info_btn").click(function (){
            var tradeID = $(this).parent().parent().find('.tradeID').val();

            if($("#their_shipping_info_" + tradeID).css('display') == 'none'){
                $("#their_shipping_info_" + tradeID).css('display', 'block');
                $("#my_shipping_info_" + tradeID).css('display', 'block');
                $(this).html('Hide Shipping Info');
            }else{
                $("#their_shipping_info_" + tradeID).css('display', 'none');
                $("#my_shipping_info_" + tradeID).css('display', 'none');
                $(this).html('Show Shipping Info');
            }
        });


        $(".leave_tracking_number_btn").click(function (event){

            var tradeID = $(this).parent().parent().find('.tradeID').val();
            currentTradeID = tradeID;

            var currentTrackingCode = $("#my_tracking_number_" + tradeID).html();
            if(currentTrackingCode.toLowerCase() == 'none')
                currentTrackingCode = '';

            $(this).parent().parent().append('<div class="edit-tracking-number-box"><div class="title">Tracking Number</div><input type="text" value="" class="tracknumber"><input type="button" class="red-btn" value="Submit"/></div>');
            $(this).parent().parent().find('.edit-tracking-number-box .tracknumber').val(currentTrackingCode);


            $("body").append('<div class="trade-mask"></div>');
            $(".trade-mask").height($(document).outerHeight());
            currentActiveFloatingWindow = $(".edit-tracking-number-box");
            var zIndex = $(this).parent().parent().css('z-index');
            $(this).parent().parent().css('z-index', zIndex + 1);

            currentLeaveFeedbackButton = $(this);

        });


        $(".leave_feedback_btn").click(function (){

            var tradeID = $(this).parent().parent().find('.tradeID').val();
            currentTradeID = tradeID;

            $(this).parent().parent().append('<div class="edit-feedback-box"><div class="title">Trade Feedback</div><a href="javascript:void(0)" class="thumbup feedback-thumb"></a><a href="javascript:void(0)" class="thumbdown feedback-thumb"></a><div class="clear"></div><textarea>' + feedbackPlaceholder + '</textarea><input type="button" class="red-btn" value="Submit"/></div>');

            $("body").append('<div class="trade-mask"></div>');
            $(".trade-mask").height($(document).outerHeight());

            currentActiveFloatingWindow = $(".edit-feedback-box");
            var zIndex = $(this).parent().parent().css('z-index');
            $(this).parent().parent().css('z-index', zIndex + 1);


        });

    });
})(jQuery);
