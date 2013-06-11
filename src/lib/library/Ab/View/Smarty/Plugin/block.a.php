<?php

function smarty_block_a($params, $content, &$smarty, &$repeat)
{
    if($repeat) {
        return;
    }

    $device = Ab_Device::getInstance();

    $styles = array();

    $tag = '<a';

    // リンク先
    if(isset($params['page']) && strlen($params['page']) > 0) {
        $tag .= ' href="' . $smarty->get_template_vars('base_url') . '/page/' . $params['page'] . '"';

        unset($params['page']);
    } elseif(isset($params['link']) && strlen($params['link']) > 0) {
        $url = $params['link'];
        if(strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
            $url = $smarty->get_template_vars('base_url') . $url;
        }
        $tag .= ' href="' . $url . '"';

        unset($params['link']);
    }

    // タイプ
    if(isset($params['type']) && strlen($params['type']) > 0) {
        if($params['type'] == 'button') {
            $tag .= ' data-role="button"';
        }

        unset($params['type']);
    }

    // 色
    $fontColor = null;
    if(isset($params['color']) && strlen($params['color']) > 0) {
        $color = Ab_Utils_Color::getByCode($params['color']);

        if($color) {
            if($device->isSmartphone()) {
                $styles['color'] = $color->value;
            } else {
                $fontColor = $color->value;
            }
        }

        unset($params['color']);
    }

    // 背景色
    if(isset($params['bgcolor']) && strlen($params['bgcolor']) > 0) {
        $color = Ab_Utils_Color::getByCode($params['bgcolor']);

        if($color && $device->isSmartphone()) {
            $styles['background-color'] = $color->value;
        }

        unset($params['bgcolor']);
    }

    // 境界線色
    if(isset($params['border']) && strlen($params['border']) > 0) {
        $color = Ab_Utils_Color::getByCode($params['border']);

        if($color && $device->isSmartphone()) {
            $styles['border'] = '1px solid ' . $color->value;
        }

        unset($params['border']);
    }

    // その他のパラメータ
    foreach($params as $k => $v) {
        $tag .= ' ' . $k . '="' . $v . '"';
    }

    // スタイル追加
    if(count($styles) > 0) {
        $tag .= ' style="';
        $tmp = array();
        foreach($styles as $k => $v) {
            $tmp[] = $k . ':' . $v;
        }
        $tag .= implode(';', $tmp);
        $tag .= '"';
    }

    $tag .= '>';

    if($fontColor != null) {
        $tag .= '<font color="' . $fontColor . '">';
    }

    $tag .= $content;

    if($fontColor != null) {
        $tag .= '</font>';
    }

    //$tag .= ($device->isSmartphone() ? '</span>' : '</a>');
    $tag .= '</a>';

    return $tag;
}

