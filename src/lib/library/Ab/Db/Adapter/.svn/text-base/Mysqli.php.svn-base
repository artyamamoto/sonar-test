<?php

/**
 * Ab_Db_Adapter_Mysqli class.
 */
class Ab_Db_Adapter_Mysqli extends Zend_Db_Adapter_Mysqli
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

        if(isset($this->_config['charset']) && $this->_config['charset'] != "") {
            $this->_connection->set_charset($this->_config['charset']);
        }
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

