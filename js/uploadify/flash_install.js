/**
 * Check if the browser support flash, and show message to install the flash player.
 *
 * Note: you can define variable named "flashInstallNotification" in any place before including this file, and pass the jquery selector for target html node.
 * Let's say var flashInstallNotification = '#right_side'
 * Default value is #right_side
 */




var hasFlash = false;
try{
    var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
    if(fo){
        hasFlash = true;
    }
}catch(e){
    if(navigator.mimeTypes && navigator.mimeTypes['application/x-shockwave-flash'] != undefined && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin){
        hasFlash = true;
    }
}

jQuery(document).ready(function (){
    //if flash has not been installed on the server, then let them install (show messages)


    if(hasFlash === false){
        var messageContent = '<p style="" class="message error">Flash player is not installed on your browser. Click <a href="http://get.adobe.com/flashplayer/" target="_blank" style="color:white;text-decoration:underline">here</a> to install it.</p>';

        if(typeof flashInstallNotification !== undefined){
            flashInstallNotification = "#right_side";
        }

        if(jQuery(flashInstallNotification).length == 0){
            alert("here");
            flashInstallNotification = 'body';
        }

        jQuery(messageContent).prependTo(flashInstallNotification);
    }

});