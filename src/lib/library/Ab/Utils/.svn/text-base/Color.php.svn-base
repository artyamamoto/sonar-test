<?php

class Ab_Utils_Color
{
    protected static $_table = null;

    protected static $_colors = array();

    /**
     * 色を取得する
     */
    public static function getByCode($code)
    {
        if(null == self::$_table) {
            self::$_table = new ColorTable();
        }

        if(!isset(self::$_colors[$code])) {
            self::$_colors[$code] = self::$_table->getByCode($code);
        }

        return self::$_colors[$code] ? self::$_colors[$code] : null;
    }

    /**
     * styleタグを作成
     */
    public static function getStyleTag($color)
    {
        $tag = 'style="color:' . $color . '"';
        return $tag;
    }
}

