            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>使用済シリアル</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab" id="tab1">

                        <div class="bulk-actions align-left">
                            <p>
                                <form action="{{$request->getBaseUrl()}}/serial_use/download" method="POST">
                                <input type="submit" value="ダウンロード">
                                </form>
                            </p>
                        </div>
                        <div class="clear"></div>

                        <div class="bulk-actions align-left">
                            <input class="text-input small-input" type="text" id="name" name="search[n]" value="{{$request->search.n}}" />
                            <a class="button" href="javascript:location.href='{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/search?search[n]=' + $('#name').val()">Search</a>
                        </div>
                        <div class="clear"></div>

                        <table>

                            <thead>
                                <tr>
                                   <th width="60">&nbsp;</th>
                                   <th>シリアル</th>
                                   <th>code</th>
                                   <th>対象</th>
                                   <th>UID</th>
                                </tr>
                            </thead>

                            {{include file="paginator.tpl"}}

                            <tbody>
                                {{foreach from=$paginator item=row}}
                                <tr>
                                    <td>
                                         <a href="{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/delete?id={{$row.id}}" title="Delete"><img src="{{$request->getBaseUrl()}}/images/icons/cross.png" alt="Delete" /></a>
                                    </td>
                                    <td>{{$row.n}}</td>
                                    <td>{{$row.code}}</td>
                                    <td>{{$row.target}}</td>
                                    <td>{{$row.uid}}</td>
                                </tr>
                                {{/foreach}}
                            </tbody>

                        </table>

                    </div> <!-- End #tab1 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

            <div class="clear"></div>
