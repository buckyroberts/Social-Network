(function ($){



    //Create Publisher ADS
    /*$('.colorpicker-input').each(function(){
     var fColor = $(this).attr('data-color');
     $(this).ColorPicker({color: fColor});
     })*/
    $('.colorpickerholder-wrap').each(function (){
        var cpW = $(this);
        var fColor = cpW.find('.colorpicker-input').val();

        $(this).find('.colorpickerholder').ColorPicker({
            color: fColor, flat: true, onChange: function (hsb, hex, rgb){
                cpW.find('.colorselect').css('background-color', '#' + hex);
                cpW.find('.colorpicker-input').val(hex);
                $('#buckysroom-ads-preview table').css({
                    'border-color': '#' + $('#border-color').val(), 'background-color': '#' + $('#bg-color').val()
                });
                $('#buckysroom-ads-preview table .bsroom-ad-title').css({'color': '#' + $('#title-color').val()});
                $('#buckysroom-ads-preview table .bsroom-ad-desc').css({'color': '#' + $('#description-color').val()});
                $('#buckysroom-ads-preview table .bsroom-ad-link').css({'color': '#' + $('#url-color').val()});
            }
        });
        cpW.find('.colorselect').css('background-color', '#' + fColor);
        cpW.find('.colorselect').on('click', function (e){
            //Hide Other colorpicker
            $('.colorpickerholder').not(cpW.find('.colorpickerholder')).fadeOut('fast');
            cpW.find('.colorpickerholder').stop().fadeToggle('fast');
            e.stopPropagation();
        });

        cpW.find('.colorpicker-input').on('input', function (){
            $(this).parent().find('.colorselect').css('background-color', '#' + $(this).val());
            $(this).parent().find('.colorpickerholder').ColorPickerSetColor($(this).val());
        })
    })

    $('.colorpickerholder').on('click', function (e){
        e.stopPropagation();
    })
    $('body').on('click', function (){
        $('.colorpickerholder').fadeOut('fast');
    })

    function updateAdPreview(){
        var option = $('#publisherAdForm #size option:selected');
        var ads = parseInt(option.attr('ads'));
        var customClass = option.attr('custom_css');

        if(option.attr('type') == 'horizontal'){
            $('#buckysroom-ads-preview table').html('<tr></tr>');
            for(var i = 0; i < ads; i++){
                $('#buckysroom-ads-preview table tr').append('<td valign="middle"><div class="buckysroom-ad ' + customClass + '">' + '<p class="bsroom-ad-title">Buy New Laptops</p>' + '<p class="bsroom-ad-desc">Buy laptops, desktops, iPads and more for low prices!</p>' + '<a href="#" class="bsroom-ad-link">www.amazon.com/laptops</a>' + '</div></td>');
            }
        }else{
            $('#buckysroom-ads-preview table').html('');
            for(var i = 0; i < ads; i++){
                $('#buckysroom-ads-preview table').append('<tr><td valign="middle"><div class="buckysroom-ad ' + customClass + '">' + '<p class="bsroom-ad-title">Buy New Laptops</p>' + '<p class="bsroom-ad-desc">Buy laptops, desktops, iPads and more for low prices!</p>' + '<a href="#" class="bsroom-ad-link">www.amazon.com/laptops</a>' + '</div></td></tr>');
            }
        }

        $('#buckysroom-ads-preview table').css({
            'width': option.attr('data-width') + 'px',
            'height': option.attr('data-height') + 'px',
            'border-color': '#' + $('#border-color').val(),
            'background-color': '#' + $('#bg-color').val()
        });
        $('#buckysroom-ads-preview table .bsroom-ad-title').css({'color': '#' + $('#title-color').val()});
        $('#buckysroom-ads-preview table .bsroom-ad-desc').css({'color': '#' + $('#description-color').val()});
        $('#buckysroom-ads-preview table .bsroom-ad-link').css({'color': '#' + $('#url-color').val()});
    }

    $('#publisherAdForm #size').on('change', function (){
        updateAdPreview();
    })

    //Save Text Ad
    $('#publisherAdForm').submit(function (){
        var tfValid = true;

        if($('#publisherAdForm #name').val() == ''){
            $('#publisherAdForm #name').addClass('input-error');
            tfValid = false;
        }

        if(!tfValid){
            showMessage(this, 'Please complete the fields in red.', true);
        }else{
            $('#publisherAdForm .loading-wrapper').show();
        }

        return tfValid;
    })


})(jQuery)
