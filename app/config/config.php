<?php

/*set your website title*/

define('WEBSITE_TITLE', "My Website");


/*protocal type http or https*/
define('PROTOCAL', 'http');

/*root and asset paths*/
/**
 * $_SERVER['SERVER_NAME']: domain name ( 127.0.0.1)
 * $_SERVER['DOCUMENT_ROOT'] : C:/xampp/httdocs
 *
 */

$path = str_replace("\\", "/", PROTOCAL . "://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");

//http://127.0.0.1C:/xampp/htdocs/templateToPHP/app/config/
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
//http://127.0.0.1/templateToPHP/app/config/
define('ROOT', str_replace("app/config", "public", $path));
//http://127.0.0.1/templateToPHP/public/
define('ASSETS', str_replace("app/config", "public/assets", $path));
//http://127.0.0.1/templateToPHP/public/asset

define('DEBUG', true);
/*set to true to allow error reporting
set to false when you upload online to stop error reporting*/
// if (DEBUG) {
//     ini_set("display_errors", 1);
// } else {
//     ini_set("display_errors", 0);
// }
ini_set("display_errors", 1);