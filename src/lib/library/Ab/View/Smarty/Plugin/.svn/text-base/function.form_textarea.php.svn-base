<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_textarea} function plugin
 *
 * Type:     function<br>
 * Name:     form_textarea<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw textarea
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_textarea($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $name = $params['name'];

    // Requestの値を取得
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};

    $action = $request->getActionName();

    // 確認画面、完了画面
    if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
        return nl2br(htmlspecialchars($value));
    }

    // タグを作成
    $ret = '<textarea '
         . 'name="' . $name . '"';

    if(isset($params['rows']) && strlen($params['rows']) > 0) {
        $ret .= ' rows="' . $params['rows'] . '"';
    }
    if(isset($params['cols']) && strlen($params['cols']) > 0) {
        $ret .= ' cols="' . $params['cols'] . '"';
    }

    $ret .= '>'
          . htmlspecialchars($value)
          . '</textarea>';

    // エラー表示
    $errors = $smarty->get_template_vars('errors');
    if($errors && isset($errors[$name])) {
        foreach($errors[$name] as $error) {
            switch($error) {
                case 'isEmpty':
                    $ret = '<span class="input-notification error png_bg">入力してください</span><br />' . $ret;
                    break;
                case 'stringLengthTooLong':
                    $ret = '<span class="input-notification error png_bg">入力内容が長すぎます</span><br />' . $ret;
                    break;
                case 'regexNotMatch':
                    $ret = '<span class="input-notification error png_bg">入力内容が正しくありません</span><br />' . $ret;
                    break;
            }
        }
    }

    return $ret;
}

