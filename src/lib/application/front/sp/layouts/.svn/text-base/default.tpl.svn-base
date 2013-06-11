<!DOCTYPE html>
<html lang="ja">
<head>
<title>お問合せ</title>
<meta charset="UTF-8" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/common.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/emoji.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/jw_popup.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/jquery.mobile.theme.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/jquery.mobile.min.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/jquery.mobile.custom.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/sp.css" />
<link rel="stylesheet" href="{{$request->getBaseUrl()}}/styles/jquery.mobile.theme.custom.css" />
<script src="{{$request->getBaseUrl()}}/js/jquery.min.js"></script>
<script src="{{$request->getBaseUrl()}}/js/jw.js"></script>
<script src="{{$request->getBaseUrl()}}/js/jquery.json.min.js"></script>
<script src="{{$request->getBaseUrl()}}/js/jw_popup.js"></script>
<script src="{{$request->getBaseUrl()}}/js/swfobject.js"></script>
<script src="{{$request->getBaseUrl()}}/js/jquery.scrollTo-min.js"></script>
<script type="text/javascript">
$(document).bind("mobileinit", function(){
    $.mobile.ajaxEnabled = false;
});

</script>
<script src="{{$request->getBaseUrl()}}/js/jquery.mobile.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    JwPopup.init();

    $("a").each(function(){
        $(this).blur();
    });

    if(!('createTouch' in document) && !('ontouchstart' in document)) {
        //$('body').empty();
    }
});
</script>
<body>
<div data-role="page" id="index" data-theme="y">
    {{if $title}}
    <div data-backbtn="false" data-theme="h" data-role="header">
        <h1>{{$title|smarty:nodefaults}}</h1>
        {{**
        <a href="{{$request->getBaseUrl()}}/" data-icon="back" class="ui-btn-right">Top</a>
        **}}
    </div>
    {{/if}}

    {{$layout.content|smarty:nodefaults}}
</div>
</body>
</html>
