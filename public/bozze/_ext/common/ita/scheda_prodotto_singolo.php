<?php $prodotto_name = $this->prodotto['nome_it'];?>
<section class="lightSection clearfix pageHeader">
	<div class="container">
		<div class="row">
			<div class="col-xs-6">
				<div class="page-title">
					<h2 class="fjalla"><?php echo utf8_encode($prodotto_name)?></h2>
				</div>
			</div>
			<div class="col-xs-6">
				<ol class="breadcrumb pull-right">
					<li><a href="javascript:void(0)">Prodotto</a></li>
					<li class="active"><?php echo utf8_encode($prodotto_name)?></li>
				</ol>
			</div>
		</div>
	</div>
</section>


<section class="mainContent clearfix productsContent"	style="background-color: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12 col-xs-12 sideBar hidden-xs hidden-sm">
				<div class="panel panel-default hidden-xs hidden-sm">
           			<?php $site->getFile('menu-prodotti')?>
					<?php $site->getFile('box_facebook',true)?>
					
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12 singleProduct" style="background-color: #fff;">
			<?php 
				
				$img = ($this->prodotto['img_1'] !="") ? "/file/".$this->prodotto['img_1'] : "/_ext/img/default.jpg";		
				$img = $site->addWatermarks($img);
				
				$img2 =  "/file/".$this->prodotto['img_2'];
				$img3 =  "/file/".$this->prodotto['img_3'];
				$img4 =  "/file/".$this->prodotto['img_4'];
				$img5 =  "/file/".$this->prodotto['img_5'];
				
				
				
				if($this->prodotto['descrizione_breve_it']!=""){
					$descrizione = $this->prodotto['descrizione_breve_it'];
				} else {
					$descrizione = ($this->prodotto['descrizione_it']!="") ? $this->prodotto['descrizione_it'] : substr($this->prodotto['descrizione_it'], 0, 130)."&hellip;";
				}				
				
				$prezzo = $this->prodotto['prezzo'];
				$prezzo_scontato = ($this->prodotto['prezzo_scontato']!="" && $this->prodotto['prezzo_scontato']!="0.00") ? $this->prodotto['prezzo_scontato'] : false;
				
				$actual_url = rawurlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
			?>
			
				<div class="media">
					<div class="col-sm-8">
						<div class="media productSlider">
							
							<div id="carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="item active" data-thumb="0">
										<a href="https://www.chess-store.it<?php echo $img;?>"  class="galleria-item" data-lightbox="image-1">
											<img src="https://www.chess-store.it<?php echo $img;?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
									<?php if($this->prodotto['img_2'] != ''):?>
									<div class="item" data-thumb="1">
										<a href="https://www.chess-store.it<?php echo $site->addWatermarks($img2);?>"  class="galleria-item" data-lightbox="image-1">
											<img src="https://www.chess-store.it<?php echo $site->addWatermarks($img2);?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
									<?php endif?>
									<?php if($this->prodotto['img_3'] != ''):?>
									<div class="item" data-thumb="2">
										<a href="https://www.chess-store.it<?php echo $site->addWatermarks($img3);?>"  class="galleria-item" data-lightbox="image-1">
											<img src="https://www.chess-store.it<?php echo $site->addWatermarks($img3);?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
									<?php endif?>
									<?php if($this->prodotto['img_4'] != ''):?>
									<div class="item" data-thumb="3">
										<a href="https://www.chess-store.it<?php echo $site->addWatermarks($img4);?>"  class="galleria-item" data-lightbox="image-1">
											<img src="https://www.chess-store.it<?php echo $site->addWatermarks($img4);?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
									<?php endif?>
									<?php if($this->prodotto['img_5'] != ''):?>
									<div class="item" data-thumb="4">
										<a href="https://www.chess-store.it<?php echo $site->addWatermarks($img5);?>"  class="galleria-item" data-lightbox="image-1">
											<img src="https://www.chess-store.it<?php echo $site->addWatermarks($img5);?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
									<?php endif?>
								</div>
								<?php if($this->prodotto['img_2'] != ''):?>
								<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
								    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								    <span class="sr-only">Previous</span>
								  </a>
								  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
								    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								    <span class="sr-only">Next</span>
								  </a>
								  <?php endif;?>
							</div>
	
							<div class="clearfix">
								
							</div>
						</div>						
					</div>
					<div class="col-sm-4">
						<div class="media-body">
	
							<h2 style="margin-top: 10px;"><?php echo utf8_encode($this->prodotto['nome_it'])?></h2>
							<?php if ( $prezzo != '0.00' && $prezzo != '100000.00'): ?>
								<?php if($prezzo_scontato):?>
								<h3 style="margin-bottom:6px;"><span class="prezzo_pieno"><?php echo Utils::formatPrice($prezzo)?>  &euro;</span> 
									<br><span style="color:#840025;"><?php echo Utils::formatPrice($prezzo_scontato)?>  &euro;</span>
								</h3>
								<?php else:?>
								<h3 style="margin-bottom:6px;"><?php echo Utils::formatPrice($prezzo)."&nbsp;&euro;";?></h3>
								<?php endif;?>
							<?php else:?>
								<h3>Su ordinazione</h3>
							<?php endif; ?>
							
							<p style="margin-bottom:16px;line-height:1.4">
								Codice prodotto: <strong><?php echo $this->prodotto['codice'];?></strong> <br /> <br /> 
								<?php echo $descrizione?><br /><br /> 
								<?php echo $this->prodotto['dimensioni_it']?><br />
								<?php echo $site->productManager->getDisponibilita($this->prodotto)?>
							</p>
							
							<?php if ( $prezzo != '0.00' ): ?>
                                <?php if($prezzo == '100000.00'): ?>
                                <?php else: ?>
                                    <div class="btn-area">
                                        <a href="javascript:void(0)" onclick="addToCart(<?php echo $this->prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-primary btn-block">+ carrello <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                <?php endif; ?>

							<?php endif; ?>
							<a href="javascript:void(0)" onclick="addToWishList(<?php echo $this->prodotto['id']?>,'<?php echo $this->lang?>')" style="background-color: #840025; padding: 10px;"><i class="fa fa-heart" aria-hidden="true" style="font-size: 130%;"></i></a><br />
	
	
							<div style="height: 30px;"></div>
	
							<iframe
								src="//www.facebook.com/plugins/share_button.php?href=<?php echo $actual_url?>&amp;layout=button_count&amp;appId=552773188215847"
								scrolling="no" frameborder="0" allowtransparency="true"
								style="height: 30px;"></iframe>
							</iframe>
							<div class="clearfix"></div>
							<div class="g-plus" data-action="share" style="margin:0px 0 5px 0;"></div>
							<div class="clearfix"></div>
							<a class="twitter-share-button"  href="https://twitter.com/intent/tweet">Tweet</a>
	
							<script>
								!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- menu prodotti per mobile -->
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<br />
				<br />
				<div class="panel panel-default hidden-md hidden-lg">
					<?php $site->getFile('menu-prodotti-mobile')?>
				</div>
			</div>		
		</div>				
		</div>
		<!-- fine menu prodotti per mobile -->
	</div>
</section>