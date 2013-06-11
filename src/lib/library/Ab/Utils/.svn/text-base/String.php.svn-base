<?php

/**
 * Ab_Utils_String class.
 */
class Ab_Utils_String
{
    /**
     * Camelize string.
     *
     * @access public
     * @param  string       $str
     * @return string
     */
    public static function camelize($str)
    {
        $str = str_replace('_', ' ', strtolower($str));
        return str_replace(' ', '', ucwords($str));
    }

    /**
     * Underscore string.
     *
     * @access public
     * @param  string       $str
     * @return string
     */
    public static function underscore($str)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $str));
    }

    /**
     * 文字コードを変換する（配列対応）
     */
    public static function convertEncoding($value, $targetEncode, $sourceEncode)
    {
        if(null === $value) {
            return $value;
        }

        if(is_array($value)) {
            foreach($value as $key => $val) {
                $value[$key] = Ab_Utils_String::convertEncoding($val, $targetEncode, $sourceEncode);
            }
        } else {
            $value = mb_convert_encoding($value, $targetEncode, $sourceEncode);
        }

        return $value;
    }

    /**
     * CSVで問題になる文字を全角に変換
     *
     * 対象の文字　, "
     */
    public static function escapeCsv($value)
    {
        return str_replace(array(',', '"'), array('，', '”'), $value);
    }
}

