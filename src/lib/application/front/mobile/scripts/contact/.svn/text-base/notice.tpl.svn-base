{{assign var=title value="お問い合わせﾌｫｰﾑ"}}
{{if $smarty.server.SERVER_NAME == "stage.je-cp.com"}}
    {{assign var=url value=$config->url->stage->secure}}
    {{assign var=url2 value=$config->url->stage->nomal}}
{{else}}
    {{assign var=url value=$config->url->secure}}
    {{assign var=url2 value=$config->url->nomal}}
{{/if}}

<center>お問い合わせﾌｫｰﾑ</center>
<hr>

ｻﾎﾟｰﾄ対応時間:<br>
平日の9時から18時まで<br>
<br>

※ﾄﾞﾒｲﾝまたはｱﾄﾞﾚｽ指定受信を設定されている方は{{$domain}}(ﾄﾞﾒｲﾝ)を受信可に設定してください｡<br>
ご回答ﾒｰﾙを受信することができない場合がございます｡<br>
<br>

<font color="#FF0000">※お問い合わせﾌｫｰﾑにて､お客様のﾒｰﾙｱﾄﾞﾚｽが正しく入力されているか必ず確認を行ってください｡<br>
ﾒｰﾙｱﾄﾞﾚｽに不備があった場合､こちらから返信を行うことができません｡</font><br>
<br>

<form action="https://{{$url}}/contact/form" method="post">
<input type="hidden" name="uid" value="{{$uid}}">
<center><input type="submit" value="SSL対応ﾌｫｰﾑはこちら" /></center>
</form>
<br>

<form action="http://{{$url2}}/contact/form?guid=ON" method="post">
<input type="hidden" name="uid" value="{{$uid}}">
<center><input type="submit" value="SSL非対応ﾌｫｰﾑはこちら" /></center>
</form>
<br>

※SSLとは個人情報等のﾃﾞｰﾀを暗号化して､安全に通信を行うための技術です｡<br>
<br>
