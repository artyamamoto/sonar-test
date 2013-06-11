<?php

/**
 * Applicant controller
 */
class ApplicantController extends BaseController
{
    /**
     * @var     string
     */
    protected $_tableName = 'applicant';

    /**
     * @var int     必要なロール
     */
    protected $_role = Administrator::ROLE_APPLICANT;

    public function downloadAction()
    {
        $fileName = Ab_Setting::getInstance()->dawnload_filename . '_' . date('Ymd') . '.csv';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);

        $columns = explode(',', Ab_Setting::getInstance()->applicant_column);

        $data = 'メールアドレス,';
        foreach($columns as $column) {
            $data .= $column . ',';
        }
        $data .= 'song,';
        $data .= 'UID,';
        $data .= 'キャリア,';
        $data .= 'ユーザエージェント,';
        $data .= 'IPアドレス,';
        $data .= 'アプリバージョン,';
        $data .= '登録日時,';
        $data .= PHP_EOL;

        echo mb_convert_encoding($data, 'CP932', 'UTF-8');


        $adapter = $this->_table->getAdapter();

        $sql = 'SELECT * FROM applicant ORDER BY id';
        $stmt = $adapter->query($sql);
        while($row = $stmt->fetch(Zend_Db::FETCH_ASSOC)) {
            $values = json_decode($row['data']);

            $data = ltrim($row['mail_address'], '<') . ',';
            foreach($columns as $column) {
                $data .= '"' . Ab_Utils_String::escapeCsv($values->{$column}) . '",';
            }

            $data .= '"' . Ab_Utils_String::escapeCsv(mb_convert_kana($values->song, 'KV', 'UTF8')) . '",';

            $data .= '"' . $row['uid'] . '",';

            if($row['carrier'] == 1) {
                $data .= '"docomo",';
            } elseif($row['carrier'] == 2) {
                $data .= '"au",';
            } elseif($row['carrier'] == 3) {
                $data .= '"SoftBank",';
            } elseif($row['carrier'] == 4) {
                $data .= '"Android",';
            } elseif($row['carrier'] == 5) {
                $data .= '"iPhone",';
            } else {
                $data .= '"-",';
            }

            $data .= '"' . Ab_Utils_String::escapeCsv($row['user_agent']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['ip_address']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['app_version']) . '",';
            $data .= '"' . Ab_Utils_String::escapeCsv($row['create_date']) . '",';
            $data .= PHP_EOL;

            echo mb_convert_encoding($data, 'CP932', 'UTF-8');
        }

        exit();
    }

    /**
     * 応募数集計
     */
    public function totalAction()
    {
        $startDate = strtotime(Ab_Setting::getInstance()->start_date);
        $endDate = strtotime(Ab_Setting::getInstance()->end_date);

        if(!$startDate || !$endDate) {
            throw new Exception('Cannot get date');
        }

        $total = array();
        for($t = $startDate ; $t <= $endDate ; $t += 86400) {
            $where = array(
                'create_date >= ?' => date('Y-m-d 00:00:00', $t),
                'create_date <= ?' => date('Y-m-d 23:59:59', $t),
            );
            $c = $this->_table->count($where);

            $total[] = array(
                'date' => date('Y/m/d', $t),
                'count' => $c,
            );
        }

        $this->view->total = $total;
    }
}

