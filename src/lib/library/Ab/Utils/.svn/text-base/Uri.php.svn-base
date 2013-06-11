<?php

class Ab_Utils_Uri
{
    /**
     * URIを正規化する
     */
    public static function normary($url)
    {
        $info = parse_url($url);

        $ret = $info['scheme'] . '://' . $info['host'];
        $ret .= isset($info['port']) ? ':' . $info['port'] : '';

        $path = preg_replace('?/[^/]+/\\.\\./?', '/', $info['path']);
        $path = preg_replace('?^/(\\.\\./)+?', '/', $path);

        $path = preg_replace('?/\\./?', '/', $path);

        $ret .= $path;

        $ret .= isset($info['query']) ? '?' . $info['query'] : '';
        $ret .= isset($info['fragment']) ? '?' . $info['fragment'] : '';

        return $ret;
    }
}

