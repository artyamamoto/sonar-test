<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_file} function plugin
 *
 * Type:     function<br>
 * Name:     form_file<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw input file
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_file($params, &$smarty)
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
        if(!isset($value['name']) || strlen($value['name']) == 0) {
            return '';
        }

        if(strpos($value['type'], 'image/') === 0) {
            return '<img src="' . $request->getBaseUrl() . '/' . $request->getControllerName() . '/view?name=' . htmlspecialchars($value['tmp_name']) . '" />';
        } else {
            return $value['name'];
        }
    }

    // タグを作成
    $ret = '<input type="file" '
         . 'name="' . $name . '" '
         . 'class="small-input" '
         . '/>';

    if(!$value && isset($request->original[$name])) {
        $value = $request->original[$name];
    }
    if($value && !is_array($value)) {
        $ret .= '<br /><img src="' . $request->getBaseUrl() . '/' . $request->getControllerName() . '/view?name=' . htmlspecialchars($value) . '" />';
        $ret .= '<input type="hidden" name="original[' . $name . ']" value="' . htmlspecialchars($value) . '" />';
    }

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

