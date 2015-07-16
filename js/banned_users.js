(function ($){
    $('#bannedusersform').submit(function (){

    })
    $('#bannedusersform #delete-users').click(function (){
        var form = $('#bannedusersform');
        form.find('input[name="action"]').val('delete');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });

    $('#bannedusersform #unban-users').click(function (){
        var form = $('#bannedusersform');
        form.find('input[name="action"]').val('unban');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });


})(jQuery)