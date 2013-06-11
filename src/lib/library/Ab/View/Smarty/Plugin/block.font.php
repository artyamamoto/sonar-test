<?php

function smarty_block_font($params, $content, &$smarty, &$repeat)
{
    if($repeat) {
        return;
    }

    $device = Ab_Device::getInstance();

    $tag = '';
    $tag .= ($device->isSmartphone() ? '<span' : '<font');

    // 色
    if(isset($params['color']) && strlen($params['color']) > 0) {
        $color = Ab_Utils_Color::getByCode($params['color']);

        if($color) {
            if($device->isSmartphone()) {
                $tag .= ' style="color:' . $color->value . '"';
            } else {
                $tag .= ' color="' . $color->value . '"';
            }
        }
    }

    // サイズ
    if(isset($params['size']) && strlen($params['size']) > 0) {
        $size = $params['size'];

        if($size == 'small') {
            if($device->isSmartphone()) {
                $tag .= ' class="small"';
            } elseif($device->isEZweb()) {
                $tag .= ' size="-2"';
            } else {
                $tag .= ' size="-1"';
            }
        }
    }

    $tag .= ($device->isSmartphone() ? '>' : '>');

    $tag .= $content;

    $tag .= ($device->isSmartphone() ? '</span>' : '</font>');

    return $tag;
}

