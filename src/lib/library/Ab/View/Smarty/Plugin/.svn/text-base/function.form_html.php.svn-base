<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {form_html} function plugin
 *
 * Type:     function<br>
 * Name:     form_html<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw wysiwyg editor
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_form_html($params, &$smarty)
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
        return $value;
    }

    // タグを作成
    $ret = '<textarea '
         . 'id="wysiwyg_' . $name . '"'
         . 'name="' . $name . '"';

    if(isset($params['rows']) && strlen($params['rows']) > 0) {
        $ret .= ' rows="' . $params['rows'] . '"';
    }
    if(isset($params['cols']) && strlen($params['cols']) > 0) {
        $ret .= ' cols="' . $params['cols'] . '"';
    }

    $ret .= '>'
          . htmlspecialchars($value)
          . '</textarea>'
          . '<input type="file" name="image_' . $name . '" />'
          . '&nbsp;'
          . '<button type="submit" name="upload" value="' . $name . '">追加</button>'
          . '<script type="text/javascript">CKEDITOR.replace("wysiwyg_' . $name . '", ckeOptions);</script>';

    // エラー表示
    $errors = $smarty->get_template_vars('errors');
    if($errors && isset($errors[$name])) {
        foreach($errors[$name] as $error) {
            switch($error) {
                case 'isEmpty':
                    $ret = '<span class="input-notification error png_bg">入力してください</span><br />' . $ret;
                    break;
                case 'stringLengthTooLong':
                    $ret = '<span class="input-notification error png_bg">入力内容が長すぎます</span><br />' . $ret;
                    break;
            }
        }
    }

    return $ret;
}

