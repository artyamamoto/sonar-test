<?php

/**
 * SerialUse controller
 */
class SerialUseController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'serial_use';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_SERIAL;

    /**
     * 日次集計
     */
    public function totalAction()
    {
        $startDate = strtotime(Ab_Setting::getInstance()->start_date);
        $endDate = strtotime(Ab_Setting::getInstance()->end_date);

        if(!$startDate || !$endDate) {
            throw new Exception('Cannot get date');
        }

        $serialTable = new SerialTable();
        $serials = $serialTable->fetchAll(null, 'id');

        $total = array();
        for($t = $startDate ; $t <= $endDate ; $t += 86400) {
            $totalTmp = array();
            foreach($serials as $serial) {
                $where = array(
                    '(SELECT serial_id FROM serial_number WHERE serial_number.n = serial_use.n LIMIT 1) = ?' => $serial->id,
                    'create_date >= ?' => date('Y-m-d 00:00:00', $t),
                    'create_date <= ?' => date('Y-m-d 23:59:59', $t),
                );
                $c = $this->_table->count($where);

                $totalTmp[] = $c;
            }

            $total[] = array(
                'date' => date('Y/m/d', $t),
                'total' => $totalTmp,
            );
        }

        $this->view->serials = $serials;
        $this->view->total = $total;
    }

    public function downloadAction()
    {
        $fileName = Ab_Setting::getInstance()->dawnload_filename . '_' . date('Ymd') . '.csv';

        $columns = explode(',', Ab_Setting::getInstance()->serial_column);

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $data = 'シリアル,';
        $data .= 'code,';
        $data .= '対象,';
        $data .= 'UID,';
        foreach($columns as $column) {
            $data .= $column . ',';
        }
        $data .= '登録日時,';
        $data .= PHP_EOL;

        echo mb_convert_encoding($data, 'SJIS', 'UTF-8');


        $adapter = $this->_table->getAdapter();

        $sql = 'SELECT * FROM serial_use ORDER BY id';
        $stmt = $adapter->query($sql);
        while($row = $stmt->fetch(Zend_Db::FETCH_ASSOC)) {
            $values = json_decode($row['data']);

            $data = '"' . Ab_Utils_String::escapeCsv($row['n']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['code']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['target']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['uid']) . '",';

            $params = strlen($row['params']) > 0 ? json_decode($row['params'], true) : array();
            foreach($columns as $column) {
                $data .= (isset($params[$column]) ? $params[$column] : '') . ',';
            }

            $data .= '"' . Ab_Utils_String::escapeCsv($row['create_date']) . '",';
            $data .= PHP_EOL;

            echo mb_convert_encoding($data, 'SJIS', 'UTF-8');
        }

        exit();
    }

    public function getValidatorRules()
    {
        return array();
    }
}

