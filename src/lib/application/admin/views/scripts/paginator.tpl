                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="pagination">

{{assign var=pages value=$paginator->getPages()}}
{{if $pages->pageCount}}

{{if $pages->previous}}
  <a href="{{$request->getActionName()}}?page={{$pages->previous}}&{{$searchParams}}" title="Previous Page">&laquo; 前</a>
{{/if}}

<!-- Numbered page links -->
{{foreach from=$pages->pagesInRange item=page}}
  {{if $page != $pages->current}}
    <a href="{{$request->getActionName()}}?page={{$page}}&{{$searchParams}}" class="number" title="{{$page}}">{{$page}}</a>
  {{else}}
    <a href="{{$request->getActionName()}}?page={{$page}}&{{$searchParams}}" class="number current" title="{{$page}}">{{$page}}</a>
  {{/if}}
{{/foreach}}

<!-- Next page link -->
{{if $pages->next}}
  <a href="{{$request->getActionName()}}?page={{$pages->next}}&{{$searchParams}}" title="Next Page">次 &raquo;</a>
{{/if}}

{{/if}}
                                        </div> <!-- End .pagination -->
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>

