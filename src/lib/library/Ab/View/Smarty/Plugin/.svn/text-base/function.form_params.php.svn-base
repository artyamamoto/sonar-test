<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_params} function plugin
 *
 * Type:     function<br>
 * Name:     form_params<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  draw input hidden params
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_params($params, &$smarty)
{
    // Requestの値を取得
    $request = $smarty->get_template_vars('request');

    $ret = '';

    foreach($request->getParams() as $key => $value) {
        if(in_array($key, array('controller', 'action', 'module', 'PHPSESSID'))) {
            continue;
        }

        if(is_array($value)) {
            foreach($value as $key2 => $value2) {
                if(is_array($value2)) {
                    foreach($value2 as $key3 => $value3) {
                        $ret .= '<input type="hidden" name="' . $key3 . '" value="' . htmlspecialchars($value3) . '" />';
                    }
                } else {
                    $ret .= '<input type="hidden" name="' . $key2 . '" value="' . htmlspecialchars($value2) . '" />';
                }
            }
        } else {
            $ret .= '<input type="hidden" name="' . $key . '" value="' . htmlspecialchars($value) . '" />';
        }
    }

    return $ret;
}

