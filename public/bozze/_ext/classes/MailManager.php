<?php

class MailManager
{
	protected $site;
	public $dettaglio_ordine_msg;

	public $default_email;
	public $order_email;

	public function __construct($site)
	{
		$this->site = $site;
		$this->default_email = $site->default_email;
		$this->order_email = $site->order_email;
	}

	public function invioEmailRegistrazione($lang,$nome,$cognome,$password_chiaro,$email)
	{
		if ($lang=="ita"){
			$msg = "Gentile ".$nome." ".$cognome.",<br><br>grazie per esserti iscritto al sito <a href='https://www.chess-store.it/'>www.chess-store.it</a>.<br><br>";
			$msg .= "Le tue credenziali per accedere alla tua area privata sono:<br>";
			$msg .= "Username: ".$email."<br>";
			$msg .= "Password: ".$password_chiaro."<br><br>";
			$msg .= "Cordiali Saluti<br><br>Lo staff di Chess-Store.it";

			$title_email = "Conferma Registrazione su www.chess-store.it";
		} else {
			$msg = "Dear ".$nome." ".$cognome.",<br><br>thanks for registering at <a href='https://www.chess-store.org'>www.chess-store.org</a>.<br><br>";
			$msg .= "Your credentials to login into your private area are:<br>";
			$msg .= "Username: ".$email."<br>";
			$msg .= "Password: ".$password_chiaro."<br><br>";
			$msg .= "Best Regards<br><br>Chess-Store.org";

			$title_email = "Confirmation from www.chess-store.org";
		}

		$this->sendMail($email, $title_email, $msg, "Chess-Store", $this->default_email,"", false, "Nicola Tamburini", "nicola.tamburini@fjstudio.com");
	}

	public function sendPasswordEmail($lang,$email,$user,$clear_pwd)
	{
		if($lang=="ita")
		{
			$subject = "Chess Store - Recupera Password";

			$msg = "Gentile ";
			if($user['nome']){
				$msg .= $user['nome'].",<br><br>";
			} else {
				$msg .= "utente,<br><br>";
			}

			$msg .= "a seguito della sua richiesta le ricordiamo che la password per accedere alla sua area privata del sito Chess Store &egrave; <b>".$clear_pwd."</b><br><br>";
			$msg .= "Cordiali Saluti<br><br>Lo Staff di Chess Store";
		}
		elseif($lang=="eng")
		{
			$subject = "Chess Store - Retrieve Password";

			$msg = "Dear ";
			if($user['nome']){
				$msg .= $user['nome'].",<br><br>";
			} else {
				$msg .= "user,<br><br>";
			}

			$msg .= "following your request we remind you that the password to login into your private area of the site Chess Store is <b>".$clear_pwd."</b><br><br>";
			$msg .= "Kindest Regards<br><br>The team of Chess Store";
		}
			
		if($this->sendMail($email, $subject, $msg, "No Reply", $this->default_email,"", false, "Programmazione", "nicola.tamburini@fjstudio.com"))
		{
			return true;
				
		}
		return false;

	}

	public function sendOrderEmail($prodotti)
	{
		$table_msg = "";
		$table_msg.="
		<table style=\"border-collapse:collapse;\">
		<tr>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._PRODOTTO."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CODICE."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._QTA."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TOTALE."</th>
		</tr>";

		foreach ($prodotti as $item)
		{
			$prod = $this->site->productManager->getInfoProduct($item['id_prodotto']);
			$table_msg .= "
			<tr>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$prod['nome_'.$this->site->langDir]."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$prod['codice']."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$item['qta']."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($item['prezzo'])."&nbsp;&euro;</td>
			</tr>";
		}
		
		if($_SESSION['carrello']['dettaglio']['tax_refund']!="0")
		{
		    $table_msg .= "</table>
		      <br><br><p style=\"font-weight:bold;\">"._DETT_COSTI."</p>
		      <table style=\"border-collapse:collapse;\">
			     <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IMPONIBILE_REFUND."</td>
				     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['dettaglio']['imponibile_e_iva'])."&nbsp;&euro;</td></tr>";
		}
		else
		{
		    $table_msg .= "</table>
		      <br><br><p style=\"font-weight:bold;\">"._DETT_COSTI."</p>
		      <table style=\"border-collapse:collapse;\">
			     <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IMPONIBILE."</td>
				     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['dettaglio']['imponibile'])."&nbsp;&euro;</td></tr>
			     <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IVA."</td>
				     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['dettaglio']['iva'])."&nbsp;&euro;</td></tr>";
		}

		

		if($_SESSION['carrello']['dettaglio']['tax_refund']!="0")
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._DETRAZIONE."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">-".Utils::formatPrice($_SESSION['carrello']['dettaglio']['tax_refund'])."&nbsp;&euro;</td></tr>";
		}
		
		if($_SESSION['carrello']['dettaglio']['tax_refund']!="0")
		{
		    $table_msg .= "		      
		      <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._SPESE_SPEDIZIONE."</td>
			     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['ss'])."</td></tr>";
		}
		else
		{
		    $table_msg .= "
		      <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IMPORTO_CARRELLO."</td>
			     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['dettaglio']['importo'])."&nbsp;&euro;</td></tr>
		      <tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._SPESE_SPEDIZIONE."</td>
			     <td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['ss'])."</td></tr>";
		}

		

		if($_SESSION['carrello']['dettaglio']['sconto']!="0")
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._SCONTO."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">-".Utils::formatPrice($_SESSION['carrello']['dettaglio']['sconto'])."&nbsp;&euro;</td></tr>";
		}

		if($_SESSION['carrello']['pagamento']=="contrassegno")
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._COSTO_CONTRASSEGNO."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['sp'])."&nbsp;&euro;</td></tr>";
		}

		if($_SESSION['carrello']['regalo'] == 1)
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._COSTO_CONF_REGALO."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">5,00&nbsp;&euro;</td></tr>";
		}

		$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TOTALE_FINALE."</td>
			<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($_SESSION['carrello']['dettaglio']['totale'])."&nbsp;&euro;</td></tr></table>";
		$table_msg .= "<br><p style=\"font-weight:bold;\">"._DETT_SPED."</p>";
		$table_msg .= "
		<table style=\"border-collapse:collapse;\">
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._NOME.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".ucwords(stripslashes($_SESSION['carrello']['spedizione']['nome']))."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._COGNOME.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".ucwords(stripslashes($_SESSION['carrello']['spedizione']['cognome']))."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">Email:</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$_SESSION['carrello']['spedizione']['email']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TELEFONO.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$_SESSION['carrello']['spedizione']['tel']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._INDIRIZZO.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['indirizzo'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CAP.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['cap'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CITTA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['citta'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">Provincia:</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['prov'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._NAZIONE.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['nome_nazione'])."</td></tr>
		</table>";
			
		$table_msg .= "<br><br><p style=\"font-weight:bold;\">"._DETT_PERS."</p>";
		$table_msg .= "
		<table style=\"border-collapse:collapse;\">
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._DATA_NASCITA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['data_nascita'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._LUOGO_NASCITA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($_SESSION['carrello']['spedizione']['citta_nascita'])."</td></tr>
		</table>";

		if($_SESSION['carrello']['pagamento']=="bonifico")
		{
			$str_pagamento = ($this->site->lang == "ita") ? "Bonifico" : "Bank transfer";
		}
		elseif($_SESSION['carrello']['pagamento']=="contrassegno")
		{
			$str_pagamento = ($this->site->lang == "ita") ? "Contrassegno" : "Cash on delivery";
		}
			
		$table_msg .= "<br><br><p style=\"font-weight:bold;\"><b>"._PAGAMENTO_SCELTO.":</b>&nbsp;&nbsp;".$str_pagamento."</p>";

		if($this->site->lang == "ita")
		{
			$msg_per_cliente = "Gentile ".ucwords(stripslashes($_SESSION['carrello']['spedizione']['nome']))." ".ucwords(stripslashes($_SESSION['carrello']['spedizione']['cognome'])).",<br><br>
			il tuo ordine è stato correttamente inoltrato allo staff di Chess Store, che provvederà ad evaderlo il prima possibile.<br>
			Qui di seguito i dettagli del tuo ordine:<br><br>".$table_msg."<br><br>";
				
			//Eventuale messaggio per bonifico
			if($_SESSION['carrello']['pagamento']=="bonifico")
			{
				$msg_per_cliente .= "Poiché hai scelto come modalità di pagamento il bonifico bancario,
					ti indichiamo di seguito le nostre coordinate:<br><br>
					<b>INTESTATARIO:</b> MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
					<b>IBAN:</b> IT37A0306937761100000000268<br>
					<b>SWIFT:</b> BCITITMM<br><br>
					Ti ricordiamo che la merce verrà spedita non appena ricevuto l'accredito del pagamento.<br><br>";
			}
			$msg_per_cliente .= "Se sei soddisfatto del tuo acquisto ti invitiamo a lasciarci una recensione cliccando al seguente link <a href='https://www.chess-store.it/scrivi_recensione.php'>www.chess-store.it/scrivi_recensione.php</a>. Grazie. <br>";
			$msg_per_cliente .= "per essere sempre aggiornati sulle nostre novità cliccate \"mi piace\" sulla nostra pagina Facebook Marsili’s Company.<br>";
			$msg_per_cliente .= "Cordiali Saluti<br><br>Lo Staff di Chess Store";
		}
		else
		{
			$msg_per_cliente = "Dear ".ucwords(stripslashes($_SESSION['carrello']['spedizione']['nome']))." ".ucwords(stripslashes($_SESSION['carrello']['spedizione']['cognome'])).",<br><br>
			your order has been successfully submitted to Chess Store and it'll be dispatched as soon as possible.<br>
			Here your order details:<br><br>".$table_msg."<br><br>";
				
			//Eventuale messaggio per bonifico
			if($_SESSION['carrello']['pagamento']=="bonifico")
			{
				$msg_per_cliente .= "Since you chose bank transfer as payment method, we remind you our bank details:<br><br>
					<b>HOLDER:</b> MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
					<b>IBAN:</b> IT37A0306937761100000000268<br>
					<b>SWIFT:</b> BCITITMM<br><br>
					We kindly remind you that goods will be shipped after we receive you payment deposit.<br><br>";
			}
			$msg_per_cliente .= "If you are satisfied with your purchase, we invite you to leave us a review by clicking on the following link <a href='https://www.chess-store.org/eng/write_reviews.php'>www.chess-store.org/eng/write_reviews.php</a>. Thanks. <br>";
			$msg_per_cliente .= "to follow us click \"like\" on our Facebook page Marsili's Company.<br>";
			$msg_per_cliente .= "Best Regards<br><br>Chess Store";
		}

		$this->dettaglio_ordine_msg = $table_msg;
		//$this->site->log_error('errore_email', $table_msg);

		$mail_title = ($this->site->lang == "ita") ? "Conferma Ordine - www.chess-store.it" : "Order Confirmation - www.chess-store.org";
		if(!$this->sendMail($_SESSION['carrello']['spedizione']['email'], $mail_title, $msg_per_cliente, "Ordini www.chess-store.it", $this->default_email, "", false, "", false))
		{
			$msg = 'errore durante invio email ordine al cliente  '.$_SESSION['carrello']['spedizione']['email'];
			$this->site->log_error('errore_email', $msg);
			return false;
		}

		return true;
	}

	public function sendOrderEmailFromPayPal($id_ordine)
	{
		//$this->site->log_error('errore_paypal', "entro elaborazione email ".$id_ordine);

		$prodotti = $this->site->orderManager->getProdottiOrdine($id_ordine);

		$ordine = $this->site->orderManager->getOrdine($id_ordine);

		$spedizione = $this->site->orderManager->getSpedizione($id_ordine);

		$table_msg = "";
		$table_msg.="
		<table style=\"border-collapse:collapse;\">
		<tr>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._PRODOTTO."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CODICE."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._QTA."</th>
			<th style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TOTALE."</th>
		</tr>";

		foreach ($prodotti as $item)
		{
			$table_msg .= "
			<tr>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$item['prodotto']."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$item['codice']."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$item['qta']."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($item['importo_tot'])."&nbsp;&euro;</td>
			</tr>";
		}

		$table_msg .= "</table>
		<br><br><p style=\"font-weight:bold;\">"._DETT_COSTI."</p>
		<table style=\"border-collapse:collapse;\">
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IMPONIBILE."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($ordine['imponibile'])."&nbsp;&euro;</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IVA."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($ordine['iva'])."&nbsp;&euro;</td></tr>";

		if($ordine["sconto_iva"] != '0.00')
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._DETRAZIONE."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">-".Utils::formatPrice($ordine['sconto_iva'])."&nbsp;&euro;</td></tr>";
		}

		$table_msg .= "
		<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._IMPORTO_CARRELLO."</td>
			<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($ordine['importo'])."&nbsp;&euro;</td></tr>
		<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._SPESE_SPEDIZIONE."</td>
			<td style=\"border:solid 1px #c0c0c0;padding:5px;\">".Utils::formatPrice($ordine['spese_spedizione'])."</td></tr>";

		if($ordine["sconto"] != '')
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._SCONTO."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">-".Utils::formatPrice($ordine['sconto'])."&nbsp;&euro;</td></tr>";
		}

		if($ordine["spese_conf_regalo"] != '0.00')
		{
			$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._COSTO_CONF_REGALO."</td>
				<td style=\"border:solid 1px #c0c0c0;padding:5px;\">5,00&nbsp;&euro;</td></tr>";
		}

		$table_msg .= "<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TOTALE_FINALE."</td>
			<td style=\"border:solid 1px #c0c0c0;padding:5px;\">"
				.Utils::formatPrice($ordine['importo'] + $ordine['spese_spedizione'] + $ordine['spese_conf_regalo'] - $ordine['sconto']).
				"&nbsp;&euro;</td></tr></table>";
				$table_msg .= "<br><p style=\"font-weight:bold;\">"._DETT_SPED."</p>";
				$table_msg .= "
		<table style=\"border-collapse:collapse;\">
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._NOME.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['nome']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._COGNOME.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['cognome']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">Email:</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['email']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._TELEFONO.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['telefono']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._INDIRIZZO.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['indirizzo']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CAP.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['cap']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._CITTA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['citta']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">Provincia:</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['provincia']."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._NAZIONE.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".$spedizione['nazione']."</td></tr>
		</table>";
					
				$table_msg .= "<br><br><p style=\"font-weight:bold;\">"._DETT_PERS."</p>";
				$table_msg .= "
		<table style=\"border-collapse:collapse;\">
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._DATA_NASCITA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($ordine['data_nascita'])."</td></tr>
			<tr><td style=\"border:solid 1px #c0c0c0;padding:5px;\">"._LUOGO_NASCITA.":</td><td style=\"border:solid 1px #c0c0c0;padding:5px;\">".stripslashes($ordine['luogo_nascita'])."</td></tr>
		</table>";


					
				$table_msg .= "<br><br><p style=\"font-weight:bold;\"><b>"._PAGAMENTO_SCELTO.":</b>&nbsp;&nbsp;paypal</p>";

				if($this->site->lang == "ita")
				{
					$msg_per_cliente = "Gentile ".$spedizione['nome']." ".$spedizione['cognnome'].",<br><br>
			il tuo ordine è stato correttamente inoltrato allo staff di Chess Store, che provvederà ad evaderlo il prima possibile.<br>
			Qui di seguito i dettagli del tuo ordine:<br><br>".$table_msg."<br><br>";

					//Eventuale messaggio per bonifico
					if($spedizione['modalita_pagamento']=="bonifico")
					{
						$msg_per_cliente .= "Poiché hai scelto come modalità di pagamento il bonifico bancario,
					ti indichiamo di seguito le nostre coordinate:<br><br>
					<b>INTESTATARIO:</b> MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
					<b>IBAN:</b> IT37A0306937761100000000268<br>
					<b>SWIFT:</b> BCITITMM<br><br>
					Ti ricordiamo che la merce verrà spedita non appena ricevuto l'accredito del pagamento.<br><br>";
					}
					$msg_per_cliente .= "Se sei soddisfatto del tuo acquisto ti invitiamo a lasciarci una recensione cliccando al seguente link <a href='https://www.chess-store.it/scrivi_recensione.php'>www.chess-store.it/scrivi_recensione.php</a>. Grazie. <br>";
					$msg_per_cliente .= "Cordiali Saluti<br><br>Lo Staff di Chess Store";
				}
				else
				{
					$msg_per_cliente = "Dear ".$spedizione['nome']." ".$spedizione['cognome'].",<br><br>
			your order has been successfully submitted to Chess Store and it'll be dispatched as soon as possible.<br>
			Here your order details:<br><br>".$table_msg."<br><br>";

					//Eventuale messaggio per bonifico
					if($spedizione['modalita_pagamento']=="bonifico")
					{
						$msg_per_cliente .= "Since you chose bank transfer as payment method, we remind you our bank details:<br><br>
					<b>HOLDER:</b> MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
					<b>IBAN:</b> IT37A0306937761100000000268<br>
					<b>SWIFT:</b> BCITITMM<br><br>
					We kindly remind you that goods will be shipped after we receive you payment deposit.<br><br>";
					}
					$msg_per_cliente .= "If you are satisfied with your purchase, we invite you to leave us a review by clicking on the following link <a href='https://www.chess-store.org/eng/write_reviews.php'>www.chess-store.org/eng/write_reviews.php</a>. Thanks. <br>";
					$msg_per_cliente .= "Best Regards<br><br>Chess Store";
				}

				$this->dettaglio_ordine_msg = $table_msg;

				//$this->site->log_error('errore_email_paypal', $this->dettaglio_ordine_msg);

				$mail_title = ($this->site->lang == "ita") ? "Conferma Ordine - www.chess-store.it" : "Order Confirmation - www.chess-store.org";
				if(!$this->sendMail($spedizione['email'], $mail_title, $msg_per_cliente, "Ordini www.chess-store.it", $this->default_email, "", false, "", false))
				{
					$msg = 'errore durante invio email ordine al cliente  '.$spedizione['email'];
					$this->site->log_error('errore_email', $msg);
					return false;
				}



				$msg_per_sito = "Buongiorno,<br><br>
		hai appena ricevuto un ordine dal sito web di Chess Store.<br>
		Qui di seguito i dettagli di tale ordine:<br><br>".$this->dettaglio_ordine_msg."<br><br>Cordiali Saluti<br><br>Lo Staff di Chess Store";

				if(!$this->sendMail($this->default_email, "Nuovo Ordine da sito ".'info@chess-store.it', $msg_per_sito, "Ordini info@chess-store.it", $this->default_email, "", false, "Support", "nicola.tamburini@fjstudio.com"))
				{
					$msg = 'errore durante invio email ordine a chess store  ';
					$this->site->log_error('errore_email', $msg);
					return false;
				}

				return true;
	}

	public function sendOrderEmailToCompany()
	{
		$msg_per_sito = "Buongiorno,<br><br>
		hai appena ricevuto un ordine dal sito web di Chess Store.<br>
		Qui di seguito i dettagli di tale ordine:<br><br>".$this->dettaglio_ordine_msg."<br><br>Cordiali Saluti<br><br>Lo Staff di Chess Store";

		if(!$this->sendMail($this->default_email, "Nuovo Ordine da sito ".'info@chess-store.it', $msg_per_sito, "Ordini info@chess-store.it", $this->default_email, "", false, "Support", "nicola.tamburini@fjstudio.com"))
		{
			$msg = 'errore durante invio email ordine a chess store  ';
			$this->site->log_error('errore_email', $msg);
			return false;
		}

		return true;
	}

	public function sendMail($to, $subject, $msg, $from_name, $from_email, $cc_name="", $cc_email="info@chess-store.it", $bcc_name="", $bcc_email="support@inyourlife.info")
	{
		$mail = new PHPMailer;

		/*$mail->IsSMTP();                                      // Set mailer to use SMTP
		 $mail->Host = 'smtp.sparkpostmail.com';                 // Specify main and backup server
		 $mail->Port = 587;                                    // Set the SMTP port
		 $mail->SMTPAuth = true;                               // Enable SMTP authentication
		 $mail->Username = 'SMTP_Injection';                // SMTP username
		 $mail->Password = 'c022196169b26d37c30abf893954ece7d5e2a34f';                  // SMTP password
		 $mail->SMTPSecure = 'tls';*/

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'authsmtp.securemail.pro';                 // Specify main and backup server
		$mail->Port = 465;                                    // Set the SMTP port
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'smtp@chess-store.it';                // SMTP username
		$mail->Password = 'Chess295@@';                  // SMTP password
		$mail->SMTPSecure = 'ssl';

		$mail->CharSet = 'UTF-8';
		$mail->addReplyTo("info@chess-store.it");
		$mail->addAddress($to);     // Add a recipient
		$mail->FromName = $from_name;
		$mail->From = "postmaster@chess-store.it";
		$mail->addBCC("support@inyourlife.info");
		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body    = $msg."<br><br><br><small>Questa è una mail inviata da un sistema automatico. Si prega di non rispondere. Per qualsiasi informazione inviare una mail a info@chess-store.it<br>
		This is an email sent by an automated system. Please do not respond. For any information send an email to info@chess-store.it</small>";

		if(!$mail->send())
		{
			return false;
			mail('nicola.tamburini@fjstudio.com','notifica ko', $mail->ErrorInfo." errore invio email", 'Mailer Error: ' . $mail->ErrorInfo);
		}
		else
		{
			return true;
		}
	}
}

?>