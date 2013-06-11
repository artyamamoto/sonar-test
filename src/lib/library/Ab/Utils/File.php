<?php

/**
 * ファイルに関する処理
 */
class Ab_Utils_File
{
    const CONTENT_TYPE_FLASH   = 'application/x-shockwave-flash';
    const CONTENT_TYPE_JPEG    = 'image/jpeg';
    const CONTENT_TYPE_GIF     = 'image/gif';
    const CONTENT_TYPE_PNG     = 'image/png';
    const CONTENT_TYPE_BMP     = 'image/bmp';
    const CONTENT_TYPE_DEFAULT = '';

    /**
     * ファイル名取得のループ最大数
     */
    const FILE_NAME_CHECK_MAX = 100;

    /**
     * ファイルのContent-typeを取得
     * Flash,Jpeg,GIF,PNGのみ対応
     *
     * @param  String       $data
     * @return String
     */
    public static function getContentType($data)
    {
        if(substr($data, 0, 3) == 'FWS' || substr($data, 0, 3) == 'CWS') {
            return self::CONTENT_TYPE_FLASH;
        }

        if(substr($data, 0, 2) == chr(0xff) . chr(0xd8)) {
            return self::CONTENT_TYPE_JPEG;
        }

        if(substr($data, 0, 3) == 'GIF') {
            return self::CONTENT_TYPE_GIF;
        }

        if(substr($data, 0, 8) == chr(0x89) . 'PNG' . chr(0x0d) . chr(0x0a) . chr(0x1a) . chr(0x0a)) {
            return self::CONTENT_TYPE_PNG;
        }

        if(substr($data, 0, 2) == 'BM') {
            return self::CONTENT_TYPE_BMP;
        }

        return self::CONTENT_TYPE_DEFAULT;
    }

    /**
     * ファイルの拡張子を取得　
     *
     * @param  string   $data
     * @return string
     */
    protected function getExt($data)
    {
        $contentType = self::getContentType($data);

        switch(strtolower($contentType)){
            case self::CONTENT_TYPE_JPEG:
                $ext = "jpg";
                break;
            case self::CONTENT_TYPE_PNG:
                $ext = "png";
                break;
            case self::CONTENT_TYPE_GIF:
                $ext = "gif";
                break;
            case self::CONTENT_TYPE_BMP:
                $ext = "bmp";
                break;
            case self::CONTENT_TYPE_FLASH:
                $ext = "swf";
                break;
            default:
                $ext = "3g2";
                break;
        }
    }

    /**
     * ランダムなファイル名を取得
     */
    public static function getFileName($dir, $ext = '')
    {
        $i = 0;
        do {
            $fileName = rand(100000, 1000000) . ($ext ? '.' . $ext : '');
            $tempPath = $dir
                      . DIRECTORY_SEPARATOR
                      . $fileName;
            $i++;
        } while(file_exists($tempPath) && $i < self::FILE_NAME_CHECK_MAX);

        if($i >= self::FILE_NAME_CHECK_MAX) {
            throw new Exception('Cannot make file.');
        }

        return $fileName;
    }
}

