<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">ORDINE CONFERMATO</h2>
                </div>
            </div>
         </div>
    </div>
</section>
<?php 

//se vengo da paypal
if(isset($_GET['nr']))
{
	$id_ordine = $_GET['nr'];
	
	//Svuoto il carrello
	$site->carrello->setCartEmpty();
}
//altrimenti lo decodifico
else
{
	$nome_array = unserialize(base64_decode(urldecode($_GET['n'])));
	$id_ordine = $nome_array['id_ordine'];
}

//$id_ordine = trim($_GET['n']);
$spedizione = $site->orderManager->getSpedizione($id_ordine);
$ordine = $site->orderManager->getOrdine($id_ordine);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if($ordine['modalita_pagamento'] == "paypal"): ?>
			<div class="conferma_order">
				Gentile <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				ti confermiamo la corretta ricezione del pagamento. Provvederemo ad evadere il
				tuo ordine al più presto<br><br>
				Cordiali Saluti<br><br>
			</div>
			<?php elseif($ordine['modalita_pagamento'] == "bonifico"):?>
			<div class="conferma_order">
				Gentile <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				ti confermiamo la corretta ricezione del tuo ordine. Provvederemo ad evadere il
				tuo ordine dopo aver ricevuto il bonifico.<br><br>
				Intestatario: Marsili's Company (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
				IBAN: IT77T0572837760408570001423<br>
				SWIFT: BPVIIT21408<br><br>
				Cordiali Saluti<br><br>
			<?php else:?>
			<div class="conferma_order">
				Gentile <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				ti confermiamo la corretta ricezione del tuo ordine. Provvederemo ad evadere il
				tuo ordine nel più breve tempo possibile.<br><br>
				Cordiali Saluti<br><br>
			</div>
			<?php endif;?>
			</div>
		</div>
	</div>
</div>