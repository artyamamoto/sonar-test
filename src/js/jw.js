$(document).ready(function(){
    Jw.init();
});

var Jw = {
    "init" : function() {
        this.convertList();
    },

    // aタグのdata-role="list"をulタグに変換
    "convertList" : function() {
        $("a").each(function(){
            if($(this).data('role') != 'list') {
                return;
            }

            Jw.convertListTag(this);
        });
    },

    "convertListTag" : function(obj) {
        var li = $('<li></li>').append($(obj).clone());

        var prev = obj;
        var removes = [];
        do {
            prev = prev.previousSibling;
            removes.push(prev);
        } while(prev && (prev.nodeValue == "\n" || $(prev).attr('tagName') == 'BR'));

        var ul;
        if($(prev).attr('tagName') == 'UL') {
            ul = $(prev);
            for(var i in removes) {
                $(removes[i]).remove();
            }
        } else {
            ul = $('<ul data-role="listview" class="ui-listview" style="margin-top:15px"></ul>');
        }
        ul.append(li);


        $(obj).before(ul);
        $(obj).remove();
    }
};

