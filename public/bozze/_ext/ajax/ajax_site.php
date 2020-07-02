<?php
session_start();
require_once('../Site.php');


$lang = $_GET['lang'];
$action = $_GET['action'];

$site = new Site('ajax',$lang,$action);
$site->init();
