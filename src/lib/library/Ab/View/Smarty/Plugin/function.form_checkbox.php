<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_checkbox} function plugin
 *
 * Type:     function<br>
 * Name:     form_checkbox<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw checkbox
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_checkbox($params, &$smarty)
{
    if(!isset($params['name']) || !isset($params['value'])) {
        return '';
    }

    $isArray = (substr($params['name'], -2) == '[]');

    $name = $isArray ? substr($params['name'], 0, -2) : $params['name'];

    $label = isset($params['label']) ? $params['label'] : $params['value'];

    // Requestの値を取得し、比較
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};
    if(is_array($value)) {
        $checked = in_array($params['value'], $value);
    } else {
        $checked = ($value == $params['value']);
    }

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
         . '<input type="checkbox" '
         . 'name="' . $params['name'] . '" '
         . 'value="' . htmlspecialchars($params['value']) . '" '
         . ($checked ? 'checked="checked" ' : '')
         . '/>' . htmlspecialchars($label)
         . '</label>';

    return $ret;
}

