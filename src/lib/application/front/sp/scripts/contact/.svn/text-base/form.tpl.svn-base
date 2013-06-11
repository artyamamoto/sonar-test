{{assign var=title value="お問い合わせ"}}
    <div data-role="content">
        <p style="font-size:80%">
            以下該当の項目を入力の上、「送信」をタップして下さい。
        </p>
        <br />

        <p style="font-size:80%;color:#ff0000;">
            {{foreach key=entry from=$errors item=form}}
                {{foreach key=key from=$form item=err}}
                    {{if $err == 'isEmpty' && $entry == 'mail_address'}}ご連絡先メールアドレスを入力して下さい。<br />
                    {{elseif $err == 'isEmpty' && $entry == 'contents'}}お問い合わせ内容を入力して下さい。<br />
                    {{/if}}
                {{/foreach}}
            {{/foreach}}
        </p>
        <p style="margin-top:15px;font-size:80%;">
            <form action="{{$request->getBaseUrl()}}/contact/comp/" method="POST">
                <label for="mail_address"><span class="yellow">●</span>ご連絡先メールアドレス<span style="font-size:80%"><br />「{{$domain}}」を受信出来るよう、予め設定をお願い致します。</span><br /><span style="color:#ff0000;font-size:80%">メールアドレスに異なりがある場合、異なる方に回答メールが送信されてしまう可能性がございますので、正確に入力をお願い致します。</span></label><br />
                <input type="text" id="mail_address" name="mail_address" value="{{$request->mail_address}}" /><br />

                <label for="contents"><span class="yellow">●</span>お問い合わせ内容<span style="color:#c0c0c0;font-size:80%;"><br />絵文字の使用はご遠慮ください。</span></label><br />
                <textarea name='contents' rows='4' cols='30' >{{$request->contents}}</textarea><br />

                <input type="hidden" name="user_id" value="{{$request->user_id}}" />
                <input type="hidden" name="member_id" value="{{$request->member_id}}" />
                <input type="submit" value="送信" />
            </form>
        </p>
    </div>
