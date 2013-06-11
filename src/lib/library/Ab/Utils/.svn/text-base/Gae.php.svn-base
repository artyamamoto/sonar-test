<?php

/**
 * AppEngine上のJWシステム関連処理
 */
class Ab_Utils_Gae
{
    /**
     * コンテンツファイルを検索
     */
    public static function getContentPath($dir, $type)
    {
        $devices = self::getDeviceMaterial($type);

        // ファイルを検索
        $path = null;
        $contentPathName = null;
        foreach($devices as $d) {
            if(!file_exists($dir . '/' . $d['id'])) {
                continue;
            }

            $path = $dir . '/' . $d['id'];
            $contentPathName = $d['name'];
            break;
        }

        return array($path, $contentPathName);
    }

    /**
     * GAE上のAPIを使用して端末に対応した素材情報を取得
     */
    public static function getDeviceMaterial($type)
    {
        // 対応機種チェック
        if(Ab_Device::getInstance()->isSmartphone()) {
            $carrier = 4;
            $model = 'SC-03D';
        } else {
            $carrier = self::getCarrierId();
            $model = strtolower(Ab_Device::getInstance()->getModel());
        }

        $url = 'http://www.johnnys-web.com/api/material/support?carrier_id=' . $carrier . '&type=' . $type . '&device_code=' . $model . '&priority=1';
        $devices = json_decode(file_get_contents($url), true);

        $priority = array();
        foreach($devices as $k => $v) {
            $priority[] = $v['priority'];
            $devices[$k]['id'] = $k;
        }

        array_multisort($devices, SORT_DESC, $priority);

        return $devices;
    }

    /**
     * JWのキャリアIDを取得
     */
    public static function getCarrierId()
    {
        $device = Ab_Device::getInstance();

        if($device->isEzweb()) {
            return 3;
            $carrier = 3;
        }

        if($device->isSoftBank()) {
            return 2;
        }

        return 1;
    }

    /**
     * JWの素材IDからContentTypeを取得
     */
    public static function getContentType($id)
    {
        $contentTypes = array(
            119 => 'audio/3gpp',
            120 => 'audio/3gpp',
            122 => 'audio/x-vaac',
            123 => 'application/vnd.oma.drm.content',
            124 => 'application/x-mpeg',
            125 => 'application/x-mpeg',
            126 => 'audio/3gpp2',
            127 => 'audio/3gpp2',

            190 => 'video/3gpp',
            191 => 'video/3gpp',
            192 => 'video/3gpp2',
            193 => 'video/3gpp2',
            194 => 'application/vnd.oma.drm.content',
            195 => 'application/vnd.oma.drm.content',
            196 => 'application/vnd.oma.drm.content',
        );

        return (isset($contentTypes[$id]) ? $contentTypes[$id] : null);
    }

    /**
     * JWの素材IDからContentTypeを取得
     */
    public static function getDisposition($id)
    {
        $dispositions = array(
            124 => 'devdl1z',
            125 => 'devdl1z',
            126 => 'devmpzz',
            127 => 'devmpzz',

            192 => 'devmpzz',
            193 => 'devmpzz',
        );

        return (isset($dispositions[$id]) ? $dispositions[$id] : null);
    }

    /**
     * SoftBankライセンスIDの取得
     */
    public static function getLicense($dir, $materialId)
    {
        $licenseFile = $dir . '/' . $materialId . '.license';

        // ライセンスファイルが無い場合は、空文字を返す
        if(!file_exists($licenseFile)) {
            return '';
        }

        $data = file_get_contents($licenseFile);
        $tmp = explode(',', $data);

        return (isset($tmp[11]) ? $tmp[11] : '');
    }
}

