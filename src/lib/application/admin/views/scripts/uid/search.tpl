            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>当選者データ</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab" id="tab1">

                        <div class="bulk-actions align-left">
                            <input class="text-input small-input" type="text" id="name" name="name" value="{{$request->name}}" />
                            <a class="button" href="javascript:location.href='{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/search?name=' + $('#name').val()">Search</a>
                        </div>
                        <div class="clear"></div>

                        <table>

                            <thead>
                                <tr>
                                   <th>UID</th>
                                   <th>ハッシュ</th>
                                   <th>メールアドレス</th>
                                   <th>氏名</th>
                                   <th>氏名（子供）</th>
                                </tr>
                            </thead>

                            {{include file="paginator.tpl"}}

                            <tbody>
                                {{foreach from=$paginator item=row}}
                                <tr>
                                    <td>{{$row.uid}}</td>
                                    <td>{{$row.hash}}</td>
                                    <td>{{$row.mail_address}}</td>
                                    <td>{{$row.name1}} {{$row.name2}}</td>
                                    <td>{{$row.pair_name1}} {{$row.pair_name2}}</td>
                                </tr>
                                {{/foreach}}
                            </tbody>

                        </table>

                    </div> <!-- End #tab1 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

            <div class="clear"></div>
