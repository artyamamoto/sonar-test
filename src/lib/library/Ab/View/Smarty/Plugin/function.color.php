<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {color} function plugin
 *
 * Type:     function<br>
 * Name:     color<br>
 * Date:     Jul 26, 2012<br>
 * Purpose:  draw color
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_color($params, &$smarty)
{
    if(!isset($params['code'])) {
        return '';
    }

    $code = $params['code'];

    $color = Ab_Utils_Color::getByCode($code);
    if(!$color) {
        return '';
    }

    if(isset($params['type']) && strlen($params['type']) > 0) {
        switch($params['type']) {
            case 'style':
                return Ab_Utils_Color::getStyleTag($color->value);

            default:
        }
    }

    return $color->value;
}

