<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
// Invio Mail Ver 1.0 by Parigi Lorenzo
@session_start();
require_once('phpmailer/PHPMailerAutoload.php');
// Creo un istanza della classe securimage
include_once 'securimage/securimage.php';
$securimage = new Securimage();
$lang = $_POST['lang'];
 
$array_errori=array();
$array_msg_rrori=array();

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
{
	array_push($array_errori,1);
	if($lang == 'ita')
	{
		array_push($array_msg_rrori," - L'indirizzo email non è valido<br> ");
	}
	elseif($lang == 'fra')
	{
		array_push($array_msg_rrori," - L'adresse e-mail est invalide<br> ");
	}
	elseif($lang == 'eng')
	{
		array_push($array_msg_rrori," - The email address is invalid<br> ");
	}
	else
	{
		array_push($array_msg_rrori," - Die E-Mail-Adresse ist ungültig<br> ");
	}
}
else
{
	$email=trim($_POST['email']);
}

/*
if($_POST['nome']=="")
{
	array_push($array_errori,1);
	array_push($array_msg_rrori," - Il campo 'Nome' è obbligatorio <br>");
}
else
{
	array_push($array_errori,0);
	$nome=$_POST['nome'];
}
*/
array_push($array_errori,0);
$nome=$_POST['nome'];

/*
if($_POST['messaggio']=="")
{
	array_push($array_errori,1);
	array_push($array_msg_rrori," - Il campo 'M	essaggio' è obbligatorio <br>");
}
else
{
	array_push($array_errori,0);
	$nome=$_POST['nome'];
}*/
if($securimage->check($_POST['captcha_code']) != false)
{
	array_push($array_errori,0);
}
else
{
	array_push($array_errori,1);
	if($lang == 'ita')
	{
		array_push($array_msg_rrori," - Il codice di controllo è errato<br> ");
	}
	elseif($lang == 'fra')
	{
		array_push($array_msg_rrori," - Le code de contrôle est incorrect<br> ");
	}
	elseif($lang == 'eng')
	{
		array_push($array_msg_rrori," - The control code is incorrect<br> ");
	}
	else
	{
		array_push($array_msg_rrori," - Der Steuercode ist falsch<br> ");
	}
}


//Verifico Variabili
if($_SESSION['trapp']=="" && !in_array(1,$array_errori))
{
	if (isset($_POST['copia_mittente']) && $_POST['copia_mittente']!=NULL) 
	{
		$emailDestinatario = "info@chess-store.it, ".$email;
		//$emailDestinatario = "nicola.tamburini@fjstudio.com, ".$email;

	} 
	else 
	{
		$emailDestinatario = "info@chess-store.it";
		//$emailDestinatario = "nicola.tamburini@fjstudio.com";
	}
	
	//Ricordarsi che se il campo è obbligatorio va aggiunto -obb
	
	/* ------------------------------------------------------------------------------------- */
	//VARIABILI DA MODIFICARE
	
	$text=stripslashes(htmlspecialchars($_POST['messaggio'], ENT_QUOTES,'UTF-8'));
	$messaggio="
	<html>
	<head></head>
	<body>
	<b>Richiesta Informazioni inviata dal sito ".$_SERVER['HTTP_HOST']."</b>
	<br><br>
	<b>Nome:</b> ".$_POST['nome']."<br>
	<b>E-mail:</b> ".$_POST['email']."<br>
	<b>Messaggio:</b> ".$text."<br>
	<br><br>
	
	</body>
	</html>"
	;
	$oggetto='Richiesta Informazioni inviata dal sito '.$_SERVER['HTTP_HOST'];
	
	//$link_conferma_invio="/conferma.php#conferma";
	/* ------------------------------------------------------------------------------------- */
	$mail = new PHPMailer;
	$mail->setFrom("info@chess-store.it", 'Chess Store');
	$destinatari=explode(',', $emailDestinatario);
	foreach($destinatari as $dest) $mail->addAddress($dest); 
	$mail->addBCC('support@inyourlife.info');
	//$mail->addBCC('nicola.tamburini@fjstudio.com');
	$mail->isHTML(true);                            
	$mail->CharSet = 'UTF-8';
	
	$mail->AddReplyTo($email);
	$mail->Subject = $oggetto;
	$mail->Body    = $messaggio;
	$mail->AltBody = strip_tags($messaggio);
		
	if(!$mail->send()) 
	{
		$var=fopen("log/errori_invio_mail.txt","a+");
		fwrite($var, date("d-m-Y H:i",time())." -> ".$mail->ErrorInfo."\n");
		echo "errore";
	} 
	else 
	{
		if($lang == 'ita')
		{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Grazie per averci contattato.<br/><br/>
				Ti risponderemo al più presto.</div>";
		}
		elseif($lang == 'eng')
		{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Thanks for contacting us.<br/><br/>
				We will reply as soon as possible.</div>";
		}
		elseif($lang == 'fra')
		{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Merci de nous contacter.<br/><br/>
				Nous vous répondrons dès que possible.</div>";
		}
		else{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Vielen Dank für Ihre Kontaktaufnahme.<br/><br/>
				Wir werden so schnell wie möglich antworten.</div>";
		}
		
		//header("location: ".$link_conferma_invio);
	}
}
else
{
	echo '<div style="color:red;font-weight:bold;" class="erroresistema">';
	//var_dump($array_errori);
	foreach($array_msg_rrori as $valore)
	{
		echo $valore;
	}
	echo '</div>';
	
	
	//Se presente un errore verrà fatto un redirect con variabile in get per gestirlo vedi codice esempio sotto
	//$link_return= str_replace("?err=1","",$_SERVER['HTTP_REFERER'])."?err=1#errore";
	//header("location: ".$link_return);
	
}

/* GESTIONE ERRORE */
/*
Nella pagina del form inserire:
-----------------------------------------------------------------
if(isset($_GET['err']))
{
	echo "Si prega di compilare correttamente i campi";
}
-----------------------------------------------------------------
*/

?>