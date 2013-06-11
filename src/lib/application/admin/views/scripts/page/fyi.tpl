            <div class="content-box closed-box"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>FYI</h3>
                </div> <!-- End .content-box-header -->

                <div class="content-box-content">

                    <div class="tab-content default-tab">

                        <h4>アサイン済み変数</h4>
                        <p>
                            $request : リクエストオブジェクト<br />
                            $device : 端末情報<br />
                            $config : コンフィグ<br />
                        </p>

                        <h4>リクエスト値取得</h4>
                        <p>
                            値の取得 : $request->[パラメータ名]<br />
                            値の取得（配列） : $request->[パラメータ名].[添字]<br />
                            値の取得（全て） : $request->getParams()<br />
                        </p>

                        <h4>端末・キャリア</h4>
                        <p>
                            UID取得（携帯） : $device->getUid()<br />
                            キャリア判定（携帯） : $device->isMobile()<br />
                            キャリア判定（スマートフォン） : $device->isSmartphont()<br />
                            キャリア判定（docomo） : $device->isDoCoMo()<br />
                            キャリア判定（au） : $device->isEZweb()<br />
                            キャリア判定（SoftBank） : $device->isSoftBank()<br />
                            キャリア判定（Android） : $device->isAndroid()<br />
                            キャリア判定（iPhone,iPad） : $device->isIphone()<br />
                        </p>

                        <h4>アクション</h4>
                        <p>
                            カンマ区切りで複数指定可能<br />
                        </p>

                    </div> <!-- End #tab3 -->

                </div> <!-- End .content-box-content -->

            </div> <!-- End .content-box -->

