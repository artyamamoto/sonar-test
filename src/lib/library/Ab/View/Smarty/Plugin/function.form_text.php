<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_text} function plugin
 *
 * Type:     function<br>
 * Name:     form_text<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw input text
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_text($params, &$smarty)
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
        return htmlspecialchars($value);
    }

    // タグを作成
    $ret = '<input class="text-input small-input" '
         . 'type="text" '
         . 'id="small-input" '
         . 'name="' . $name . '" '
         . 'value="' . htmlspecialchars($value) . '" ';

    if(isset($params['size'])) {
        $ret .= 'size="' . $params['size'] . '" ';
    }

    if(isset($params['maxlength'])) {
        $ret .= 'maxlength="' . $params['maxlength'] . '" ';
    }

    if(isset($params['mode'])) {
        if($params['mode'] == 'number') {
            $ret .= 'istyle=4 mode=numeric ';
        }
    }

    $ret .= '/>';

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
                    $ret = $prefix . '入力してください' . $suffix . '<br />' . $ret;
                    break;
                case 'stringLengthTooLong':
                    $ret = $prefix . '入力内容が長すぎます' . $suffix . '<br />' . $ret;
                    break;
                case 'regexNotMatch':
                    $ret = $prefix . '入力内容が正しくありません' . $suffix . '<br />' . $ret;
                    break;
                case 'notKana':
                    $ret = $prefix . 'ひらがな（全角）でご入力下さい' . $suffix . '<br />' . $ret;
                    break;
                default:
                    $ret = $prefix . $error . $suffix . '<br />' . $ret;
            }
        }
    }

    return $ret;
}

