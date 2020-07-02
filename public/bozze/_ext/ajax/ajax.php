<?php

$_POST = array_map("trim" , $_POST); //se esternamente ad uno switch
	$expiration_date = time() + (10 * 365 * 24 * 60 * 60); //in 10 years => Faccio scadere il cookie in un futuro abbastanza lontano
	setcookie("c_acceptance", "yes", $expiration_date,"/");
?>