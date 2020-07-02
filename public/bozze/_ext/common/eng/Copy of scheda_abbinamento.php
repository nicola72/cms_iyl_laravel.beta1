<?php $prodotto_name = $this->prodotto['titolo_en']?>
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
					<li><a href="index.html">Product</a></li>
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
					<?php //$site->getFile('box_spedizione',true)?>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12 singleProduct" style="background-color: #fff;">
				<?php 
					$img = ($this->prodotto['img'] !="") ? "/file/".$this->prodotto['img'] : "/_ext/img/default.jpg";
					$img = $site->addWatermarks($img);
					
					$id_prodotto1 = $this->prodotto['id_prodotto1'];
					$id_prodotto2 = $this->prodotto['id_prodotto2'];
					
					$prodotto1 = $site->productManager->getProdotto($id_prodotto1);
					$prodotto2 = $site->productManager->getProdotto($id_prodotto2);
					
					
					$prezzo_intero_1 = $prodotto1['prezzo'];
					$prezzo_scontato_1 = ($prodotto1['prezzo_scontato']!="" && $prodotto1['prezzo_scontato']!="0.00") ? $prodotto1['prezzo_scontato'] : false;
					$prezzo_1 = ($prezzo_scontato_1 != '')? $prezzo_scontato_1 : $prezzo_intero_1;
						
					$prezzo_intero_2 = $prodotto2['prezzo'];
					$prezzo_scontato_2 = ($prodotto2['prezzo_scontato']!="" && $prodotto2['prezzo_scontato']!="0.00") ? $prodotto2['prezzo_scontato'] : false;
					$prezzo_2 = ($prezzo_scontato_2 != '')? $prezzo_scontato_2 : $prezzo_intero_2;
					
					$descrizione = ($this->prodotto['descrizione_en']!="") ? $this->prodotto['descrizione_en'] : substr($this->prodotto['descrizione_en'], 0, 130)."&hellip;";
					
					$actual_url = rawurlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					
					$prezzo_abbinamento = $prezzo_1 + $prezzo_2;
				?>
				<div class="media">
					<div class="col-sm-8">
						<div class="media-left productSlider">
							<div id="carousel" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="item active" data-thumb="0">
										<a href="https://www.chess-store.it<?php echo $img;?>" data-gal="prettyPhoto[gallery 1]" class="galleria-item">
											<img src="https://www.chess-store.it<?php echo $img;?>" class="img-responsive" alt="<?php $site->getAlt();?>"/>
										</a>
									</div>
								</div>
							</div>
	
							<div class="clearfix">
								
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="media-body">
	
							<h2 style="margin-top: 10px;"><?php echo utf8_encode($this->prodotto['titolo_en'])?></h2>
							<h3 style="margin-bottom:6px;">
								
								
								<?php if($prezzo_scontato_1 != '' || $prezzo_scontato_2 != ''):?>
					            	<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_intero_1 + $prezzo_intero_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					            <?php else:?>
					            	<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					            <?php endif;?>
							</h3>
							<p style="margin-bottom:16px;">
								Product code: <?php echo $prodotto1['codice'];?> + <?php echo $prodotto2['codice'];?><br /> 
								<?php echo $descrizione?>
							</p>
	
	
							<div class="btn-area">
								<a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $this->prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-primary btn-block">+ cart <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</div>
							<a href="javascript:void(0)" onclick="addAbbinamentoToWishList(<?php echo $this->prodotto['id']?>,'<?php echo $this->lang?>')" style="background-color: #840025; padding: 10px;"><i class="fa fa-heart" aria-hidden="true" style="font-size: 130%;"></i></a><br />
	
	
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
			<div class="col-md-6 col-md-offset-2" style="border-top:1px dotted #666; padding:20px 0px"></div>
			
			<!-- i singoli prodotti dell'abbinamento -->
			<?php 
				$img_prd_1 = ($prodotto1['img_1'] !="") ? "/file/".$prodotto1['img_1'] : "/_ext/img/default.jpg";		
				$img_prd_1 = $site->addWatermarks($img_prd_1);
				$img_prd_2 = ($prodotto2['img_1'] !="") ? "/file/".$prodotto2['img_1'] : "/_ext/img/default.jpg";
				$img_prd_2 = $site->addWatermarks($img_prd_2);
				
				if($prodotto1['descrizione_breve_it']!=""){
					$descrizione_1 = $prodotto1['descrizione_breve_en'];
				} else {
					$descrizione_1 = ($prodotto1['descrizione_en']!="") ? $prodotto1['descrizione_en'] : substr($prodotto1['descrizione_en'], 0, 130)."&hellip;";
				}
				
				if($prodotto2['descrizione_breve_en']!=""){
					$descrizione_2 = $prodotto2['descrizione_breve_en'];
				} else {
					$descrizione_2= ($prodotto2['descrizione_en']!="") ? $prodotto2['descrizione_en'] : substr($prodotto2['descrizione_en'], 0, 130)."&hellip;";
				}
				
				$prezzo_1 = $prodotto1['prezzo'];
				$prezzo_scontato_1 = ($prodotto1['prezzo_scontato']!="" && $prodotto1['prezzo_scontato']!="0.00") ? $prodotto1['prezzo_scontato'] : false;
				
				$prezzo_2 = $prodotto2['prezzo'];
				$prezzo_scontato_2 = ($prodotto2['prezzo_scontato']!="" && $prodotto2['prezzo_scontato']!="0.00") ? $prodotto2['prezzo_scontato'] : false;
			?>
			<div class="col-md-9 col-xs-12 col-sm-12" style="background-color: #fff;">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="productBox">
						<div class="productImage clearfix">
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto1['id'];?>"><img src="https://www.chess-store.it<?php echo $img_prd_1;?>" alt="<?php $site->getAlt()?> "></a>
							<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
								<ul class="list-inline btn-group" role="group"	style="width: 103px;">
									<li><a data-toggle="modal" href="javascript:void(0)" onclick="addAbbinamentoToWishList(<?php echo $prodotto1['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a>
									</li>
									<li><a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $prodotto1['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
									</li>			
								</ul>
							</div> -->
						</div>
						<div class="productCaption clearfix">
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto1['id'];?>">
								<div class="titolo_prodotto"><?php echo $prodotto1['nome_en']?></div>
							</a>
							<div class="fjalla prezzo">
								<?php if($prezzo_scontato_1):?>
					            	<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_1)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato_1)."&nbsp;&euro;";?>
					            <?php else:?>
					            	<?php echo Utils::formatPrice($prezzo_1)."&nbsp;&euro;";?>
					            <?php endif;?>
							</div>
							<div class="prodDescrizione"><strong><?php echo $descrizione_1 ?></strong></div>
							<div class="prodDimensioni"><?php echo $prodotto1['dimensioni_en']?></div>
							<div class="prodDisp"><?php echo $site->productManager->getDisponibilita($prodotto1)?></div>	
							<br /> 
							<i>Product code: <?php echo $prodotto1['codice']?></i> 
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto1['id'];?>"	class="dettagli"><i class="fa fa-search"></i> Product details</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="productBox">
						<div class="productImage clearfix">
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto2['id'];?>"><img src="https://www.chess-store.it<?php echo $img_prd_2;?>" alt="<?php $site->getAlt()?> "></a>
							<!-- <div class="productMasking"	style="background-color: rgba(0, 0, 0, 0.6);">
								<ul class="list-inline btn-group" role="group" style="width: 103px;">
									<li><a data-toggle="modal" href="javascript:void(0)" onclick="addAbbinamentoToWishList(<?php echo $prodotto2['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a>
									</li>
									<li><a href="javascript:void(0)" class="btn btn-default" onclick="addAbbinamentoToCart(<?php echo $prodotto2['id']?>,'<?php echo $this->lang?>')"><i class="fa fa-shopping-cart"></i></a>
									</li>
			
								</ul>
							</div> -->
						</div>
						<div class="productCaption clearfix">
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto2['id'];?>">
								<div class="titolo_prodotto"><?php echo $prodotto2['nome_en']?></div>
							</a>
							<div class="fjalla prezzo">
								<?php if($prezzo_scontato_2):?>
					            	<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato_2)."&nbsp;&euro;";?>
					            <?php else:?>
					            	<?php echo Utils::formatPrice($prezzo_2)."&nbsp;&euro;";?>
					            <?php endif;?>
							</div>
							<div class="prodDescrizione"><strong><?php echo $descrizione_2 ?></strong></div>
							<div class="prodDimensioni"><?php echo $prodotto2['dimensioni_it']?></div>
							<div class="prodDisp"><?php echo $site->productManager->getDisponibilita($prodotto2)?></div>
							<br /> 
							<i>Product code: <?php echo $prodotto2['codice']?></i> 
							<a href="/eng/details.php?id_prodotto=<?php echo $prodotto2['id'];?>"	class="dettagli"><i class="fa fa-search"></i> product details</a>
						</div>
					</div>
				</div>
			</div>
			<!-- fine singoli prodotti -->
			<div class="hidden-md hidden-lg" style="clear:both;"></div>
			
			<!-- prodotti correlati -->
			<div class="col-md-9 col-xs-12 col-sm-12" style="background-color: #fff;">
			<?php $site->getFile('abbinamenti_correlati',true)?>
			</div>
			<!-- fine prodotti correlati -->
		</div>
	</div>
</section>
