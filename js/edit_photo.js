(function ($){
    $(document).ready(function (){
        var jcropObj = null;
        var x1 = 0, y1 = 0, x2 = 230, y2 = 230;

        /****
         * Photo Edit Form
         */
        $('#editphotoform #photo_visibility_profile').click(function (){
            if(($('#jcrop-row img').width() != 230 || $('#jcrop-row img').height() != 230) && jcropObj == null){
                $('#editphotoform').append('<input type="hidden" name="x1" value="0" />');
                $('#editphotoform').append('<input type="hidden" name="x2" value="230" />');
                $('#editphotoform').append('<input type="hidden" name="y1" value="0" />');
                $('#editphotoform').append('<input type="hidden" name="y2" value="230" />');
                $('#jcrop-row img').attr('src', $('#jcrop-row img').attr('src').replace('resized', 'original')).attr('style', 'width: 100%');
                if(jcropObj != null)
                    jcropObj.destroy();

                $('#jcrop-row img').Jcrop({
                    aspectRatio: 1, allowSelect: false, minSize: [50, 50], onChange: function (c){
                        x1 = c.x;
                        x2 = c.x2;
                        y1 = c.y;
                        y2 = c.y2;
                        $('#editphotoform input[name="x1"]').val(c.x);
                        $('#editphotoform input[name="x2"]').val(c.x2);
                        $('#editphotoform input[name="y1"]').val(c.y);
                        $('#editphotoform input[name="y2"]').val(c.y2);
                    }
                }, function (){
                    jcropObj = this;
                    jcropObj.animateTo([0, 0, 230, 230]);
                });
            }
        });
        $('#editphotoform #photo_visibility_public, #editphotoform #photo_visibility_private').click(function (){
            if(jcropObj != null){
                $('#jcrop-row img').attr('src', $('#jcrop-row img').attr('src').replace('original', 'resized')).attr('style', '');
                jcropObj.destroy();
                jcropObj = null;
                $('#editphotoform input[name="x1"]').remove();
                $('#editphotoform input[name="x2"]').remove();
                $('#editphotoform input[name="y1"]').remove();
                $('#editphotoform input[name="y2"]').remove();
            }
        });
        if(set_profile == '1'){
            $('#editphotoform').append('<input type="hidden" name="x1" value="0" />');
            $('#editphotoform').append('<input type="hidden" name="x2" value="230" />');
            $('#editphotoform').append('<input type="hidden" name="y1" value="0" />');
            $('#editphotoform').append('<input type="hidden" name="y2" value="230" />');
            $('#jcrop-row img').attr('src', $('#jcrop-row img').attr('src').replace('resized', 'original')).attr('style', 'width: 100%');
            if(jcropObj != null)
                jcropObj.destroy();

            $('#jcrop-row img').Jcrop({
                aspectRatio: 1, allowSelect: false, minSize: [50, 50], onChange: function (c){
                    x1 = c.x;
                    x2 = c.x2;
                    y1 = c.y;
                    y2 = c.y2;
                    $('#editphotoform input[name="x1"]').val(c.x);
                    $('#editphotoform input[name="x2"]').val(c.x2);
                    $('#editphotoform input[name="y1"]').val(c.y);
                    $('#editphotoform input[name="y2"]').val(c.y2);
                }
            }, function (){
                jcropObj = this;
                jcropObj.animateTo([0, 0, 230, 230]);
            });
        }
    })
})(jQuery)