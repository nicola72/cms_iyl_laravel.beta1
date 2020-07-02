<div class="container">
	<div class="row" style="margin-left: 0; padding-left: 0;">
		<div class="col-md-12" style="margin-left: 0; padding-left: 0;">
			<div class="col-md-6"
				style="margin-left: 0; padding-left: 0; font-size: 130%; margin-top: 20px;">
			</div>
		</div>
	</div>
</div>
<?php $site->getFile('slider')?>
<section style="background-color:#fcfcfc;">
	<div class="container">
    	<div class="row">
	    	<div class="col-md-12 text-center" style="font-size:180%; padding-top:30px; line-height:1.5em; font-weight:bold;">Choose a chess set from the sections "CHESS MEN + CHESS BOARD", "CHESS MEN + CHESS TABLE"<br>
				or take pleasure in creating your own personalized chess-set
				choosing chess-pieces and chess-board
				in the respective sections
			</div>
		</div>
	</div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12 sideBar ">
				<?php $site->getFile('menu-prodotti')?>
				<?php //$site->getFile('box_set_completi',true)?>
				<?php //$site->getFile('box_spedizione',true)?>
				<?php $site->getFile('box_facebook',true)?>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				
				<!-- NOVITA -->
				<div class="row featuredProducts">			
					
					<?php $novita = $site->productManager->getProdottiNovita();?>
					<?php $abbinamenti = $site->productManager->getAbbinamentiNovita();?>
					<?php $novita = array_merge($novita,$abbinamenti);?>
					<?php if(count($novita) > 0):?>
						<div class="col-xs-12">
    						<div class="page-header">
    							<h3 class="fjalla" style="color: #840025;">	NEW ITEMS</h3>						
    						</div>
    					</div>
						<div class="col-xs-12">
							<div class="owl-carousel featuredProductsSlider">
    							<?php foreach ($novita as $item):?>
    							
    							<!-- prodotti non abbinati -->
    							<?php if(!isset($item['abbinamento'])):?>    
    							<?php $img = ($item['img_1'] !="") ? "/file/".$item['img_1'] : "/_ext/img/default.jpg";?>	
    							<?php $img = $site->addWatermarks($img);?>						
    							<div class="slide">
    								<div class="productImage clearfix">
    									<a href="/eng/details.php?id_prodotto=<?php echo $item['id'];?>"><img src="https://www.chess-store.it<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
    									<div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
    										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
    											<li>
    												<a data-toggle="modal" href="javascript:void(0)" onclick="addToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a>
    											</li>
    											<li>
    												<a href="javascript:void(0)" onclick="addToCart(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
    											</li>    
    										</ul>
    									</div>
    								</div>
    								<div class="productCaption clearfix">
    								<?php 
									$prezzo = $item['prezzo'];
									$prezzo_scontato = ($item['prezzo_scontato']!="" && $item['prezzo_scontato']!="0.00") ? $item['prezzo_scontato'] : false;
									?>
    									<a href="/eng/details.php?id_prodotto=<?php echo $item['id'];?>">
    										<div class="titolo_prodotto"><?php echo utf8_encode($item['nome_en'])?></div>
    									</a>
    									<div class="fjalla prezzo">
    									<?php if($prezzo_scontato):?>
											<span class="prezzo_pieno"><?php echo Utils::formatPrice($prezzo)?>  &euro;</span> &nbsp;&nbsp;
											<?php echo Utils::formatPrice($prezzo_scontato)?>  &euro;
										<?php else:?>
											<?php echo Utils::formatPrice($prezzo)?>  &euro;
										<?php endif;?>
    									</div>
    								</div>
    							</div>
    							
    							<!-- prodotti abbinati -->
    							<?php else:?>
    							<?php 
    							     $img = ($item['img'] !="") ? "/file/".$item['img'] : "/_ext/img/default.jpg";
    							     $img = $site->addWatermarks($img);
    							     
    							     $infoProd1 = $site->productManager->getInfoProduct($item['id_prodotto1']);
    							     $infoProd2 = $site->productManager->getInfoProduct($item['id_prodotto2']);
    							     //devo calcolare il prezzo abbinato
    							     $price1 = $infoProd1['prezzo'];
    							     $price2 = $infoProd2['prezzo'];
    							     
    							     $price = $price1 + $price2;
    							?>
    							<div class="slide">
    								<div class="productImage clearfix">
    									<a href="/eng/details.php?id_abbinamento=<?php echo $item['id'];?>"><img src="https://www.chess-store.it<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
    									<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
    										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
    											<li>
    												<a data-toggle="modal" href="javascript:void(0)" class="btn btn-default" onclick="addAbbinamentoToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')"><i class="fa fa-heart"></i></a>
    											</li>
    											<li>
    												<a href="javascript:void(0)"  onclick="addAbbinamentoToCart(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
    											</li>    
    										</ul>
    									</div> -->
    								</div>
    								<div class="productCaption clearfix">
    									<a href="/eng/details.php?id_abbinamento=<?php echo $item['id'];?>">
    										<div class="titolo_prodotto"><?php echo utf8_encode($item['titolo_en'])?></div>
    									</a>
    									<div class="fjalla prezzo"><?php echo Utils::formatPrice($price)?> &euro;</div>
    								</div>
    							</div>
    							<?php endif;?>
    							<?php endforeach;?>
							</div>
						</div>
					<?php endif;?>
				</div>
				<!-- FINE NOVITA' -->
				
				<!-- OFFERTE -->
				<div class="row featuredProducts">
					<?php $offerte = $site->productManager->getProdottiOfferte();?>
					<?php $abbinamenti = $site->productManager->getAbbinamentiOfferte()?>
					<?php $offerte = array_merge($offerte,$abbinamenti);?>
					<?php if(count($offerte) > 0):?>
					<div class="col-xs-12">
						<div class="page-header">
							<h3 class="fjalla" style="color: #840025;"><img src="img/offerte.png" alt="" style="vertical-align:middle;" class="hidden-xs"/>OFFERS OF THE WEEK</h3>
						
						</div>
					</div>
					<div class="col-xs-12">
						<div class="owl-carousel featuredProductsSlider">
							<?php foreach ($offerte as $item):?>
							
							<!-- prodotti non abbinati -->
							<?php if(!isset($item['abbinamento'])):?>    
							<?php $img = ($item['img_1'] !="") ? "/file/".$item['img_1'] : "/_ext/img/default.jpg";?>	
							<?php $img = $site->addWatermarks($img);?>					
							<div class="slide">
								<div class="productImage clearfix">
									<a href="/eng/details.php?id_prodotto=<?php echo $item['id'];?>"><img src="https://www.chess-store.it/<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
									<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
											<li>
												<a data-toggle="modal" href="javascript:void(0)" class="btn btn-default" onclick="addToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')"><i class="fa fa-heart"></i></a>
											</li>
											<li>
												<a href="javascript:void(0)" onclick="addToCart(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
											</li>    
										</ul>
									</div> -->
								</div>
								<div class="productCaption clearfix">
									<?php 
									$prezzo = $item['prezzo'];
									$prezzo_scontato = ($item['prezzo_scontato']!="" && $item['prezzo_scontato']!="0.00") ? $item['prezzo_scontato'] : false;
									?>
									<a href="/eng/details.php?id_prodotto=<?php echo $item['id'];?>">
										<div class="titolo_prodotto"><?php echo utf8_encode($item['nome_en'])?></div>
									</a>
									<div class="fjalla prezzo">
										<?php if($prezzo_scontato):?>
											<span class="prezzo_pieno"><?php echo Utils::formatPrice($prezzo)?>  &euro;</span> &nbsp;&nbsp;
											<?php echo Utils::formatPrice($prezzo_scontato)?>  &euro;
										<?php else:?>
											<?php echo Utils::formatPrice($prezzo)?>  &euro;
										<?php endif;?>
										
									</div>
								</div>
							</div>
							
							<!-- prodotti abbinati -->
							<?php else:?>
							<?php 
							     $img = ($item['img'] !="") ? "/file/".$item['img'] : "/_ext/img/default.jpg";
							     $img = $site->addWatermarks($img);
							     //devo calcolare il prezzo abbinato
							     $infoProd1 = $site->productManager->getInfoProduct($item['id_prodotto1']);
							     $infoProd2 = $site->productManager->getInfoProduct($item['id_prodotto2']);
							     	
							     //devo calcolare il prezzo abbinato
							     //$price1 = $infoProd1['prezzo'];
							     //$price2 = $infoProd2['prezzo'];
							     
							     $prezzo_intero_1 = $infoProd1['prezzo'];
							     $prezzo_scontato_1 = ($infoProd1['prezzo_scontato']!="" && $infoProd1['prezzo_scontato']!="0.00") ? $infoProd1['prezzo_scontato'] : false;
							     $prezzo_1 = ($prezzo_scontato_1 != '')? $prezzo_scontato_1 : $prezzo_intero_1;
							     	
							     $prezzo_intero_2 = $infoProd2['prezzo'];
							     $prezzo_scontato_2 = ($infoProd2['prezzo_scontato']!="" && $infoProd2['prezzo_scontato']!="0.00") ? $infoProd2['prezzo_scontato'] : false;
							     $prezzo_2 = ($prezzo_scontato_2 != '')? $prezzo_scontato_2 : $prezzo_intero_2;
							     
							     //$price = $price1 + $price2;
							     $prezzo_abbinamento = $prezzo_1 + $prezzo_2;
    							 
							?>
							<div class="slide">
								<div class="productImage clearfix">
									<a href="/eng/details.php?id_abbinamento=<?php echo $item['id'];?>"><img src="https://www.chess-store.it/<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
									<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
											<li>
												<a data-toggle="modal" href="javascript:void(0)" class="btn btn-default" onclick="addAbbinamentoToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')"><i class="fa fa-heart"></i></a>
											</li>
											<li>
												<a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
											</li>    
										</ul>
									</div> -->
								</div>
								<div class="productCaption clearfix">
									<a href="/eng/details.php?id_abbinamento=<?php echo $item['id'];?>">
										<div class="titolo_prodotto"><?php echo utf8_encode($item['titolo_en'])?></div>
									</a>
									<div class="fjalla prezzo">
										<?php if($prezzo_scontato_1 != '' || $prezzo_scontato_2 != ''):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_intero_1 + $prezzo_intero_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php endif;?>
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php endforeach;?>
						</div>
						<?php endif;?>
					</div>
				</div>
				<div
					class="col-md-12 col-sm-12 col-xs-12 text-center home_box hidden-md hidden-lg hidden-xs hidden-sm"
					style="border-top: 1px dotted #666;">
					<img src="img/set_1.jpg" alt="" class="img-responsive"> Choose a chess set from the sections "CHESS MEN + CHESS BOARD", "CHESS MEN + CHESS TABLE"<br>
					or take pleasure in creating your own personalized chess-set
					choosing chess-pieces and chess-board
					in the respective sections

				</div>
				
				<div class="col-md-12 text-center" style="margin:0; padding:0; border-top:1px dotted #850728; padding-top:15px;">
					<p style="font-size:150%; color:#850728; padding-bottom:10px; font-weight:bold;">During the purchase choose the gift wrapping option <br>and you will receive your chess set ready to be presented</p>
					<img src="/_ext/img/production_chest_4.jpg" class="img-responsive" alt=""
						style="margin-bottom: 20px;" />
				</div>
				<div class="col-md-6"
					style="margin: 30px 0 0 0; padding: 0 2px 0 0;">
					<img src="/_ext/img/production_chest_3.jpg" class="img-responsive" alt="<?php $site->getAlt();?>"
						style="margin-bottom: 20px;" />
				</div>

				<div class="col-md-6"
					style="margin: 30px 0 0 0; padding: 0 0 0 2px;">
					<img src="/_ext/img/production_chest_2.jpg" class="img-responsive" alt="<?php $site->getAlt();?>"
						style="margin-bottom: 20px;" />
				</div>
			</div>
		</div>
	</div>
</section>
<?php $popup = $site->getPopUp();?>
<?php if(count($popup) > 0):?>
<div id="popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modalpopup-title"><?php echo utf8_encode($popup['titolo_en'])?></h4>
      </div>
      <div class="modalpopup-body">
        <?php echo utf8_encode($popup['descrizione_en'])?>
      </div>
      <div class="modal-footer" style="text-align:left;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
	$(document).ready(function() {
		$("#popup").modal('show'); 
		});
</script>
<?php endif;?>

