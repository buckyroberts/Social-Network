(function ($){
    $('#manageAdsform #reject-ads').click(function (){
        var form = $('#manageAdsform');
        form.find('input[name="action"]').val('reject-ads');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });

    $('#manageAdsform #approve-ads').click(function (){
        var form = $('#manageAdsform');
        form.find('input[name="action"]').val('approve-ads');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });
})(jQuery)