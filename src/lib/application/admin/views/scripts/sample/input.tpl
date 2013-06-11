{{assign var=title value="コラム"}}


            <ul class="shortcut-buttons-set">
                {{foreach from=$config->artists item=artist}}
                <li><a class="shortcut-button" href="#"><span>
                    {{$artist->name}}
                </span></a></li>
                {{/foreach}}
            </ul>
            <div class="clear"></div>

{{include file="parts/input.tpl"}}
