<?php

class ReleaseController extends BaseController
{
    /**
     * 本番公開を実施
     */
    public function execAction()
    {
        // actionテーブル
        $table = new ActionTable();
        $table->release();

        // pageテーブル
        $table = new PageTable();
        $table->release();

        // mail_templateテーブル
        $table = new MailTemplateTable();
        $table->release();

        exit();
    }
}

