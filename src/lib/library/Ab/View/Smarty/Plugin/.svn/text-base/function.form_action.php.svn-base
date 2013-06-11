<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_action} function plugin
 *
 * Type:     function<br>
 * Name:     form_action<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  draw action
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_action($params, &$smarty)
{
    // Requestの値を取得
    $request = $smarty->get_template_vars('request');

    $ignoreConfirm = $smarty->get_template_vars('ignore_confirm');

    $baseUrl = $request->getBaseUrl() . '/' . $request->getControllerName();

    $action = $request->getActionName();

    if($action == 'complete') {
        return '#';
    } elseif($action == 'confirm' || $action == 'delete' || $ignoreConfirm == 1) {
        return $baseUrl . '/complete';
    } else {
        return $baseUrl . '/confirm';
    }
}

