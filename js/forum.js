/**
 * Forum
 */
(function ($){

    $(document).ready(function (){
        //Replace Forum Images
        $(".buckys-bbcode-content img").each(function (){
            $(this).replaceWith('<a href="' + $(this).attr('src') + '" target="_blank"><img src="' + $(this).attr('src') + '" alt="" /></a>');
        })

        $(".delete_topic_btn").click(function (){
            if(confirm('Are you sure to delete this topic?')){
                document.location.href = $(this).attr('rel');
            }else{
                return false;
            }
        });

        $(".delete_topic_reply_btn").click(function (){
            if(confirm('Are you sure to delete this reply?')){


                var link = $(this);
                link.html('<img src="/images/loading1.gif" alt="..." />');

                $.ajax({
                    url: link.attr('href'), type: 'get', success: function (rsp){
                        if(rsp == 'success'){
                            link.parents('.reply-tr').fadeOut(function (){
                                $(this).remove();
                            });

                            location.reload(true);

                        }else{
                            link.html('Delete');
                            link.parents('td').find('.topic-edit-btn-cont').after('<p class="message error">' + rsp + '</p>')
                        }
                    }
                });


                return false;
            }else{
                return false;
            }
        });

        if($('.buckys-bbcode-content').length > 0){
            //Create Invisible Editor to convert bbcode to html
            /*$('body').append('<div style="display: none; visible: hidden;"><textarea id="hidden-editor"></textarea></div>');
             jQuery('#hidden-editor').sceditor({
             plugins: 'bbcode',
             parserOptions: {bbcodeTrim: false},
             emoticonsRoot: '/images/',
             style: "/css/sceditor/jquery.sceditor.default.css"
             });
             $('.buckys-bbcode-content').each(function(){
             $(this).html( jQuery('#hidden-editor').sceditor('instance').fromBBCode($('.buckys-bbcode-content').html(), false) );
             })*/

        }
    });

    hljs.configure({useBR: true});
    jQuery('.buckys-bbcode-content code').each(function (i, block){
        /* $(this).html($(this).html().replace(/“/g, '"')); */
        hljs.initHighlightingOnLoad(block);
    })

})(jQuery);

