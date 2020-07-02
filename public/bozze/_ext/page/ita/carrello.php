<?php 
//Setto la nazione di default per la spedizione
if(!isset($_SESSION['carrello']['id_nazione'])){
	$_SESSION['carrello']['id_nazione'] = "101"; //Italia di default;
}
if(!isset($_SESSION['carrello']['spedizione']['id_nazione'])){
	$_SESSION['carrello']['spedizione']['id_nazione'] = "101"; //Italia di default;
}

if(isset($_GET['token'])){
	unset($_SESSION['PP_CART']['token']);
	unset($_SESSION['PP_CART']['importo_paypal']);
}
?>
<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">CARRELLO</h2>
                </div>
            </div>
         </div>
    </div>
</section>
<?php $prod_nel_carrello = $site->carrello->getProdottiCarrello()?>

<?php $totale_carrello = 0;?>

<?php if(count($prod_nel_carrello) == 0):?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p style="padding:40px 0;font-size:140%;">Attualmente nessun articolo è presente nel carrello.</p>
		</div>
	</div>
</div>
<?php else:?>
<div class="container">
	<div class="row" style="margin-top:10px;">
		<div class="pull-right">
			<a href="<?php $site->getUrl('home');?>" class="fjalla btn btn-default">Back to Shop</a>
		</div>
	</div>
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
					<th>Elimina</th>
				</tr>	
				<?php $importo_carrello = 0;?>
				<?php foreach($prod_nel_carrello as $item):?>
				<?php 
					$prodotto = $site->productManager->getInfoProduct($item['id_prodotto']);
					$url_scheda_prodotto = "/dettaglio.php?id_prodotto=".$item['id_prodotto'];
					$img = ($prodotto['img_1']!="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
				?>
				<tr>
					<td>
						<a href="https://www.chess-store.it<?php echo $img?>" class="item-img galleria-item">
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
						<input type="text" name="qta" value="<?php echo $item['qta'];?>" class="center" data-idrow="<?php echo $item['id'];?>" style="width:30px;">
						<a href="javascript:void(0);" onclick="cartUpdateQta('<?php echo $item['id'];?>', '<?php echo $this->lang?>','<?php echo $item['id_prodotto']?>');">
							<i class="fa fa-shopping-cart"></i>
						</a>
					</td>
					<td>
						<?php echo Utils::formatPrice($item['prezzo']);?>&nbsp;&euro;
					</td>
					<td>
						<a href="javascript:void(0)" onclick="deleteItemFromCart('<?php echo $item['id']?>','<?php echo $this->lang?>')">
							<i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
				<?php $importo_carrello += $item['prezzo'];?>
				<?php endforeach;?>			
			</table>
		</div>
	</div>
	<?php $site->carrello->setImportoTotale($importo_carrello);?>
	<div class="row">
		<div class="col-md-8">
			<?php $peso_carrello = $site->carrello->getPesoCarrello($prod_nel_carrello)?>
			<?php $_SESSION['carrello']['peso'] = $peso_carrello;?>
			<?php if(!isset($_SESSION['carrello']['coupon'])):?>
			<div class="row">
				<div class="col-md-5" style="line-height: 40px;font-size:120%; font-weight:bold;">Hai un coupon sconto?</div>
				<div class="col-md-4" style="line-height: 40px;">
					<input class="form-control" type="text" name="coupon" id="coupon" style="margin:3px 15px 0 15px;">
				</div>
				<div class="col-md-3" style="line-height: 40px;">
					<a class="fjalla btn btn-default" style="" href="javascript:void(0);" onclick="couponRedeem('<?php echo $this->lang?>');">Riscattalo ora!</a>
				</div>
									
			</div>
			<?php endif;?>
		</div>
		
	</div>
	<?php $continue_checkout = true; ?>
	
	<!-- Se il carrello supera il massimo peso -->
	<br />
	<?php if($_SESSION['carrello']['peso'] > 1000):?>
	<div class="row">
		<div class="col-md-12">
			<?php $continue_checkout = false;?>
			<div class="order-failed">Poiché il peso complessivo dei prodotti inseriti nel tuo attuale carrello supera la soglia dei 1000Kg, non possiamo procedere nel processo di checkout dell'ordine.
			<br> Ti preghiamo di contattare il nostro <a href="mailto:customerservice@chess-store.it" style="color:#840025;">Customer Service</a></div>
			<br><br>
		</div>
	</div>
	<?php endif;?>
	<div class="row" style="padding-top:30px;">
		<div class="col-md-12">
			<h3>Dettagli per Spedizione e Pagamento</h3>
			<?php $site->getFormCarrello()?>
		</div>
	</div>	
</div>
<?php endif;?>