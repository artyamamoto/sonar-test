<?php

$movies = array(
    190 => 'i_10mb',
    192 => 'e_1-5m_low',
    193 => 'e_1-5m_high',
    194 => 's_2m_low',
    195 => 's_2m_high',
    196 => 's_10m',
);

foreach($movies as $id => $dir) {
    $files = glob($dir . '/*');

    foreach($files as $file) {
        $fileName = basename($file);
        if(!preg_match("/^cp_([a-z]+)_([a-z])_/", $fileName, $matches)) {
            continue;
        }

        $dir = $matches[1] . '_' . $matches[2];

        if(!file_exists($dir)) {
            mkdir($dir);
        }

        if(strpos($fileName, 'license') !== false) {
            rename($file, $dir . '/' . $id . '.license');
        } else {
            rename($file, $dir . '/' . $id);
        }

        echo $file . PHP_EOL;
    }
}

