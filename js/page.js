/**
 * Page.js
 */


var hideCallbackFunc = '';
var sideBarOverflowSetting = '';

var LINK_TITLE_PLACEHOLDER = 'Link Title';
var LINK_LINK_PLACEHOLDER = 'http://';

function showPageMask(callback){
    if(jQuery("body").find('.page-mask').length == 0)
        jQuery("body").append('<div class="page-mask"></div>');

    jQuery('.page-mask').height(jQuery(document).outerHeight());

    hideCallbackFunc = callback;
}

function hidePageMask(){
    jQuery(".page-mask").remove();
}

function hideEditAboutPanel(){
    jQuery("#about_text_display").show();
    jQuery(".about-text-edit-panel").hide();
}

function hideEditPageTitlePanel(){
    jQuery("#page_title_display").show();
    jQuery(".page-title-edit-panel").hide();
}

function hideEditPageLinksPanel(){
    $("#page_link_display").show();
    $(".page-link-edit-panel").hide();
    $("#main_aside").css('overflow', sideBarOverflowSetting);
}

/**
 * It will create edit links panel with var pageLinkList
 */
function createEditLinkPanel(){

    jQuery("#edit_link_node_panel").html("");
    if(typeof pageLinkList !== 'undefined'){
        if(pageLinkList.length > 0){
            //display existing links

            for(idx = 0; idx < pageLinkList.length; idx++){
                createNewNodeInLinkPanel(pageLinkList[idx].title, pageLinkList[idx].link);
            }
        }
    }
    //Add last empty edit box
    createNewNodeInLinkPanel('', '');
}

function createNewNodeInLinkPanel(title, link){

    if(title == '')
        title = LINK_TITLE_PLACEHOLDER;
    if(link == '')
        link = LINK_LINK_PLACEHOLDER;

    jQuery("#edit_link_node_panel").append('<div class="node"><input type="text" class="link-title" value="' + title + '"><input type="text" class="link-link" value="' + link + '"><a href="javascript:void(0);" class="redLink remove-node">Remove</a><div class="clear"></div></div>');
    jQuery('.page-mask').height(jQuery(document).outerHeight());
}


(function ($){

    $(document).ready(function (){

        $(document).on('click', '.page-mask', function (){
            hidePageMask();
            if(typeof hideCallbackFunc === 'function')
                hideCallbackFunc();
        });


        $(".delete-this-page-btn").click(function (){
            if(confirm('Are you sure you want to delete this page?')){
                document.location.href = "/page.php?pid=" + $("#currentPageID").val() + "&action=delete";
            }
        });


        /* Edit about section handle */
        $("#edit_about_btn").click(function (){
            $("#about_text_display").hide();
            $(".about-text-edit-panel").show();
            showPageMask(hideEditAboutPanel);
        });

        $("#save_about_text").click(function (){
            if($("#about_text_input").val() == ''){
                alert("Please input about");
                $("#about_text_input").focus();
            }else{
                $.ajax({
                    url: '/page.php', data: {
                        action: 'updateAbout', pageID: $("#currentPageID").val(), content: $("#about_text_input").val()
                    }, type: 'post', success: function (rsp){
                        var responseObj = $.parseJSON(rsp);
                        if(responseObj.success == 1){
                            showMessage($('#right_side'), responseObj.msg, false);
                            $("#about_text_display").html(responseObj.content_display);
                            $("#about_text_input").val(responseObj.content);
                        }else{
                            showMessage($('#right_side'), responseObj.msg, true);
                        }

                        $(".page-mask").trigger('click');

                        hideMessage($('#right_side'), 4);

                    }
                });
            }
        });


        /* Edit page title section handle */
        $("#edit_page_title_btn").click(function (){
            $("#page_title_display").hide();
            $(".page-title-edit-panel").show();
            showPageMask(hideEditPageTitlePanel);
        });

        $("#save_page_title").click(function (){
            if($("#page_title_input").val() == ''){
                alert("Please input page title");
                $("#page_title_input").focus();
            }else{
                $.ajax({
                    url: '/page.php', data: {
                        action: 'updatePageTitle',
                        pageID: $("#currentPageID").val(),
                        content: $("#page_title_input").val()
                    }, type: 'post', success: function (rsp){
                        var responseObj = $.parseJSON(rsp);
                        if(responseObj.success == 1){
                            showMessage($('#right_side'), responseObj.msg, false);
                            $("#page_title_display span").html(responseObj.content);
                            $("#page_title_input").val(responseObj.content);
                        }else{
                            showMessage($('#right_side'), responseObj.msg, true);
                        }

                        $(".page-mask").trigger('click');

                        hideMessage($('#right_side'), 4);

                    }
                });
            }
        });


        /* Edit page link section handle */
        $("#edit_link_btn").click(function (){

            sideBarOverflowSetting = $("#main_aside").css('overflow');
            $("#main_aside").css('overflow', '');
            $("#page_link_display").hide();
            $(".page-link-edit-panel").show();
            showPageMask(hideEditPageLinksPanel);

            createEditLinkPanel();

        });

        $("#add_new_link_btn").click(function (){
            createNewNodeInLinkPanel('', '');
        });

        $(document).on('click', '#edit_link_node_panel .node .remove-node', function (){
            $(this).parent().remove();
        });
        $(document).on('focus', '#edit_link_node_panel .node .link-title', function (){
            if($(this).val() == LINK_TITLE_PLACEHOLDER)
                $(this).val('');
        });
        $(document).on('blur', '#edit_link_node_panel .node .link-title', function (){
            if($(this).val() == '')
                $(this).val(LINK_TITLE_PLACEHOLDER);
        });
        $(document).on('focus', '#edit_link_node_panel .node .link-link', function (){
            if($(this).val() == LINK_LINK_PLACEHOLDER)
                $(this).val('');
        });
        $(document).on('blur', '#edit_link_node_panel .node .link-link', function (){
            if($(this).val() == '')
                $(this).val(LINK_LINK_PLACEHOLDER);
        });

        $("#save_page_links").click(function (){


            var newLinkList = [];
            //Read content
            $("#edit_link_node_panel .node").each(function (){
                var titleVal = $(this).find('.link-title').val();
                var linkVal = $(this).find('.link-link').val();

                if(titleVal != '' && titleVal != LINK_TITLE_PLACEHOLDER && linkVal != '' && linkVal != LINK_LINK_PLACEHOLDER){
                    newLinkList.push({'title': titleVal, 'link': linkVal});
                }
            });

            $.ajax({
                url: '/page.php',
                data: {action: 'updatePageLinks', pageID: $("#currentPageID").val(), content: newLinkList},
                type: 'post',
                success: function (rsp){
                    var responseObj = $.parseJSON(rsp);
                    if(responseObj.success == 1){
                        showMessage($('#right_side'), responseObj.msg, false);
                        $("#page_link_display").html(responseObj.html);
                        pageLinkList = responseObj.jsonLinks;
                    }else{
                        showMessage($('#right_side'), responseObj.msg, true);
                    }

                    $(".page-mask").trigger('click');

                    hideMessage($('#right_side'), 4);

                }
            });
        });


    });


})(jQuery);




