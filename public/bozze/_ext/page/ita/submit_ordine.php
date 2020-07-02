<?php

$pr_nel_carrello = $site->carrello->getProdottiCarrello();

if($pr_nel_carrello < 0)
{
	header("Location: ".$site->getUrl('carrello'));
	die();
}

$sconto = ($_SESSION['carrello']['dettaglio']['sconto']==0) ? "0.00" : $_SESSION['carrello']['dettaglio']['sconto'];
$regalo = ($_SESSION['carrello']['regalo'] == 1)? "5.00" : "0.00";

$importo_carrello = 0;
foreach($pr_nel_carrello as $item)
{
	$importo_carrello += $item['prezzo'];
}

$imponibile_carrello = round(($importo_carrello / 1.22), 2);
$iva_carrello = $importo_carrello - $imponibile_carrello;

if($_SESSION['carrello']['elimina_iva'] == "1")
{
	$importo_carrello = $importo_carrello - $iva_carrello;
	$iva_carrello = 0;
}


// se PAGAMENTO PAYPAL
if($_SESSION['carrello']['pagamento']=="paypal")
{
	//1) Inserimento nella table tb_ordini
	if($site->orderManager->addOrder($sconto, $regalo))
	{
		//2) Inserimento nella table tb_dettaglio_ordini
		foreach($pr_nel_carrello as $item)
		{
			$prodotto = $site->productManager->getInfoProduct($item['id_prodotto']);			
			$site->orderManager->addOrderDetails($prodotto, $item['qta'], $item['prezzo']);
		}
		
		//3) Inserimento nella table tb_spedizione_ordini
		$site->orderManager->addSpedizioneOrdine();
		
		//4) Eventualmente segno come utilizzato il coupon
		if($sconto != "0.00")
		{
			$site->couponManager->setCouponUtilizzato($_SESSION['carrello']['coupon']['id']);
		}
	}
	
	if($this->lang == "ita")
	{
		header("Location: pagamento-paypal.php?n=".$site->orderManager->order_id);
	}
	else if($this->lang == "eng")
	{
		header("Location: eng/pagamento-paypal_en.php?n=".$site->orderManager->order_id);
	}
}
else
{
	//1) Inserimento nella table tb_ordini
	if($site->orderManager->addOrder($sconto, $regalo))
	{
		//2) Inserimento nella table tb_dettaglio_ordini
		foreach($pr_nel_carrello as $item)
		{
			$prodotto = $site->productManager->getInfoProduct($item['id_prodotto']);
			$site->orderManager->addOrderDetails($prodotto, $item['qta'], $item['prezzo']);
		}
		
		//3) Inserimento nella table tb_spedizione_ordini
		$site->orderManager->addSpedizioneOrdine();
		
		//4) Eventualmente segno come utilizzato il coupon
		if($sconto != "0.00")
		{
			$site->couponManager->setCouponUtilizzato($_SESSION['carrello']['coupon']['id']);
		}
		
		//invio email al cliente
		$site->mailManager->sendOrderEmail($pr_nel_carrello);
		
		//invio email a chess-store
		$site->mailManager->sendOrderEmailToCompany();
		
		//5) Svuoto il carrello
		$site->carrello->setCartEmpty();
		
		//7) Cancello tutte le variabili di sessione legate al carrello
		$nome_array = array
		(
			'nome' => $_SESSION['carrello']['spedizione']['nome'],
			'cognome' => $_SESSION['carrello']['spedizione']['cognome'],
			'id_ordine' => $site->orderManager->order_id
		);
		
		$n = urlencode(base64_encode(serialize($nome_array)));
		unset($_SESSION['carrello']);
		unset($_SESSION['PP_CART']);
		
		//8) REINDIRIZZAMENTOALLA PAGINA DI CONFERMA
		
		$url = $site->seo['conferma_ordine'][$this->lang]['url'];
		header("Location: ".$url."?n=".$n);
		
		die();
	}
	header("Location: ".$url."?n=NULL");
	die();
}
?>