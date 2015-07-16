/**
 * Search Related Parts
 */
(function ($){

    $('#pp_search_form').submit(function (){

        var fieldList = ['pp_search_q', 'pp_search_type', 'pp_search_sortby'];
        var nodeCount = 0;
        for(idx = 0; idx < fieldList.length; idx++){
            if($("#" + fieldList[idx]).val() == ''){
                $("#" + fieldList[idx]).attr('disabled', true);
                nodeCount++;
            }
        }

        if(nodeCount == fieldList.length){
            document.location.href = $(this).attr("action");
            return false;
        }

        return true;
    });

    $(document).ready(function (){

        $(document).on('change', '#pp_search_type', function (){
            setTimeout(function (){
                if($('#pp_search_type').val() != 0 && $('#pp_search_sortby').val() == 'reputation')
                    $('#pp_search_sortby').val('pop');

                $('#pp_search_form').submit();
            }, 300);
        });

        $(document).on('change', '#pp_search_sortby', function (){
            if($(this).val() == 'reputation')
                $('#pp_search_type').val(0);
            $('#pp_search_form').submit();
        });

    });


})(jQuery);
