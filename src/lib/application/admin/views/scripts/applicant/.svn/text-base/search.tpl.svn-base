            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>応募</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab" id="tab1">

                        <div class="bulk-actions align-left">
                            <p>
                                <form action="{{$request->getBaseUrl()}}/applicant/download" method="POST">
                                <input type="submit" value="ダウンロード">
                                </form>
                            </p>
                        </div>
                        <div class="clear"></div>

                        <div class="bulk-actions align-left">
                            <input class="text-input small-input" type="text" id="name" name="name" value="{{$request->name}}" placeholder="氏名" />
                            <a class="button" href="javascript:location.href='{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/search?search[name]=' + $('#name').val()">Search</a>
                        </div>
                        <div class="clear"></div>

                        <div class="bulk-actions align-left">
                            <input class="text-input small-input" type="text" id="mail_address" name="mail_address" value="{{$request->mail_address}}" placeholder="メールアドレス" />
                            <a class="button" href="javascript:location.href='{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/search?search[mail_address]=' + $('#mail_address').val()">Search</a>
                        </div>
                        <div class="clear"></div>

                        <table>

                            <thead>
                                <tr>
                                   <th width="60">&nbsp;</th>
                                   <th>氏名</th>
                                   <th>メールアドレス</th>
                                   <th>キャリア</th>
                                   <th>アプリ</th>
                                </tr>
                            </thead>

                            {{include file="paginator.tpl"}}

                            <tbody>
                                {{foreach from=$paginator item=row}}
                                <tr>
                                    <td>
                                         <a href="{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/detail/id/{{$row.id}}" title="Edit"><img src="{{$request->getBaseUrl()}}/images/icons/information.png" alt="Detail" /></a>
                                    </td>
                                    <td>{{$row.name}}</td>
                                    <td>{{$row.mail_address}}</td>
                                    <td>
                                        {{if $row.carrier == 1}}docomo
                                        {{elseif $row.carrier == 2}}au
                                        {{elseif $row.carrier == 3}}SoftBank
                                        {{elseif $row.carrier == 4}}Android
                                        {{elseif $row.carrier == 5}}iPhone
                                        {{/if}}
                                    </td>
                                    <td>{{$row.app_version}}</td>
                                </tr>
                                {{/foreach}}
                            </tbody>

                        </table>

                    </div> <!-- End #tab1 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

            <div class="clear"></div>
