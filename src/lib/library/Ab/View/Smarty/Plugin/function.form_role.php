<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_role} function plugin
 *
 * Type:     function<br>
 * Name:     form_role<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw role
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_role($params, &$smarty)
{
    if(!isset($params['name'])) {
        return '';
    }

    $roles = array(
        '管理者' => 1,
        '設定' => 2,
        'テンプレート' => 4,
        'アクション' => 8,
        'シリアル' => 16,
        '応募データ' => 32,
    );

    $name = $isArray ? substr($params['name'], 0, -2) : $params['name'];

    $label = isset($params['label']) ? $params['label'] : '';

    // Requestの値を取得し、比較
    $request = $smarty->get_template_vars('request');
    $value   = $request->{$name};

    $action = $request->getActionName();

    $ret = '';
    foreach($roles as $k => $v) {
        if($action == 'confirm' || $action == 'complete' || $action == 'delete' || $action == 'detail') {
            // 確認画面、完了画面
            if(in_array($v, $value)) {
                $ret .= htmlspecialchars($k) . '<br />';
            } else {
                $ret .= '<span style="color: #ddd">' . htmlspecialchars($k) . '</span><br />';
            }
        } else {
            $ret .= '<label>'
                 . '<input type="checkbox" '
                 . 'name="' . $params['name'] . '[]" '
                 . 'value="' . htmlspecialchars($v) . '" '
                 . (in_array($v, $value) ? 'checked="checked" ' : '')
                 . '/>' . htmlspecialchars($k)
                 . '</label>';
        }
    }

    return $ret;
}

