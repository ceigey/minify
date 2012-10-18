<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 **/
//[DOCUMENT_ROOT] => /web_projects/doc_control/public

// Use local ini files instead of this overall file where possible
if( file_exists($_SERVER['DOCUMENT_ROOT'].'/../minify.ini') ) {
    return parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/../minify.ini', true );
} elseif( file_exists($_SERVER['DOCUMENT_ROOT'].'/minify.ini' )){
    return parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/minify.ini', true );
}
