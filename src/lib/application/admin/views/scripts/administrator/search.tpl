			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">

					<h3>管理者</h3>

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
								   <th width="60">&nbsp;</th>
								   <th>氏名</th>
								   <th>メールアドレス</th>
								</tr>
							</thead>

                            {{include file="paginator.tpl"}}

							<tbody>
                                {{foreach from=$paginator item=row}}
								<tr>
									<td>
										 <a href="{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/edit?id={{$row.id}}" title="Edit"><img src="{{$request->getBaseUrl()}}/images/icons/pencil.png" alt="Edit" /></a>
                                        &emsp;
                                         <a href="{{$request->getBaseUrl()}}/{{$request->getControllerName()}}/delete?id={{$row.id}}" title="Delete"><img src="{{$request->getBaseUrl()}}/images/icons/cross.png" alt="Delete" /></a>
									</td>
									<td>{{$row.name}}</td>
									<td>{{$row.mail_address}}</td>
								</tr>
                                {{/foreach}}
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
				</div> <!-- End .content-box-content -->

			</div> <!-- End .content-box -->

			<div class="clear"></div>
