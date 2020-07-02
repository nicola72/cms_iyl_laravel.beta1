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

array_push($array_errori,0);
$nome=$_POST['nome'];


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
	//$emailDestinatario = "nicola.tamburini@fjstudio.com";
	$emailDestinatario = "info@chess-store.it";
	
	$recensione=stripslashes(htmlspecialchars($_POST['messaggio'], ENT_QUOTES,'UTF-8'));
	
	if(addRecensione($nome,$recensione))
	{
		$messaggio="
		<html>
		<head></head>
		<body>
		<b>Nuova recensione sito www.chess-store.it</b>
		<br><br>
		La informiamo che è stata appena inserita una nuova recensione dal sito web, che potrà visualizzare nel pannello gestione sito.
		<br>
		<b>Autore:</b> ".$_POST['nome']."<br>
		<br><br>
			
		</body>
		</html>";
		$oggetto='Nuova recensione sito www.chess-store.it';


		$mail = new PHPMailer;
		$mail->setFrom("info@chess-store.it", 'Chess Store');
		$destinatari=explode(',', $emailDestinatario);
		foreach($destinatari as $dest) $mail->addAddress($dest);
		$mail->addBCC('support@inyourlife.info');
		//$mail->addBCC('nicola.tamburini@fjstudio.com');
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';

		//$mail->AddReplyTo($email);
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
				echo "<div style='font-size:120%;text-align:center;color: #000;'>Grazie per la recensione.<br/><br/></div>";
			}
			elseif($lang == 'eng')
			{
				echo "<div style='font-size:120%;text-align:center;color: #000;'>Thanks for your review.<br/><br/></div>";
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
		if($lang == 'ita')
		{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Errore non è stato possibile inserire la recensione.<br/><br/></div>";
		}
		elseif($lang == 'eng')
		{
			echo "<div style='font-size:120%;text-align:center;color: #000;'>Error!.<br/><br/></div>";
		}
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
	
}

function addRecensione($nome,$messaggio)
{
	$conn = setConnection();
	
	$sql = $conn->prepare( "INSERT INTO tb_guestbook (nome,messaggio,data_inserimento) VALUES (:nome,:messaggio,'".date('Y-m-d H:i:s')."')");
	$sql->bindParam(':nome',$nome,PDO::PARAM_STR);
	$sql->bindParam(':messaggio',$messaggio,PDO::PARAM_STR);
	
	if ($sql->execute() === TRUE)
	{
		return true;
	}
	else
	{
		echo "errore, <div style='border:2px solid red; padding:5px; margin: 5px 0 5px 0;width:100%;color:red;font-weight:bold;'>
				Si è verificato un errore!</div>";
		$arr = $sql->errorInfo();
		var_dump($arr);
	}
}

function setConnection()
{

	$user = 'us_chessto1';
	$password = 'V3dqk3%5';
	$database = 'db_chessto1_';
	$host = '213.229.100.154';
	 

	$col = 'mysql:host='.$host.';dbname='.$database.'';
	try
	{
		$conn = new PDO($col , $user, $password); //tra le virgolette un eventuale password
	}
	catch(PDOException $e)
	{
		$this->log_error("errore_connessione_db.txt", date("d-m-Y H:i",time())." -> ".$e->getMessage());
		echo 'Stiamo effettuando un intervento di manutenzione. Ci scusiamo per il disagio!';
		exit();
	}

	return $conn;
}



?>