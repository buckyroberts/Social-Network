var activityTimer = null;

(function ($){

    activityTimer = setTimeout(getActivityAndNotification, 5000);

    $('#activities').on('click', '.view-more', function (){
        if(activityTimer != null)
            clearTimeout(activityTimer);
        $('#activities').attr('data-count', parseInt($('#activities').attr('data-count')) + 15);
        getActivityAndNotification();

        $(this).html('<img src="/images/loading1.gif" alt="..." />');
        return false;
    })

    $('#notifications').on('click', '.view-more', function (){
        if(activityTimer != null)
            clearTimeout(activityTimer);
        $('#notifications').attr('data-count', parseInt($('#notifications').attr('data-count')) + 15);
        getActivityAndNotification();

        $(this).html('<img src="/images/loading1.gif" alt="..." />');
        return false;
    })

})(jQuery)

function getActivityAndNotification(){
    $.ajax({
        url: '/get_activities.php',
        data: 'action=activity-notification&acount=' + $('#activities').attr('data-count') + '&ncount=' + $('#notifications').attr('data-count'),
        type: 'post',
        dataType: 'xml',
        success: function (rsp){
            $('#activities').html($(rsp).find('activities').text());
            $('#notifications').html($(rsp).find('notifications').text());
        },
        complete: function (){
            activityTimer = setTimeout(getActivityAndNotification, 5000);
        }
    });
}