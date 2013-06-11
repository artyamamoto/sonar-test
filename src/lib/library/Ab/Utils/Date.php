<?php

class Ab_Utils_Date
{
    public static function getDatetime($params, $unixTime = false)
    {
        if(empty($params) || !isset($params['year'])) {
            return null;
        }

        if(isset($params['hour'])) {
            $time = mktime($params['hour'], $params['minute'], 0, $params['month'], $params['day'], $params['year']);
        } elseif($params['month'] != "" && $params['day'] != "" && $params['year'] != "") {
            $time = mktime(0, 0, 0, $params['month'], $params['day'], $params['year']);
        } else {
            $time = 0;
        }

        if($unixTime) {
            return $time;
        }

        if(!$time) {
            return '0000-00-00 00:00:00';
        }

        return date('Y-m-d H:i:s', $time);
    }
}

