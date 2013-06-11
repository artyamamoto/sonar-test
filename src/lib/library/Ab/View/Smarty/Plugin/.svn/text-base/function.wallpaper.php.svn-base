<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {wallpaper} function plugin
 *
 * Type:     function<br>
 * Name:     wallpaper<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  show wallpaper donwload tag
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_wallpaper($params, &$smarty)
{
    if(!isset($params['name']) || !isset($params['text'])) {
        return '';
    }

    $request = $smarty->get_template_vars('request');
    $name = $params['name'];
    $text = $params['text'];

    // タグを作成
    if(Ab_Device::getInstance()->isEzweb()) {
        // au

        // ファイルのパスを取得
        $dir = '../data/wallpaper/' . $name;
        list($filePath, $contentPathName) = Ab_Utils_Gae::getContentPath($dir, 'Image');
        if(null != $filePath) {
            $size = filesize($filePath);
        }

        // Disposition, 拡張子
        if(strpos($contentPathName, 'JPEG') !== false) {
            $disposition = 'devjaww';
            $ext = 'jpg';
        } else {
            $disposition = 'dev8aww';
            $ext = 'png';
        }

        $ret = '<wml:anchor label="DL">' . PHP_EOL
             . '<wml:spawn href="device:data/dnld?url=http://' . $_SERVER['SERVER_NAME'] . $request->getBaseUrl() . '/wallpaper/download/name/' . $name . '/dummy/download.cgi&name=' . $name . '.' . $ext . '&size=' . $size . '&disposition=' . $disposition . '&title=' . $name . '" />' . $text . '<wml:catch /></wml:spawn>' . PHP_EOL
             . '</wml:anchor>';
    } elseif(Ab_Device::getInstance()->isMobile()) {
        $ret = '<a href="' . $request->getBaseUrl() . '/wallpaper/download/name/' . $name . '/dummy/' . $name . '.jpg">' . $text . '</a>';
    } else {
        $ret = '<a href="' . $request->getBaseUrl() . '/wallpaper/download/hash/' . $request->hash . '/name/' . $name . '" data-role="button">' . $text . '</a>';
    }

    return $ret;
}

