<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_radio} function plugin
 *
 * Type:     function<br>
 * Name:     form_radio<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  draw radio
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_radio($params, &$smarty)
{
    if(!isset($params['name']) || !isset($params['value'])) {
        return '';
    }

    $name = $params['name'];

    $label = isset($params['label']) ? $params['label'] : $params['value'];

    // Requestの値を取得し、比較
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};
    $checked = ($value == $params['value']);

    $action = $request->getActionName();

    // 確認画面、完了画面
    if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
        if($checked) {
            return htmlspecialchars($label);
        } else {
            return '<span style="color: #ddd">' . htmlspecialchars($label) . '</span>';
        }
    }

    // タグを作成
    $ret = '<label>'
         . '<input type="radio" '
         . 'name="' . $params['name'] . '" '
         . 'value="' . htmlspecialchars($params['value']) . '" '
         . ($checked ? 'checked="checked" ' : '')
         . '/>' . htmlspecialchars($label)
         . '</label>';

    return $ret;
}

