<?php

/**
 * Ab_Db_Adapter_Mysql class.
 */
class Ab_Db_Adapter_Mysql extends Zend_Db_Adapter_Mysql
{
    /**
     * Connect to db.
     *
     * @access protected
     */
    protected function _connect()
    {
        if ($this->_connection) {
            return;
        }

        parent::_connect();
    }

    /**
     * Prepare statement.
     *
     * @access public
     * @param  string       $sql
     * @return Zend_Db_Statement_Mysqli
     */
    public function prepare($sql)
    {
        Zend_Registry::getInstance()->logger->debug('Query ' . $sql);
        return parent::prepare($sql);
    }
}

