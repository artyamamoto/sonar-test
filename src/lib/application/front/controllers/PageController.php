<?php

class PageController extends BaseController
{
    /**
     *
     *
     * @param string $method
     * @param array $args OPTIONAL Zend_Db_Table_Select query modifier
     * @return Zend_Db_Table_Row_Abstract|Zend_Db_Table_Rowset_Abstract
     * @throws Zend_Db_Table_Row_Exception If an invalid method is called.
     */
    public function __call($method, array $args)
    {
        $matches = array();

        if(!preg_match('/^([\w]+?)Action$/', $method, $matches)) {
            throw new Exception('Invalid action(1) ' . $method);
        }

        $code = Ab_Utils_String::underscore($matches[1]);

        // ページを取得
        if(APPLICATION_ENVIRONMENT == 'production') {
            $pageTable = new PageReleaseTable();
        } else {
            $pageTable = new PageTable();
        }
        $page = $pageTable->fetchRow(array('code = ?' => $code));

        if(!$page) {
            throw new Exception('Invalid action(2) ' . $method . '(' . $code . ')');
        }

        // 終了チェック
        if($page->is_close == 1 && $this->_isClose()) {
            $this->_forward(Zend_Registry::getInstance()->config->page->close);
            return;
        }

        // アクションを実行
        if(strlen($page->action_code) > 0) {
            if(APPLICATION_ENVIRONMENT == 'production') {
                $actionTable = new ActionReleaseTable();
            } else {
                $actionTable = new ActionTable();
            }

            // カンマ区切りで複数のアクションを実行
            $actionCodes = explode(',', $page->action_code);
            foreach($actionCodes as $actionCode) {
                $actionCode = trim($actionCode);
                if(strlen($actionCode) == 0) {
                    continue;
                }

                $action = $actionTable->fetchRow(array('code = ?' => $actionCode));
                if($action) {
                    eval($action->source);
                }
            }
        }

        Ab_Layout::getMvcInstance()->disableLayout();

        $this->getResponse()->setHeader('x-jphone-copyright', 'no-transfer');

        // テンプレートをDBから取得
        $options = array(
            'default_resource_type' => 'database',
        );
        $view = $this->_helper->ViewRenderer->view;
        $view->setOptions($options);
    }

    /**
     * 終了チェック
     */
    protected function _isClose()
    {
        $endDate = strtotime(Ab_Setting::getInstance()->end_date);

        return (time() > $endDate);
    }
}

