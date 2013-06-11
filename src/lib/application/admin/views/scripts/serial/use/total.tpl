            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>使用済シリアル - 集計</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab" id="tab1">

                        <table>

                            <thead>
                                <tr>
                                   <th width="120">日時</th>
                                    {{foreach from=$serials item=serial}}
                                        <th>{{$serial->name}}</th>
                                    {{/foreach}}
                                </tr>
                            </thead>

                            <tbody>
                                {{foreach from=$total item=t}}
                                <tr>
                                    <td>{{$t.date}}</td>
                                    {{foreach from=$t.total item=c}}
                                        <td>{{$c}}</td>
                                    {{/foreach}}
                                </tr>
                                {{/foreach}}
                            </tbody>

                        </table>

                    </div> <!-- End #tab1 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

            <div class="clear"></div>
