<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_password} function plugin
 *
 * Type:     function<br>
 * Name:     form_password<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw input password
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_password($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $name = $params['name'];

    $request = $smarty->get_template_vars('request');
    $action = $request->getActionName();

    // 確認画面、完了画面
    if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
        return '********';
    }

    // タグを作成
    $ret = '<input type="password" '
         . 'name="' . $name . '" '
         . '/>';

    // エラー表示
    $errors = $smarty->get_template_vars('errors');
    if($errors && isset($errors[$name])) {
        foreach($errors[$name] as $error) {
            switch($error) {
                case 'isEmpty':
                    $ret .= '<br /><span class="error">入力してください</span>';
                    break;
            }
        }
    }

    return $ret;
}

