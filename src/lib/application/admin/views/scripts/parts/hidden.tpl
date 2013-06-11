{{strip}}
{{foreach from=$request->getParams() key=name item=value}}
    {{if is_array($value)}}
        {{foreach from=$value key=name1 item=value1}}
            {{if is_array($value1)}}
                {{foreach from=$value1 key=name2 item=value2}}
                    <input type="hidden" name="{{$name}}[{{$name1}}][{{$name2}}]" value="{{$value2|smarty:nodefaults}}">
                {{/foreach}}
            {{else}}
                <input type="hidden" name="{{$name}}[{{$name1}}]" value="{{$value1|smarty:nodefaults}}">
            {{/if}}
        {{/foreach}}
    {{else}}
        <input type="hidden" name="{{$name}}" value="{{$value|smarty:nodefaults}}">
    {{/if}}
{{/foreach}}
{{/strip}}
