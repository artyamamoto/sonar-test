<?php

function smarty_modifier_html($string, $reverse = false)
{
    $replacement = array(
        '&' => '&amp;',
        '<' => '&lt;',
        '>' => '&gt;',
        '"' => '&quot;',
        //"'" => '&#039;',
    );

    if(!is_string($string)) {
        return $string;
    }
    if($reverse) {
        $replacement = array_reverse($replacement);
        $replacement = array_flip($replacement);
    }

    return str_replace(array_keys($replacement), array_values($replacement), $string);
}

