            <div class="content-box"><!-- Start Content Box -->

                <div class="content-box-header">

                    <h3>当選者登録 - 集計</h3>

                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab" id="tab1">

                        <table>

                            <thead>
                                <tr>
                                   <th width="200">日時</th>
                                   <th>登録数</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{foreach from=$total item=t}}
                                <tr>
                                    <td>{{$t.date}}</td>
                                    <td>{{$t.count}}</td>
                                </tr>
                                {{/foreach}}
                            </tbody>

                        </table>

                    </div> <!-- End #tab1 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

            <div class="clear"></div>
