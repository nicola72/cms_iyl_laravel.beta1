<?php 
//Inizializzo un po' di variabili di sessione
$_SESSION['carrello']['id_nazione'] = $_POST['nazione'];
$_SESSION['carrello']['pagamento'] = $_POST['pagamento'];
$_SESSION['carrello']['regalo'] = 0;

if(isset($_POST['regalo']))
{
	$_SESSION['carrello']['regalo'] = 1;
}


$_SESSION['carrello']['spedizione']['nome'] = $_POST['nome'];
$_SESSION['carrello']['spedizione']['cognome'] = $_POST['cognome'];
$_SESSION['carrello']['spedizione']['email'] = $_POST['email'];
$_SESSION['carrello']['spedizione']['tel'] = $_POST['tel'];
$_SESSION['carrello']['spedizione']['indirizzo'] = $_POST['indirizzo'];
$_SESSION['carrello']['spedizione']['cap'] = $_POST['cap'];
$_SESSION['carrello']['spedizione']['citta'] = $_POST['citta'];
$_SESSION['carrello']['spedizione']['prov'] = $_POST['prov'];
$_SESSION['carrello']['spedizione']['id_nazione'] = $_POST['nazione'];
$_SESSION['carrello']['spedizione']['data_nascita'] = $_POST['data_nascita'];
$_SESSION['carrello']['spedizione']['citta_nascita'] = $_POST['citta_nascita'];
if(trim($_SESSION['carrello']['spedizione']['nome']) == "" ||
		trim($_SESSION['carrello']['spedizione']['cognome']) == "" ||
		trim($_SESSION['carrello']['spedizione']['email']) == "" ||
		trim($_SESSION['carrello']['spedizione']['tel']) == "" ||
		trim($_SESSION['carrello']['spedizione']['indirizzo']) == "" ||
		trim($_SESSION['carrello']['spedizione']['cap']) == "" ||
		trim($_SESSION['carrello']['spedizione']['citta']) == "" ||
		trim($_SESSION['carrello']['spedizione']['prov']) == "" ||
		trim($_SESSION['carrello']['spedizione']['id_nazione']) == "" ||
		trim($_SESSION['carrello']['spedizione']['data_nascita']) == "" ||
		trim($_SESSION['carrello']['spedizione']['citta_nascita']) == "")
{
	header("location: carrello.php");
}

//print_r($_SESSION);

//inserisco in sessione le spese di spedizione
$site->setSpeseSpedizione();

/*CALCOLO DELLE SPESE DI PAGAMENTO*/
if($_POST['pagamento']=="contrassegno")
{
	$_SESSION['carrello']['sp']=9;
} 
else 
{
	$_SESSION['carrello']['sp']=0;
}

$prod_nel_carrello = $site->carrello->getProdottiCarrello();

$importo_carrello = 0;
$totaleprodotti= 0;

?>
<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">RIEPILOGO ORDINE</h2>
                </div>
            </div>
         </div>
    </div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<br />
			<table id="carrello_tbl" class="table">
				<tr>
					<th>&nbsp;</th>
					<th>Codice</th>
					<th class="hidden-xs">Prodotto</th>
					<th>Q.t&agrave;</th>
					<th>Totale</th>
				</tr>	
				<?php foreach($prod_nel_carrello as $item):?>
				<?php 
					$prodotto = $site->productManager->getInfoProduct($item['id_prodotto']);
					$url_scheda_prodotto = "/dettaglio.php?id_prodotto=".$item['id_prodotto'];
					$img = ($prodotto['img_1']!="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
				?>
				<tr>
					<td>
						<a href="https://www.chess-store.it<?php echo $img?>" class="item-img">
							<img src="https://www.chess-store.it<?php echo $img?>" alt="" class="img-carrello" />
						</a>
					</td>
					<td>
						<a href="<?php echo $url_scheda_prodotto;?>"><?php echo $prodotto['codice']?></a>
					</td>
					<td class="hidden-xs">
						<a href="<?php echo $url_scheda_prodotto;?>"><?php echo $prodotto['nome_it'];?></a>
					</td>
					<td>
						<?php echo $item['qta']; ?>
					</td>
					<td>
						<?php echo Utils::formatPrice($item['prezzo']);?>&nbsp;&euro;
					</td>
				</tr>
				<?php 
				$importo_carrello += ($item['prezzo']);
				$totaleprodotti+=($item['prezzo']);
				?>
				<?php endforeach;?>
				
			</table>
			
		</div>
	</div>
	<?php
	   $_SESSION['carrello']['dettaglio']['imponibile_e_iva'] = $importo_carrello;
		// Modifica nel caso importo carrello sia minore di 49 euro per l'italia allora le spese di spedizione sono 6 euro 
		if($importo_carrello < 49)
		{
			//se ITALIA
			if($_POST['nazione']=="101")
			{
				$_SESSION['carrello']['ss'] = 9;
			}
		}
		// Fine modifica
	
	
		$imponibile_carrello = round(($importo_carrello / 1.22), 2);
		$iva_carrello = $importo_carrello - $imponibile_carrello;
		$tax_refund = 0;
		$sconto = 0;
		$regalo = 0;
		
		if($_SESSION['carrello']['regalo'] == 1)
		{
			$regalo = 5;
		}

		if($_SESSION['carrello']['elimina_iva'] == "1")
		{
			$tax_refund = $iva_carrello;
		}
		$importo_carrello = $importo_carrello - $tax_refund;
		
		
	
		
		
		if(isset($_SESSION['carrello']['coupon']))
		{
			if($_SESSION['carrello']['coupon']['tipo_sconto'] == "fisso")
			{
				$sconto = $_SESSION['carrello']['coupon']['ammontare_sconto'];
				//$totale_carrello = $totale_carrello - $_SESSION['carrello']['coupon']['ammontare_sconto'];
			} 
			else 
			{
				$sconto = ($importo_carrello * $_SESSION['carrello']['coupon']['ammontare_sconto']) / 100;
				//$totale_carrello = $totale_carrello - $sconto;
			}
			$_SESSION['carrello']['coupon']['totale_ammontare_sconto'] = $sconto;
		}
		$totale_carrello = $importo_carrello - $sconto + $_SESSION['carrello']['ss'] + $_SESSION['carrello']['sp'] + $regalo;
		$totale_carrello = ($totale_carrello < 0) ? 0 : $totale_carrello;
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-6">
			<table id="resume_tbl" class="table">
				<tr>
					<td class="right">Totale Prodotti</td>
					<td class="text-right"><?php echo Utils::formatPrice($totaleprodotti);?>&nbsp;&euro;</td>
				</tr>
				<?php if($_SESSION['carrello']['elimina_iva'] == "1") :?>
				<tr>
					<td>Rimborso IVA</td>
					<td class="text-right"><?php echo Utils::formatPrice($tax_refund);?>&nbsp;&euro;</td>
				</tr>
				<?php endif;?>
				<tr>
					<td>Importo Carrello</td>
					<td class="text-right"><?php echo Utils::formatPrice($importo_carrello);?>&nbsp;&euro;</td>
				</tr>
				<tr>
					<td>Spese di Spedizione</td>
					<td class="text-right"><?php echo Utils::formatPrice($_SESSION['carrello']['ss']);?>&nbsp;&euro;</td>
				</tr>
				<?php if($_SESSION['carrello']['regalo'] == 1):?>
				<tr>
					<td>Confezione Regalo</td>
					<td class="text-right">5,00&nbsp;&euro;</td>
				</tr>
				<?php endif;?>
				<?php if(isset($_SESSION['carrello']['coupon'])):?>
				<tr>
					<td>Sconto Coupon</td>
					<td class="text-right"><?php echo Utils::formatPrice($sconto);?>&nbsp;&euro;</td>
				</tr>
				<?php endif;?>
				<?php if($_SESSION['carrello']['pagamento']=="contrassegno"):?>
				<tr>
					<td>Costo per pagamento in contrassegno</td>
					<td class="text-right"><?php echo Utils::formatPrice($_SESSION['carrello']['sp']);?>&nbsp;&euro;</td>
				</tr>
				<?php endif;?>
				<tr>
					<td style="font-weight:bold;font-size:120%">Totale</td>
					<td class="text-right" style="font-weight:bold;font-size:120%"><?php echo Utils::formatPrice($totale_carrello);?>&nbsp;&euro;</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row" style="margin-top:20px">
		<div class="col-md-12">
			<div class="stripe"><p style="font-size:120%;font-weight:bold;">Dettagli per Spedizione e Pagamento</p></div>
			<table id="resume_user_tbl" class="table">
				<tr>
					<td>Nome</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['nome'];?></td>
					
				</tr>
				<tr>
					<td>Cognome</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['cognome'];?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['email'];?></td>					
				</tr>
				<tr>
					<td>Telefono</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['tel'];?></td>
				</tr>
				<tr>
					<td>Indirizzo consegna</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['indirizzo'];?></td>
					
				</tr>
				<tr>
					<td>CAP</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['cap'];?></td>
				</tr>
				<tr>
					<td>Citt&agrave;</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['citta'];?></td>
					
				</tr>
				<tr>
					<?php
					if($_SESSION['carrello']['spedizione']['id_nazione']=="101"){
						?>
						<td>Provincia</td>
						<td><?php echo $_SESSION['carrello']['spedizione']['prov'];?></td>
						<?php } ?>
				</tr>

				<?php
				
				$nazione = $site->getNomeNazione($_SESSION['carrello']['spedizione']['id_nazione']);
				$_SESSION['carrello']['spedizione']['nome_nazione'] = $nazione;

				//Pagamento
				switch ($_SESSION['carrello']['pagamento']) {
					case 'bonifico':
						$mod_pagamento = _BONIFICO;
						break;
					case 'contrassegno':
						$mod_pagamento = "Contrassegno";
						break;
					default:
						$mod_pagamento = _CARTA_CREDITO;
						break;
				}
				?>
				<tr>
					<td>Nazione</td>
					<td><?php echo $nazione;?></td>					
				</tr>
				
				<tr>
					<td>Metodo di pagamento</td>
					<td><?php echo $mod_pagamento;?></td>
				</tr>

				<tr>
					<td>Data di nascita</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['data_nascita'];?></td>					
				</tr>
					
				<tr>
					<td>Luogo di nascita</td>
					<td><?php echo $_SESSION['carrello']['spedizione']['citta_nascita'];?></td>
				</tr>
			</table>
			<?php
			    
				$_SESSION['carrello']['dettaglio']['imponibile'] = $imponibile_carrello;
				$_SESSION['carrello']['dettaglio']['iva'] = $iva_carrello;
				$_SESSION['carrello']['dettaglio']['importo'] = $importo_carrello;
				$_SESSION['carrello']['dettaglio']['tax_refund'] = $tax_refund;
				$_SESSION['carrello']['dettaglio']['sconto'] = $sconto;
				$_SESSION['carrello']['dettaglio']['totale'] = $totale_carrello;
			?>
			<br />
			<br />
			
		</div>
		<div class="col-md-6"><a class="btn btn-default" href="<?php $site->getUrl('carrello')?>" style="margin-bottom:10px;">Torna al carrello</a></div>
		<div class="col-md-6 text-right">
			<form method="post" action="<?php $site->getUrl('submit_ordine')?>" id="checkoutForm">
				<input type="button" class="btn btn-default" onclick="$('#checkoutForm').submit();" value="Procedi col pagamento">
			</form>
		</div>
	</div>
	<br >
	<br>
</div>