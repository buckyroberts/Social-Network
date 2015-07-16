(function ($){
    $('#reportedform').submit(function (){

    })
    $('#reportedform #delete-objects').click(function (){
        var form = $('#reportedform');
        form.find('input[name="action"]').val('delete-objects');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });

    $('#reportedform #approve-objects').click(function (){
        var form = $('#reportedform');
        form.find('input[name="action"]').val('approve-objects');
        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });

    $('#reportedform #ban-users').click(function (){
        var form = $('#reportedform');
        form.find('input[name="action"]').val('ban-users');

        var checkedModerators = 0;

        //Check user acl
        form.find('.tr .td-chk input[type="checkbox"]:checked').each(function (){
            if($(this).attr('data-acl') != '2'){
                checkedModerators++;
                this.checked = false;
                $('#chk_all').prop('checked', false);
            }
        });

        if(checkedModerators > 0){
            alert('Some users have been unchecked automatically because they are moderators or admins.');
        }

        if(form.find('.tr .td-chk input[type="checkbox"]:checked').size() == 0){
            showMessage(form, 'No data selected!', true);
            return false;
        }
        form.submit();
    });


})(jQuery)