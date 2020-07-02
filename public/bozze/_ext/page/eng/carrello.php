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
                	<h2 class="fjalla">CART</h2>
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
			<p style="padding:40px 0;font-size:140%;">Currently no article is present in the cart.</p>
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
					<th>Code</th>
					<th class="hidden-xs">Product</th>
					<th>Q.ty</th>
					<th>Total</th>
					<th>Delete</th>
				</tr>	
				<?php $importo_carrello = 0;?>
				<?php foreach($prod_nel_carrello as $item):?>
				<?php 
					$prodotto = $site->productManager->getInfoProduct($item['id_prodotto']);
					$url_scheda_prodotto = "/eng/details.php?id_prodotto=".$item['id_prodotto'];
					$img = ($prodotto['img_1']!="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
				?>
				<tr>
					<td>
						<a href="https://www.chess-store.org<?php echo $img?>" class="item-img galleria-item">
							<img src="https://www.chess-store.org<?php echo $img?>" alt="" class="img-carrello" />
						</a>
					</td>
					<td>
						<a href="<?php echo $url_scheda_prodotto;?>"><?php echo $prodotto['codice']?></a>
					</td>
					<td class="hidden-xs">
						<a href="<?php echo $url_scheda_prodotto;?>"><?php echo $prodotto['nome_en'];?></a>
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
				<div class="col-md-5" style="line-height: 40px;font-size:120%; font-weight:bold;">Do you have a discount coupon?</div>
				<div class="col-md-4" style="line-height: 40px;">
					<input class="form-control" type="text" name="coupon" id="coupon" style="margin:3px 15px 0 15px;">
				</div>
				<div class="col-md-3" style="line-height: 40px;">
					<a class="fjalla btn btn-default" style="" href="javascript:void(0);" onclick="couponRedeem('<?php echo $this->lang?>');">Redeem now!</a>
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
			<div class="order-failed">Since the global weight of the products in the cart exceeds 1000Kg, you cannot proceed with the checkout process.
			<br> Please contact our <a href="mailto:customerservice@chess-store.it" style="color:#840025;">Customer Service</a> to get more informations</div>
			<br><br>
		</div>
	</div>
	<?php endif;?>
	<div class="row" style="padding-top:30px;">
		<div class="col-md-12">
			<h3>Details for Shipping and Payment</h3>
			<?php $site->getFormCarrello()?>
		</div>
	</div>	
</div>
<?php endif;?>