<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">CONFIRMED ORDER</h2>
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
				Dear <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				we are pleased to confirm you that we have correctly received your payment.
				We will dispatch your order as sooon as possible.<br><br>
				Best Regards<br><br>
			</div>
			<?php elseif($ordine['modalita_pagamento'] == "bonifico"):?>
			<div class="conferma_order">
				Dear <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				We confirm correct receipt of your order. We will process your order after receiving the transfer.<br><br>
				Accountholder: MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
				Bank: BANCA INTESA SAN PAOLO<br>
				IBAN: IT37A0306937761100000000268<br>
				SWIFT: BCITITMM<br><br>
				Best Regards<br><br>
			<?php else:?>
			<div class="conferma_order">
				Dear <b>
				<?php echo $spedizione['nome'];?> 
				<?php echo $spedizione['cognome'];?></b>,<br><br>
				we are pleased to confirm you that we have correctly received your payment.
				We will dispatch your order as sooon as possible.<br><br>
				Best Regards<br><br>
			</div>
			<?php endif;?>
			</div>
			
			
		</div>
	</div>
</div>