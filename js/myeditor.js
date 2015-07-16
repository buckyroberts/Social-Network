/**
 * Simple Editor Plugin
 *
 */
(function ($, win, doc){

    var MyEditor = function (element, options){
        var $caret = $(element);

        var $controller = $('<span class="editor-controlls">' + '<a href="#" class="ectrl-bold" title="Bold">B</a>' + '<a href="#" class="ectrl-italic">I</a>' + '<a href="#" class="ectrl-underline">U</a>' + '<a href="#" class="ectrl-link">link</a>' + '<a href="#" class="ectrl-ordered-list">Ordered list</a>' + '<a href="#" class="ectrl-unordered-list">Unordered list</a>' + '<a href="#" class="ectrl-img">Image</a>' + '<a href="#" class="ectrl-code">Code</a>' + '</span>');

        //Add Editor Controlls
        $caret.before($controller);

        var caretGetInfo = function (element){
            var res = {
                text: '', start: 0, end: 0
            };

            if(!element.value){
                return res;
            }

            try{
                if(win.getSelection){
                    /* All Browsers Except IE */
                    res.start = element.selectionStart;
                    res.end = element.selectionEnd;
                    res.text = element.value.slice(res.start, res.end);
                }else
                    if(doc.selection){
                        /* For IE */
                        element.focus();

                        var range = doc.selection.createRange(), range2 = doc.body.createTextRange(), tmpLength;

                        res.text = range.text;

                        try{
                            range2.moveToElementText(element);
                            range2.setEndPoint('StartToStart', range);
                        }catch(e){
                            range2 = element.createTextRange();
                            range2.setEndPoint('StartToStart', range);
                        }

                        res.start = element.value.length - range2.text.length;
                        res.end = res.start + range.text.length;
                    }
            }catch(e){

            }

            return res;
        };

        var caretGetPos = function (element){
            var tmp = caretGetInfo(element);
            return {start: tmp.start, end: tmp.end};
        }

        var caretSetPos = function (element, toRange, caret){
            caret = _caretMode(caret);

            if(caret == 'start'){
                toRange.end = toRange.start;
            }else
                if(caret == 'end'){
                    toRange.start = toRange.end;
                }

            element.focus();
            try{
                if(element.createTextRange){
                    var range = element.createTextRange();

                    if(win.navigator.userAgent.toLowerCase().indexOf("msie") >= 0){
                        toRange.start = element.value.substr(0, toRange.start).replace(/\r/g, '').length;
                        toRange.end = element.value.substr(0, toRange.end).replace(/\r/g, '').length;
                    }

                    range.collapse(true);
                    range.moveStart('character', toRange.start);
                    range.moveEnd('character', toRange.end - toRange.start);

                    range.select();
                }else
                    if(element.setSelectionRange){
                        element.setSelectionRange(toRange.start, toRange.end);
                    }
            }catch(e){

            }

            function _caretMode(caret){
                caret = caret || "keep";
                if(caret == false){
                    caret = 'end';
                }

                switch(caret){
                    case 'keep':
                    case 'start':
                    case 'end':
                        break;

                    default:
                        caret = 'keep';
                }

                return caret;
            }
        }

        var careetGetText = function (element){
            return caretGetInfo(element).text;
        }

        var caretReplace = function (element, text, caret){
            var tmp = caretGetInfo(element), orig = element.value, pos = $(element).scrollTop(), range = {
                start: tmp.start, end: tmp.start + text.length
            };

            element.value = orig.substr(0, tmp.start) + text + orig.substr(tmp.end);

            $(element).scrollTop(pos);
            caretSetPos(element, range, caret);
        }

        var caretInsertBefore = function (element, text, caret){
            var tmp = caretGetInfo(element), orig = element.value, pos = $(element).scrollTop(), range = {
                start: tmp.start + text.length, end: tmp.end + text.length
            };

            element.value = orig.substr(0, tmp.start) + text + orig.substr(tmp.start);

            $(element).scrollTop(pos);
            caretSetPos(element, range, caret);
        }

        var caretInsertAfter = function (element, text, caret){
            var tmp = caretGetInfo(element), orig = element.value, pos = $(element).scrollTop(), range = {
                start: tmp.start, end: tmp.end
            };

            element.value = orig.substr(0, tmp.end) + text + orig.substr(tmp.end);

            $(element).scrollTop(pos);
            caretSetPos(element, range, caret);
        }


        $controller.find('.ectrl-bold').click(function (){
            //Getting Current Option
            var tmp = caretGetInfo($caret[0]), org = $caret.val(), pos = $caret.scrollTop(), range = {
                start: tmp.start + 3, end: tmp.end + 3
            };
            alert(org.search(/([b][\/b])/i));
            $caret.val(org.substring(0, tmp.start) + '[b]' + org.substring(tmp.start, tmp.end) + '[/b]' + org.substring(tmp.end));
            $caret.scrollTop(pos);
            caretSetPos($caret[0], range, 'keep');
            return false;
        })

    }

    $.fn.myEditor = function (options){

        return this.each(function (key, value){
            var element = $(this);
            //Return early if this element already has a plugin instance
            if(element.data('myeditor'))    return element.data('myeditor');
            //Pass options to plugin constructor
            var myeditor = new MyEditor(this, options);
            //Store plugin object  in this element's data
            element.data('myeditor', myeditor);
        })
    }

})(jQuery, window, window.document)