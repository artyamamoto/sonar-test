<?php

/**
 * Ab_Db_Table class.
 */
class Ab_Db_Table extends Zend_Db_Table_Abstract
{
    /**
     * @var string
     */
    protected $_rowClass    = 'Ab_Db_Table_Row';

    /**
     * @var string
     */
    protected $_rowsetClass = 'Ab_Db_Table_Rowset';

    /**
     * @var array
     */
    protected $_forms = array();

    /**
     * @var boolean
     */
    protected $_useRelease = false;

    /**
     * リリースステータス
     *
     * 1 = 新規チェック中
     * 2 = 新規公開待ち
     * 3 = 更新チェック中
     * 4 = 更新公開待ち
     * 5 = 削除チェック中
     * 6 = 削除公開待ち
     * 7 = 本番公開中
     *
     * @var integer
     */
    const RELEASE_CREATE_CHECK = 1;
    const RELEASE_CREATE_WAIT = 2;
    const RELEASE_UPDATE_CHECK = 3;
    const RELEASE_UPDATE_WAIT = 4;
    const RELEASE_DELETE_CHECK = 5;
    const RELEASE_DELETE_WAIT = 6;
    const RELEASE_OPEN = 7;

    /**
     * Initialize.
     *
     * @access public
     */
    public function init()
    {
    }

    /**
     * Get exist or new row.
     *
     * @param  array     $array
     * @return Ab_Db_Table_Row
     */
    public function getRow(array $array)
    {
        $instance = null;

        $db = $this->getAdapter();

        $primaryKey = $this->info(self::PRIMARY);
        $primaryKey = array_shift($primaryKey);

        if(isset($array[$primaryKey]) && is_numeric($array[$primaryKey]) && $array[$primaryKey] != '') {
            $id = $array[$primaryKey];
            $primaryKey = $db->quoteIdentifier($primaryKey, true);
            $instance = $this->fetchRow($db->quoteInto("$primaryKey = ?", $id));
        } elseif(isset($array[$primaryKey])) {
            unset($array[$primaryKey]);
        }

        if(is_null($instance)) {
            $instance = $this->fetchNew();
        }

        $meta  = $this->info(self::METADATA);
        $array = array_intersect_key($array, $meta);

        $instance->setFromArray($array);
        return $instance;
    }

    /**
     * Check table has column.
     *
     * @param  string       $column
     * @return bool
     */
    public function hasColumn($column)
    {
        $cols = $this->_getCols();
        return in_array($column, $cols);
    }

    /**
     * Get columns data type.
     *
     * @param  string       $column
     * @return string
     */
    public function getDataType($column)
    {
        $this->_setupMetadata();
        return isset($this->_metadata[$column]['DATA_TYPE']) ? $this->_metadata[$column]['DATA_TYPE'] : null;
    }

    public function count($where = null)
    {
        if (!($where instanceof Zend_Db_Table_Select)) {
            $select = $this->select();

            if ($where !== null) {
                $this->_where($select, $where);
            }
        } else {
            $select = $where;
        }

        $select->from($this->_name, array('c' => 'COUNT(*)'));

        $rows = $this->_fetch($select);
        $row = array_shift($rows);

        return (isset($row['c']) ? $row['c'] : null);
    }

    /**
     * Inserts table rows with specified data.
     *
     * @param mixed $table The table to insert data into.
     * @param array $rows Column-value pairs with array.
     * @return int The number of affected rows.
     * @throws Zend_Db_Adapter_Exception
     */
    public function insertMulti($table, array $rows)
    {
        $adapter = $this->getAdapter();

        // extract and quote col names from the array keys
        $cols = array();
        foreach ($rows[0] as $col => $val) {
            $cols[] = $adapter->quoteIdentifier($col, true);
        }

        $vals = array();
        $bind = array();

        $i = 0;
        $j = 0;
        foreach($rows as $row) {
            foreach ($row as $col => $val) {
                if ($val instanceof Zend_Db_Expr) {
                    $vals[$j][] = $val->__toString();
                } else {
                    if ($adapter->supportsParameters('positional')) {
                        $vals[$j][] = '?';
                        $bind[] = $val;
                    } else {
                        if ($adapter->supportsParameters('named')) {
                            $bind[':col'.$i] = $val;
                            $vals[$j][] = ':col'.$i;
                            $i++;
                        } else {
                            /** @see Zend_Db_Adapter_Exception */
                            require_once 'Zend/Db/Adapter/Exception.php';
                            throw new Zend_Db_Adapter_Exception(get_class($adapter) ." doesn't support positional or named binding");
                        }
                    }
                }
            }
            $j++;
        }

        $data = array();
        foreach($vals as $val) {
            $data[] = '(' . implode(', ', $val) . ')';
        }

        // build the statement
        $sql = "INSERT INTO "
             . $adapter->quoteIdentifier($table, true)
             . ' (' . implode(', ', $cols) . ') '
             . 'VALUES ' . implode(', ', $data);

        // execute the statement and return the number of affected rows
        if ($adapter->supportsParameters('positional')) {
            $bind = array_values($bind);
        }
        $stmt = $adapter->query($sql, $bind);
        $result = $stmt->rowCount();
        return $result;
    }

    /**
     * Get forms array.
     *
     * @return array
     */
    public function getForms()
    {
        return new ArrayObject($this->_forms, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Release data.
     */
    public function release()
    {
        // 公開対象のレコードを取得
        $where = array(
            'release_status IN (?)' => array(self::RELEASE_CREATE_WAIT, self::RELEASE_UPDATE_WAIT, self::RELEASE_DELETE_WAIT),
            'release_date <= NOW()',
        );
        $rows = $this->fetchAll($where);

        // リリース先テーブルのインスタンス
        $className = Ab_Utils_String::camelize($this->_name) . 'ReleaseTable';
        $releaseTable = new $className();

        // 公開実行
        foreach($rows as $row) {
            $row->release($releaseTable);
        }
    }
}

