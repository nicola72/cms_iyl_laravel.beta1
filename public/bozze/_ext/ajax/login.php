<?php 
@session_start();
require_once('../Site.php');

$lang = $_POST['lang'];
$action = 'login_access';

$site = new Site('ajax',$lang,$action);
$site->init();


?>