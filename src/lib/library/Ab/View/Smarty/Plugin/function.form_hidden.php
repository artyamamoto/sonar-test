<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_hidden} function plugin
 *
 * Type:     function<br>
 * Name:     form_hidden<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  draw input hidden
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_hidden($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $name = $params['name'];

    // Requestの値を取得
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};

    // タグを作成
    $ret = '<input type="hidden" '
         . 'name="' . $name . '" '
         . 'value="' . htmlspecialchars($value) . '" '
         . '/>';

    return $ret;
}

