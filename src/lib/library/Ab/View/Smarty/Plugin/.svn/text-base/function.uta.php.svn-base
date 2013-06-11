<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {uta} function plugin
 *
 * Type:     function<br>
 * Name:     uta<br>
 * Date:     Jun 25, 2011<br>
 * Purpose:  show uta donwload tag
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_uta($params, &$smarty)
{
    if(!isset($params['name']) || !isset($params['text'])) {
        return '';
    }

    $device = Ab_Device::getInstance();

    $request = $smarty->get_template_vars('request');
    $name = $params['name'];
    $text = $params['text'];
    if(isset($params['color'])) {
        $color = Ab_Utils_Color::getByCode($params['color']);
    } else {
        $color = '#000000';
    }

    // 素材の情報を取得
    if($device->isMobile()) {
        $dir = Zend_Registry::getInstance()->config->uta->dir;
        $dir .= '/' . $name;

        $materialId = null;
        $materials = Ab_Utils_Gae::getDeviceMaterial('Uta');

        foreach($materials as $material) {
            $id = $material['id'];

            if(file_exists($dir . '/' . $id)) {
                $materialId = $id;
                break;
            }
        }

        if($materialId == null) {
            return '<!-- no material id -->';
        }

        $filePath = $dir . '/' . $materialId;

        $fileSize = filesize($filePath);

        $smarty->assign('uta_download_size', $fileSize);

        $contentType = Ab_Utils_Gae::getContentType($materialId);
        $disposition = Ab_Utils_Gae::getDisposition($materialId);

        $license = Ab_Utils_Gae::getLicense($dir, $materialId);
    }

    // タグを作成
    if($device->isDoCoMo()) {
        // docomo
        $ret = '<object declare id="uta" data="' . $request->getBaseUrl() . '/uta/download/file/' . $name . '/dummy/' . $name . '.3gp?guid=ON" type="' . $contentType . '">'
             . '</object>'
             . '<a href="#uta"><font color="' . $color . '">' . $text . '</font></a>';
    } elseif($device->isEzweb()) {
        // au
        $ret = '<object data="' . $request->getBaseUrl() . '/uta/download/file/' . $name . '/dummy/' . $name . '.3g2" copyright="no" standby="' . $text . '" type="' . $contentType . '">'
             . '<param name="disposition" value="' . $disposition . '" valuetype="data" />'
             . '<param name="size" value="' . $fileSize . '" valuetype="data" />'
             . '<param name="title" value="' . $name . '" valuetype="data" />'
             . '</object><br />';
    } elseif($device->isSoftbank()) {
        // softbank
        $ret = '<a href="http://tms/DD?sid=BHV9&lid=' . $license . '&ol=http://' . $_SERVER['SERVER_NAME'] . $request->getBaseUrl() . '/uta/download/file/' . $name . '/dummy/' . $name . '.dcf"><font color="' . $color . '">'  . $text .'</font></a>';
    } elseif($device->isIphone()) {
        // iPhone
        $ret = '<audio src="' . $request->getBaseUrl() . '/uta/download/file/' . $name . '" controls></audio>';
    } elseif($device->isAndroid()) {
        // Android
        $id = isset($params['id']) ? $params['id'] : 'flash';

        $ret = '<script type="text/javascript">'
             . 'var flashvars = {file:\'' . $name . '\'' . (APPLICATION_ENVIRONMENT != 'production' ? ', stage:\'1\'' : '') . '};'
             . 'var params = {menu:\'false\', allowfullscreen:\'true\'};'
             . 'swfobject.embedSWF("' . $request->getBaseUrl() . '/images_sp/mp3_player.swf", "' . $id . '", "100%", "300", "10.0.0", null, flashvars, params);'
             . '</script>'
             . '<div id="' . $id . '">'
             . '<audio src="' . $request->getBaseUrl() . '/uta/download/file/' . $name . '" controls></audio>'
             . '</div>';
    }

    return $ret;
}

