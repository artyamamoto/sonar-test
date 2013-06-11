<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_select} function plugin
 *
 * Type:     function<br>
 * Name:     form_select<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw select
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_select($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $name = $params['name'];

    // Requestの値を取得
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};

    $action = $request->getActionName();

    $useKey = true;
    if(isset($params['use_key'])) {
        $useKey = $params['use_key'] ? true : false;
    }

    // 値
    if(isset($params['type']) && $params['type'] == 'prefecture') {
        // 都道府県
        $values = array(
                    '北海道', '青森県', '岩手県', '秋田県', '宮城県', '山形県',
                    '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県',
                    '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県',
                    '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県',
                    '滋賀県', '奈良県', '京都府', '大阪府', '和歌山県', '兵庫県',
                    '岡山県', '広島県', '鳥取県', '島根県', '山口県', '香川県',
                    '徳島県', '高知県', '愛媛県', '福岡県', '佐賀県', '長崎県',
                    '大分県', '熊本県', '宮崎県', '鹿児島県', '沖縄県',
                );
        $useKey = false;
    } elseif(isset($params['type']) && $params['type'] == 'sex') {
        // 性別
        $values = array(
                    '男性' => '男性',
                    '女性' => '女性',
                );
    } elseif(isset($params['type']) && $params['type'] == 'age') {
        // 年齢
        $values = array();

        // 開始年齢
        if(isset($params['min']) && strlen($params['min']) > 0) {
            $startAge = $params['min'];
        } else {
            $values[] = '6歳〜10歳';
            $startAge = 11;
        }

        // 終了年齢
        if(isset($params['max']) && strlen($params['max']) > 0) {
            $endAge = $params['max'];
        } else {
            $endAge = 59;
        }

        // 年齢ループ
        for($i = $startAge ; $i <= $endAge ; $i++) {
            $values[] = $i . '歳';
        }

        if(!isset($params['max']) || strlen($params['max']) == 0) {
            $values[] = '60歳以上';
        }

        $useKey = false;
    } else {
        $values = $params['values'];
    }

    // 確認画面、完了画面
    if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
        return htmlspecialchars($values[$value]);
    }

    // タグを作成
    $ret = '<select '
         . 'name="' . $name . '" '
         . 'class="small-input" '
         . '>';

    $ret .= '<option value=""></option>';

    foreach($values as $key => $val) {
        $k = $useKey ? $key : $val;

        $ret .= '<option value="' . htmlspecialchars($k) . '"' . ($value == $k ? ' selected="selected"' : '') . '>' . htmlspecialchars($val) . '</option>';
    }

    $ret .= '</select>';

    // エラー表示
    $errors = $smarty->get_template_vars('errors');
    if($errors && isset($errors[$name])) {
        $device = Ab_Device::getInstance();
        if($device->isMobile()) {
            $prefix = '<font color="#ff0000">';
            $suffix = '</font>';
        } elseif($device->isSmartphone()) {
            $prefix = '<span style="color:#ff0000">';
            $suffix = '</span>';
        } else {
            $prefix = '<span class="input-notification error png_bg">';
            $suffix = '</span>';
        }

        foreach($errors[$name] as $error) {
            switch($error) {
                case 'isEmpty':
                    $ret = $prefix . '選択してください' . $suffix . '<br />' . $ret;
                    break;
            }
        }
    }

    return $ret;
}

