<?php 
@session_start();
require_once('../Site.php');

$lang = $_POST['lang'];
$action = 'recupera_password';

$site = new Site('ajax',$lang,$action);
$site->init();


?>