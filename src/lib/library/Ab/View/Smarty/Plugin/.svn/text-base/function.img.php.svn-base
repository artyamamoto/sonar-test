<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {img} function plugin
 *
 * Type:     function<br>
 * Name:     img<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  show img tag
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_img($params, &$smarty)
{
    if(!isset($params['file'])) {
        return '';
    }

    $device = Ab_Device::getInstance();
    $request = $smarty->get_template_vars('request');

    // タグを作成
    $tag = '';
    if($device->isMobile()) {
        $tag = '<img src="' . $request->getBaseUrl() . '/img/view2/file/' . $params['file'] . '"';

        foreach($params as $k => $v) {
            if($k == 'file' || $k == 'width' || $k == 'height') {
                continue;
            }

            $tag .= ' ' . $k . '="' . $v . '"';
        }

        $tag .= ' />';
    } elseif($device->isSmartphone()) {
        if(!isset($params['width']) || !isset($params['height'])) {
            return '';
        }

        $width = $params['width'];
        $height = $params['height'];

        $tag = '<img src="' . $request->getBaseUrl() . '/images_sp/blank.gif" style="width:' . $width . 'px;height:' . $height . 'px;background:url(\'' . $request->getBaseUrl() . '/img/view2/file/' . $params['file'] . '\');background-size:' . $width . 'px ' . $height . 'px"';

        foreach($params as $k => $v) {
            if($k == 'file' || $k == 'width' || $k == 'height') {
                continue;
            }

            $tag .= ' ' . $k . '="' . $v . '"';
        }

        $tag .= ' />';
    }

    return $tag;
}

