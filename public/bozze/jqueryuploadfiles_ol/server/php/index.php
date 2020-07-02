<?php session_start();
//print_r($_SESSION);
require_once($_SERVER['DOCUMENT_ROOT']."/admin/_parametri.php");
/*
 * jQuery File Upload Plugin PHP Example 5.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
error_reporting(!E_ALL | E_STRICT);


switch($tipifile){
	case 0:
		$accept='/.+$/i';
		break;
	case 1:
        $accept='/(\.|\/)(gif|jpeg|png|jpg)$/';
		break;
	case 2:
		$accept='/(\.|\/)(gif|jpeg|png|jpg|pdf)$/i';
		break;
	case 3:
		$accept='/(\.|\/)(pdf)$/i';
		break;
	default:
		$accept='/.+$/i';
		break;
}
require('upload.class.php');

$options=null;

if ($dimensione_consigliata[$_SESSION['tabella']]) {
	list ($dimensione_crop_width,$dimensione_crop_height)=split("x",$dimensione_consigliata[$_SESSION['tabella']]);
} else {
	$dimensione_crop_width=$_SESSION['dimensione_max_miniature_immagini'];
	$dimensione_crop_height=$_SESSION['dimensione_max_miniature_immagini'];
}

$upload_handler = new UploadHandler($_SESSION['nome_dominio'],$_SESSION['tabella'],$_SESSION['primary_key'],$host,$user,$password,$database,$_SESSION['dimensione_max_miniature_immagini'],$accept,$options,$dimensione_crop_width,$dimensione_crop_height);

header('Vary: Accept');
if (isset($_SERVER['HTTP_ACCEPT']) &&
    (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
    header('Content-type: application/json');
} else {
    header('Content-type: text/plain');
}


header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Content-Disposition: inline; filename="files.json"');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'OPTIONS':
        break;
    case 'HEAD':
    case 'GET':
        $upload_handler->get();
        break;
    case 'POST':
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            $upload_handler->delete();
        } else {
            $upload_handler->post();
        }
        break;
    case 'DELETE':
        $upload_handler->delete();
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
}
