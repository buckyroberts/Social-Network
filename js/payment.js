/**
 * Paymen related functions here
 */

jQuery(document).ready(function (){


    jQuery("#purchase_credits_btn").click(function (){
        var amount = jQuery("input[name=credits]:checked").val();
        if(typeof amount == 'undefined'){
            alert("Please select one of the value from the list.");
            return false;
        }

        var label = '';
        if(amount == 3.5){
            label = '10 Credits';
        }else
            if(amount == 15){
                label = '50 Credits';
            }else
                if(amount == 25){
                    label = '100 Credits';
                }else{
                    alert("Something is wrong");
                    return false;
                }

        jQuery('#paypalForm input[name="item_name"]').val(label);
        jQuery('#paypalForm input[name="amount"]').val(amount);
        jQuery('#paypalForm').submit();

    });


});