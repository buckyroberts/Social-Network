(function ($){
    //Delete Album
    $(document).on('click', '.delete-album-link', function (){
        if(confirm('Are you sure that you want to delete this album?')){
            var link = $(this);
            link.html('<img src="/images/loading1.gif" alt="..." />');
            $.ajax({
                url: "/photo_albums.php",
                type: 'post',
                data: "albumID=" + link.attr('data-id') + '&action=delete-album',
                success: function (rsp){
                    if(rsp == 'success'){
                        link.parents('.tr').fadeOut('fast', function (){
                            $(this).remove();
                            if($('#album-list').find('.tr').size() < 1){
                                $('#album-list').append('<div class="tr noborder">Nothing to see here.</div>');
                            }
                        })
                    }
                },
                error: function (err){

                }
            })
        }
    })

    //Album View Page
    $(document).ready(function (){
        /*$('#responsive-slider').advancedSlider({width: 500,
         height: 500,
         responsive: true,
         skin: 'glossy-square-gray',
         shadow: false,
         effectType: 'swipe',
         slideshow: true,
         pauseSlideshowOnHover: true,
         swipeThreshold: 30,
         slideButtons: false,
         thumbnailType: 'scroller',
         thumbnailWidth: 100,
         thumbnailHeight: 100,
         thumbnailButtons: true,
         thumbnailSwipe: true,
         thumbnailScrollerResponsive: true,
         minimumVisibleThumbnails: 2,
         maximumVisibleThumbnails: 5,
         keyboardNavigation: true
         });*/
    })

    //Album Edit Page
    //Remove Photo From Album
    $(document).on('click', '#myphotos .photo', function (){
        var photo = $(this);
        var link = $(this).find('a');
        photo.find('.loading-wrapper').show();
        var action = link.attr('class');
        $.ajax({
            url: '/photo_album_edit.php',
            type: 'post',
            data: 'albumID=' + $('#albumID').val() + '&photoID=' + link.attr('data-id') + '&action=' + action,
            success: function (rsp){
                photo.find('.loading-wrapper').fadeOut('fast');
                if(rsp == 'success'){
                    if(action == 'remove-from-album'){
                        link.attr('class', 'add-to-album').html('Add').attr('title', 'Add to Album');
                        photo.removeClass('photo-checked').attr('title', 'Add to Album');
                    }else{
                        link.attr('class', 'remove-from-album').html('Remove').attr('title', 'Remove from Album');
                        photo.addClass('photo-checked').attr('title', 'Remove from Album');
                    }
                }else{
                    alert("Error: " + rsp);
                }
            }
        })
        return false;
    })
})(jQuery)