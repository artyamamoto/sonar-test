            {{if $preload_template}}
                {{include file=$preload_template}}
            {{/if}}

			<div class="content-box"><!-- Start Content Box -->

				<div class="content-box-header">
					<h3>{{$title}}</h3>
				</div> <!-- End .content-box-header -->

				<div class="content-box-content">

					<div class="tab-content default-tab" id="tab1">

                        <form action="{{form_action}}" method="POST" enctype="multipart/form-data" id="input_form">
                            <input type="hidden" name="release_status" value="{{$request->release_status}}" />
                            {{if $request->getActionName()=='confirm'}}
                                {{include file="parts/hidden.tpl"}}
                            {{elseif $request->getActionName()=='delete'}}
                                <input type="hidden" name="id" value="{{$request->id}}" />
                                <input type="hidden" name="delete" value="1" />
                            {{else}}
                                <input type="hidden" name="id" value="{{$request->id}}" />
                            {{/if}}

							<fieldset>

                                {{foreach from=$table->getForms() key=key item=form}}
                                    {{if !$form.hidden}}
                                    <p>
                                        <label>{{$form.label}}</label>
                                        {{if $form.type == 'textarea'}}
                                            {{form_textarea name=$key rows=$form.rows cols=$form.cols}}
                                        {{elseif $form.type == 'html'}}
                                            {{form_html name=$key}}
                                        {{elseif $form.type == 'select'}}
                                            {{form_select name=$key values=$form.values}}
                                        {{elseif $form.type == 'datetime'}}
                                            {{form_datetime name=$key}}
                                        {{elseif $form.type == 'file'}}
                                            {{form_file name=$key}}
                                        {{elseif $form.type == 'json'}}
                                            {{form_json name=$key}}
                                        {{elseif $form.type == 'role'}}
                                            {{form_role name=$key}}
                                        {{else}}
                                            {{form_text name=$key}}
                                        {{/if}}
                                    </p>
                                    {{/if}}
                                {{/foreach}}

                                {{if $request->getActionName()=='confirm'}}
                                    <p>
                                        {{if $request->release}}
                                            <input class="button" type="submit" value="公開する" />
                                        {{else}}
                                            <input class="button" type="submit" value="保存する" />
                                        {{/if}}
                                        &emsp;
                                        <input class="button" type="submit" name="back" value="修正する" />
                                    </p>
                                {{elseif $request->getActionName()=='delete'}}
                                    <p>
                                        <input class="button" type="submit" value="削除する" />
                                        &emsp;
                                        <input class="button" type="submit" name="search" value="一覧に戻る" />
                                    </p>
                                {{elseif $request->getActionName()=='complete'}}
                                {{elseif $request->getActionName()=='detail'}}
                                {{else}}
                                    <p>
                                        <input class="button" type="submit" value="確認画面へ" />
                                        {{if $request->release_status && ($request->release_status == 1 || $request->release_status == 3 || $request->release_status == 5)}}
                                            &emsp;
                                            <input class="button" type="submit" name="release" value="公開する" />
                                        {{/if}}
                                    </p>
                                {{/if}}

							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
