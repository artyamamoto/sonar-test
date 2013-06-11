<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_datetime} function plugin
 *
 * Type:     function<br>
 * Name:     form_datetime<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw select
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_datetime($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $name = $params['name'];

    // Requestの値を取得
    $request = $smarty->get_template_vars('request');
    if(is_array($request->{$name})) {
        $value = $request->getDatetime($name);
    } else {
        $value = $request->{$name};
    }

    $action = $request->getActionName();

    // 確認画面、完了画面
    if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
        $t = strtotime($value);
        return date('Y年m月d日', $t) . '&emsp;' . date('H時i分', $t);
    }

    // タグを作成
    $d = getdate(strtotime($value));

    // 年
    $ret = '<select name="' . $name . '[year]" class="tiny-input">';
    for($i = 2011 ; $i <= 2020 ; $i++) {
        $ret .= '<option value="' . $i . '"' . ($d['year'] == $i ? ' selected="selected"' : '') . '>' . $i . '</option>';
    }
    $ret .= '</select>年&nbsp;';

    // 月
    $ret .= '<select name="' . $name . '[month]" class="tiny-input">';
    for($i = 1 ; $i <= 12 ; $i++) {
        $ret .= '<option value="' . $i . '"' . ($d['mon'] == $i ? ' selected="selected"' : '') . '>' . $i . '</option>';
    }
    $ret .= '</select>月&nbsp;';

    // 日
    $ret .= '<select name="' . $name . '[day]" class="tiny-input">';
    for($i = 1 ; $i <= 31 ; $i++) {
        $ret .= '<option value="' . $i . '"' . ($d['mday'] == $i ? ' selected="selected"' : '') . '>' . $i . '</option>';
    }
    $ret .= '</select>日&emsp;';

    // 時
    $ret .= '<select name="' . $name . '[hour]" class="tiny-input">';
    for($i = 0 ; $i <= 23 ; $i++) {
        $ret .= '<option value="' . $i . '"' . ($d['hours'] == $i ? ' selected="selected"' : '') . '>' . $i . '</option>';
    }
    $ret .= '</select>時&nbsp;';

    // 分
    $ret .= '<select name="' . $name . '[minute]" class="tiny-input">';
    for($i = 0 ; $i <= 50 ; $i+=10) {
        $ret .= '<option value="' . $i . '"' . ($d['minutes'] == $i ? ' selected="selected"' : '') . '>' . $i . '</option>';
    }
    $ret .= '</select>分';

    // エラー表示
    $errors = $smarty->get_template_vars('errors');
    if($errors && isset($errors[$name])) {
        foreach($errors[$name] as $error) {
            switch($error) {
                case 'isEmpty':
                    $ret = '<span class="input-notification error png_bg">選択してください</span><br />' . $ret;
                    break;
            }
        }
    }

    return $ret;
}

