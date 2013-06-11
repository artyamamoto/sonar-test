<?php

$file = $argv[1];

renameFile($file);

//$files = glob('./*.zip');

//foreach($files as $file) {
function renameFile($file) {
    /*
    $f = basename($file);

    list($f, $ext) = explode('.', $f, 2);

    $dir = strtolower($f);

    if(file_exists($dir)) {
        exec('rm -rf ' . $dir);
    }

    mkdir($dir);

    $cmd = "unzip $f.zip -d $dir";
    exec($cmd);
    */

    $dir = $file;
    $f = $file;

    rename($dir . '/' . $f . '_aac.3gp', $dir . '/119');
    rename($dir . '/' . $f . '_aa1.3gp', $dir . '/120');
    rename($dir . '/' . $f . '_vp6.mp4', $dir . '/122');
    rename($dir . '/' . $f . '_v3.dcf', $dir . '/123');
    //rename($dir . '/' . $f . '_24.amc', $dir . '/124');
    //rename($dir . '/' . $f . '_32.amc', $dir . '/125');
    rename($dir . '/' . $f . '_40.3g2', $dir . '/126');
    rename($dir . '/' . $f . '_64.3g2', $dir . '/127');
}

