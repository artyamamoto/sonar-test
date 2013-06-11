<?php

function smarty_modifier_release_status($string)
{
    switch($string) {
        case 1:
            $ret = '新規チェック中';
            break;
        case 2:
            $ret = '新規公開待ち';
            break;
        case 3:
            $ret = '更新チェック中';
            break;
        case 4:
            $ret = '更新公開待ち';
            break;
        case 5:
            $ret = '削除チェック中';
            break;
        case 6:
            $ret = '削除公開待ち';
            break;
        case 7:
            $ret = '本番公開中';
            break;
        default:
            $ret = '';
    }

    return $ret;
}

