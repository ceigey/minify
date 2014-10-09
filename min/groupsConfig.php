<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

//[DOCUMENT_ROOT] => /web_projects/doc_control/public

// Use local ini files instead of this overall file where possible
if( file_exists($_SERVER['DOCUMENT_ROOT'].'/../minify.router.php') ) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/../minify.router.php');
    return localMinifyRouterGroupConfig(1);
} else if( is_dir($_SERVER['DOCUMENT_ROOT'].'/../minify.ini.d/') ) {
    $files = glob($_SERVER['DOCUMENT_ROOT'].'/../minify.ini.d/*.ini');
    $ini = array();
    foreach($files as $file) {
        $fbasename = basename($file, ".ini");
        $thisConfig = parse_ini_file($file, true);
        foreach($thisConfig as $key => $data) {
            $ini[$fbasename."/".$key] = $data;
        }
    }
    return $ini;
} else if( file_exists($_SERVER['DOCUMENT_ROOT'].'/../minify.ini') ) {
    return parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/../minify.ini', true );
} elseif( file_exists($_SERVER['DOCUMENT_ROOT'].'/minify.ini' )){
    return parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/minify.ini', true );
}
