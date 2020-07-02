<?php 
@session_start();
require_once('../Site.php');

$lang = $_POST['lang'];
$action = 'modifica_account';

$site = new Site('ajax',$lang,$action);
$site->init();


?>