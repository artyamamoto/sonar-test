{{assign var=title value="お問い合わせﾌｫｰﾑ"}}

<center>ﾌｫｰﾑでのお問い合わせ</center>
<hr>

※以下項目をすべて入力の上､｢送信｣を押してください｡<br>

<font size="-1">※ﾄﾞﾒｲﾝまたはｱﾄﾞﾚｽ指定受信を設定されている方は<font color="#FF0000">{{$domain}}(ﾄﾞﾒｲﾝ)</font>を受信可に設定してください。</font><br>
<br>

<font size="-1" color="#FF0000">
{{foreach key=entry from=$errors item=form}}
    {{foreach key=key from=$form item=err}}
        {{if $err == 'isEmpty' && $entry == 'mailad'}}携帯ﾒｰﾙｱﾄﾞﾚｽを入力してください。<br>
        {{elseif $err == 'regexNotMatch' && $entry == 'mailad'}}携帯ﾒｰﾙｱﾄﾞﾚｽを正しく入力してください。<br>
        {{elseif $err == 'isEmpty' && $entry == 'domain'}}ﾒｰﾙﾄﾞﾒｲﾝを選択してください。<br>
        {{elseif $err == 'isEmpty' && $entry == 'maintext'}}お問い合わせ内容を入力してください。<br>
        {{/if}}
    {{/foreach}}
{{/foreach}}
</font>

<form action='{{$request->getBaseUrl()}}/contact/comp?guid=ON' method='POST'>
■ご連絡ﾒｰﾙｱﾄﾞﾚｽ<br>
<font size="-1">※ﾒｰﾙｱﾄﾞﾚｽを半角文字で入力してください｡</font><br>
<font size="-1" color="#ff0000">※ﾒｰﾙｱﾄﾞﾚｽに誤りがある場合､異なる方に回答ﾒｰﾙが送信されてしまう可能性がございますので､正確に入力をお願いいたします｡</font><br>
<input type='text' name='mailad' size="30" istyle="3" mode="alphabet" maxlength='128' value="{{$request->mailad}}">
<br>
{{if $carrier == 'DoCoMo'}}@docomo.ne.jp<input type="hidden" name="domain" value="@docomo.ne.jp">
{{elseif $carrier == 'disney'}}@disney.ne.jp<input type="hidden" name="domain" value="@disney.ne.jp">
{{elseif $carrier == 'SoftBank'}}@<select name="domain">
                          <option value="">▽お選び下さい</option>
                          <option value="@softbank.ne.jp">softbank.ne.jp</option>
                          <option value="@d.vodafone.ne.jp">d.vodafone.ne.jp</option>
                          <option value="@h.vodafone.ne.jp">h.vodafone.ne.jp</option>
                          <option value="@t.vodafone.ne.jp">t.vodafone.ne.jp</option>
                          <option value="@c.vodafone.ne.jp">c.vodafone.ne.jp</option>
                          <option value="@r.vodafone.ne.jp">r.vodafone.ne.jp</option>
                          <option value="@k.vodafone.ne.jp">k.vodafone.ne.jp</option>
                          <option value="@n.vodafone.ne.jp">n.vodafone.ne.jp</option>
                          <option value="@s.vodafone.ne.jp">s.vodafone.ne.jp</option>
                          <option value="@q.vodafone.ne.jp">q.vodafone.ne.jp</option>
                          </select>
{{elseif $carrier == 'EZweb'}}@ezweb.ne.jp<input type="hidden" name="domain" value="@ezweb.ne.jp">
{{/if}}
<br>
<br>

■お問い合わせ内容<br>
<textarea name='maintext' rows='4' cols='30' ></textarea><br>
<br>

<input type='hidden' name='uid' value="{{$request->uid}}">
<input type='submit' value='送信'>
</form>
<br>
