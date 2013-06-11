<?php

class Ab_View_Smarty_Resource_Database implements Ab_View_Smarty_Resource_Interface
{
    /**
     * テンプレート取得
     */
    public function getTemplate($name, &$source, &$smarty)
    {
        if(!preg_match('/^page\\/(\w+?)\\.tpl$/', $name, $matches)) {
            throw new Exception('Invalid template name ' . $name);
        }

        $code = $matches[1];

        if(APPLICATION_ENVIRONMENT == 'production') {
            $table = new PageReleaseTable();
        } else {
            $table = new PageTable();
        }
        $row = $table->fetchRow(array('code = ?' => $code));

        if(!$row) {
            return false;
        }

        if(Ab_Device::getInstance()->isMobile()) {
            $source = $row->source_mobile;
        } elseif(Ab_Device::getInstance()->isSmartphone()) {
            $source = $row->source_smartphone;
        } else {
            $source = '';
        }

        return true;
    }

    /**
     * 更新日時取得
     */
    public function getTimestamp($name, &$timestamp, &$smarty)
    {
        if(!preg_match('/^page\\/(\w+?)\\.tpl$/', $name, $matches)) {
            throw new Exception('Invalid template name ' . $name);
        }

        $code = $matches[1];

        if(APPLICATION_ENVIRONMENT == 'production') {
            $table = new PageReleaseTable();
        } else {
            $table = new PageTable();
        }
        $row = $table->fetchRow(array('code = ?' => $code));

        if(!$row) {
            return false;
        }

        $d = ($row->update_date ? $row->update_date : $row->create_date);
        $timestamp = strtotime($d);

        return true;
    }

    public function getSecure($name, &$smarty)
    {
        return true;
    }

    public function getTrusted($name, &$smarty)
    {
        return true;
    }
}

