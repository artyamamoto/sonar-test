            <h1 id="sidebar-title"><a href="{{$request->getBaseUrl()}}/">{{$config->system->sitename}}</a></h1>

            <a href="{{$request->getBaseUrl()}}/"><img id="logo" src="{{$request->getBaseUrl()}}/images/logo.png" alt="{{$config->system->sitename}}" /></a>

            <!-- Sidebar Profile links -->
            <div id="profile-links">
                Hello, {{$administrator->name}}<br />
{{**
                Hello, <a href="#" title="Edit your profile">John Doe</a><br />
                <br />
                <a href="#" title="View the Site">View the Site</a> | <a href="#" title="Sign Out">Sign Out</a>
**}}
            </div>

            <ul id="main-nav">
                {{if $administrator->role|has_role:"ROLE_ADMINISTRATOR"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="administrator"}} current{{/if}}">管理者</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/administrator/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/administrator/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_SETTING"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="setting"}} current{{/if}}">設定</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/setting/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/setting/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_SETTING"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="color"}} current{{/if}}">色設定</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/color/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/color/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_TEMPLATE"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="page"}} current{{/if}}">テンプレート</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/page/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/page/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_ACTION"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="action"}} current{{/if}}">アクション</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/action/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/action/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_ACTION"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="mail_template"}} current{{/if}}">メールテンプレート</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/mail_template/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/mail_template/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_SETTING"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="serial"}} current{{/if}}">シリアル</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/serial/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/serial/new">新規登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_SERIAL"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="serial_use"}} current{{/if}}">使用済シリアル</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/serial_use/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/serial_use/total">集計</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_APPLICANT"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="applicant"}} current{{/if}}">応募</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/applicant/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/applicant/total">集計</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_APPLICANT"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="uid"}} current{{/if}}">当選者データ</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/uid/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/uid/new">登録</a></li>
                    </ul>
                </li>
                {{/if}}

                {{if $administrator->role|has_role:"ROLE_APPLICANT"}}
                <li>
                    <a href="#" class="nav-top-item{{if $request->getControllerName()=="registration"}} current{{/if}}">当選者登録</a>
                    <ul>
                        <li><a href="{{$request->getBaseUrl()}}/registration/search">一覧</a></li>
                        <li><a href="{{$request->getBaseUrl()}}/registration/total">集計</a></li>
                    </ul>
                </li>
                {{/if}}
            </ul>

