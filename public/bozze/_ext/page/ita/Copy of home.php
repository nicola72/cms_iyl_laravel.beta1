
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
	    	<div class="col-md-12 text-center" style="font-size:180%; padding-top:30px; line-height:1.5em; font-weight:bold;">Scegli un set scacchi nella sezione
				SCACCHI+SCACCHIERE, SCACCHI+TAVOLI SCACCHIERA<br/>oppure divertiti a comporre il tuo set scacchi scegliendo scacchi e scacchiera nelle rispettive sezioni
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
    							<h3 class="fjalla" style="color: #840025;">	NOVITA' IN VETRINA</h3>						
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
    									<a href="/dettaglio.php?id_prodotto=<?php echo $item['id'];?>"><img src="https://www.chess-store.it<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
    									<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
    										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
    											<li>
    												<a data-toggle="modal" href="javascript:void(0)" onclick="addToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a>
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
    									<a href="/dettaglio.php?id_prodotto=<?php echo $item['id'];?>">
    										<div class="titolo_prodotto"><?php echo utf8_encode($item['nome_it'])?></div>
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
    									<a href="/dettaglio.php?id_abbinamento=<?php echo $item['id'];?>"><img src="https://www.chess-store.it<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
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
    									<a href="/dettaglio.php?id_abbinamento=<?php echo $item['id'];?>">
    										<div class="titolo_prodotto"><?php echo utf8_encode($item['titolo'])?></div>
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
							<h3 class="fjalla" style="color: #840025;"><img src="/img/offerte.png" alt="" style="vertical-align:middle;" class="hidden-xs"/>OFFERTE DELLA SETTIMANA</h3>
						
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
									<a href="/dettaglio.php?id_prodotto=<?php echo $item['id'];?>"><img src="https://www.chess-store.it/<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
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
									<a href="/dettaglio.php?id_prodotto=<?php echo $item['id'];?>">
										<div class="titolo_prodotto"><?php echo utf8_encode($item['nome_it'])?></div>
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
									<a href="/dettaglio.php?id_abbinamento=<?php echo $item['id'];?>"><img src="https://www.chess-store.it/<?php echo $img?>" alt="<?php $site->getAlt();?>"></a>
									<div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
										<ul class="list-inline btn-group" role="group"	style="width: 103px;">
											<li>
												<a data-toggle="modal" href="javascript:void(0)" class="btn btn-default" onclick="addAbbinamentoToWishList(<?php echo $item['id']?>,'<?php echo $this->lang?>')"><i class="fa fa-heart"></i></a>
											</li>
											<li>
												<a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $item['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
											</li>    
										</ul>
									</div>
								</div>
								<div class="productCaption clearfix">
									<a href="/dettaglio.php?id_abbinamento=<?php echo $item['id'];?>">
										<div class="titolo_prodotto"><?php echo utf8_encode($item['titolo'])?></div>
									</a>
									<div class="fjalla prezzo">
										<?php if($prezzo_scontato_1 != '' || $prezzo_scontato_2 != ''):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_intero_1 + $prezzo_intero_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
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
					<img src="img/set_1.jpg" alt="" class="img-responsive"> Scegli un
					set scacchi nella sezione<br /> SET COMPLETI oppure divertiti a
					comporre il tuo set scacchi scegliendo scacchi e scacchiera nelle
					rispettive sezioni

				</div>
				<div
					class="col-sm-12 col-xs-12 text-center home_box  hidden-md hidden-lg">

					<div class="imageWrapper">
						<img src="img/shipping.jpg" alt="" class="img-responsive"
							style="display: block; margin: 0 auto;"> SPEDIZIONE STANDARD
						GRATIS IN TUTTA ITALIA<br /> <span style="font-size: 90%;">per
							ordini<br />di importo superiore a 49 €
						</span>


					</div>
				</div>
				<div class="col-md-12 text-center" style="margin:0; padding:0; border-top:1px dotted #850728; padding-top:15px;">
					<p style="font-size:150%; color:#850728; padding-bottom:10px; font-weight:bold;">Durante l'acquisto scegli l'opzione pacchetto regalo<br/>e riceverai il tuo set di scacchi pronto per essere regalato</p>
					<img src="/_ext/img/scacchi_online_5.jpg" class="img-responsive" alt=""
						style="margin-bottom: 20px;" />
					
				</div>
				<div class="col-md-6"
					style="margin: 30px 0 0 0; padding: 0 2px 0 0;">
					<img src="/_ext/img/scacchi_online_7.jpg" class="img-responsive" alt="<?php $site->getAlt();?>"
						style="margin-bottom: 20px;" />
				</div>

				<div class="col-md-6"
					style="margin: 30px 0 0 0; padding: 0 0 0 2px;">
					<img src="/_ext/img/scacchi_online_6.jpg" class="img-responsive" alt="<?php $site->getAlt();?>"
						style="margin-bottom: 20px;" />
				</div>
			</div>
		</div>
	</div>
</section>

