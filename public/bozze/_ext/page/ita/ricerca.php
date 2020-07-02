<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">RICERCA</h2>
                </div>
            </div>
      	</div>
    </div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-12 col-xs-12 sideBar ">
				<div class="panel panel-default hidden-xs hidden-sm">
					<?php $site->getFile('menu-prodotti')?>
					<?php $site->getFile('box_facebook',true)?>
    				<?php $site->getFile('box_spedizione',true)?>
				</div>
			</div>
			
			<div class="col-md-9 col-sm-12 col-xs-12 sideBar ">
				<?php $prodotti = $site->productManager->searchProducts($_REQUEST['searchterm']);?>
				
				<!-- se devo cercare anche fra gli abbinamenti -->
				<?php $abbinamenti = array();?>
				<?php if(strpos($_REQUEST['searchterm'], "+")!==false):?>
				<?php $abbinamenti = $site->productManager->searchAbbinamenti($_REQUEST['searchterm']); ?>
				<?php else:?>
				<?php $abbinamenti = $site->productManager->searchAbbinamenti2($_REQUEST['searchterm']); ?>
				<?php endif;?>
				
				<?php $altri_abbinamenti = $site->productManager->searchAbbinamenti3($prodotti);?>
				<?php $abbinamenti = array_merge($abbinamenti, $altri_abbinamenti);?>
				
				<?php $num_risultati = count($prodotti) + count($abbinamenti)?>
				
				<?php if($num_risultati == 0):?>
					<p style="padding:40px 0px;font-size:140%;">Nessun risultato per questa ricerca</p>
				<?php else:?>
					<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">La ricerca di <?php echo $_REQUEST['searchterm']?> ha prodotto  <?php echo $num_risultati?> risultati</div>
					<?php if(count($prodotti) > 0):?>					
						
						
						<?php foreach($prodotti as $item):?>
							<?php 
								$prodotto = $site->productManager->getProdotto($item['id']);
								$prezzo = $prodotto['prezzo'];
								$prezzo_scontato = ($prodotto['prezzo_scontato']!="" && $prodotto['prezzo_scontato']!="0.00") ? $prodotto['prezzo_scontato'] : false;						
								
								$img = ($prodotto['img_1'] !="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
								
								if($prodotto['descrizione_breve_it']!=""){
									$descrizione = $prodotto['descrizione_breve_it'];
								} else {
									$descrizione = (strlen($prodotto['descrizione_it']) < 70) ? $prodotto['descrizione_it'] : substr($prodotto['descrizione_it'], 0, 66)."&hellip;";
								}
									
							?>
							<div class="col-sm-4">
				            	<div class="productBox">
				                	<div class="productImage clearfix">
				                		<a href="/dettaglio.php?id_prodotto=<?php echo $prodotto['id'];?>"><img src="https://www.chess-store.it<?php echo $img;?>" alt="<?php $site->getAlt();?>"></a>
			                    		<!-- <div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
			                      			<ul class="list-inline btn-group" role="group" style="width:103px;">
			                        			<li><a data-toggle="modal" href="javascript:void(0)" onclick="addToWishList(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a></li>
			                        			<li><a href="javascript:void(0)" onclick="addToCart(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a></li>
			                                </ul>
			                    		</div> -->
				                  	</div>
					                <div class="productCaption clearfix">
					                	<a href="/dettaglio.php?id_prodotto=<?php echo $prodotto['id'];?>">
					                    	<div class="titolo_prodotto"><?php echo utf8_encode($prodotto['nome_it']);?></div>
					                    </a>
						                <div class="fjalla prezzo" >
						                	<?php if($prezzo != '0.00' && $prezzo != '100000.00'):?>
							                	<?php if($prezzo_scontato):?>
							                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato)."&nbsp;&euro;";?>
							                	<?php else:?>
							                		<?php echo Utils::formatPrice($prezzo)."&nbsp;&euro;";?>
							                	<?php endif;?>
						                	<?php else:?>
						                		su ordinazione
						                	<?php endif;?>
						                	
						                </div>
										<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
										
										<i>Codice prodotto: <?php echo $prodotto['codice'];?></i>
										<a href="/dettaglio.php?id_prodotto=<?php echo $prodotto['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Dettagli prodotto</a>
					             	</div>
				            	</div>
				            </div>
						<?php endforeach;?>
					<?php endif;?>
					<?php if(count($abbinamenti) > 0):?>
						<?php foreach($abbinamenti as $abbinamento):?>
						<?php 
							$id_prodotto1 = $abbinamento['id_prodotto1'];
							$id_prodotto2 = $abbinamento['id_prodotto2'];
							
							$prodotto1 = $site->productManager->getProdotto($id_prodotto1);
							$prodotto2 = $site->productManager->getProdotto($id_prodotto2);
							
							
							$prezzo_intero_1 = $prodotto1['prezzo'];
							$prezzo_scontato_1 = ($prodotto1['prezzo_scontato']!="" && $prodotto1['prezzo_scontato']!="0.00") ? $prodotto1['prezzo_scontato'] : false;
							$prezzo_1 = ($prezzo_scontato_1 != '')? $prezzo_scontato_1 : $prezzo_intero_1;
							
							$prezzo_intero_2 = $prodotto2['prezzo'];
							$prezzo_scontato_2 = ($prodotto2['prezzo_scontato']!="" && $prodotto2['prezzo_scontato']!="0.00") ? $prodotto2['prezzo_scontato'] : false;
							$prezzo_2 = ($prezzo_scontato_2 != '')? $prezzo_scontato_2 : $prezzo_intero_2;
							
							$img_abbinamento = ($abbinamento['img'] !="") ? "/file/".$abbinamento['img'] : "/_ext/img/default.jpg";
							$img_abbinamento = $site->addWatermarks($img_abbinamento);
							
							$descrizione = ($abbinamento['descrizione']!="") ? $abbinamento['descrizione'] : substr($abbinamento['descrizione'], 0, 130)."&hellip;";
							
							$prezzo_abbinamento = $prezzo_1 + $prezzo_2;
						?>
						<div class="col-sm-4">
			            	<div class="productBox">
			                	<div class="productImage clearfix">
			                		<a href="/dettaglio.php?id_abbinamento=<?php echo $abbinamento['id'];?>"><img src="https://www.chess-store.it<?php echo $img_abbinamento;?>" alt="<?php $site->getAlt();?>"></a>
		                    		<!-- <div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
		                      			<ul class="list-inline btn-group" role="group" style="width:103px;">
		                        			<li><a data-toggle="modal" href="javascript:void(0)" onclick="addAbbinamentoToWishList(<?php echo $abbinamento['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a></li>
		                        			<li><a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $abbinamento['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a></li>
		                                </ul>
		                    		</div> -->
			                  	</div>
				                <div class="productCaption clearfix">
				                	<a href="/dettaglio.php?id_abbinamento=<?php echo $abbinamento['id'];?>">
				                    	<div class="titolo_prodotto"><?php echo utf8_encode($abbinamento['titolo']);?></div>
				                    </a>
					                <div class="fjalla prezzo" >					                	
					                	<?php if($prezzo_scontato_1 != '' || $prezzo_scontato_2 != ''):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_intero_1 + $prezzo_intero_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php endif;?>
					                </div>
									<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
									
									<i>Codice prodotto: <?php echo $prodotto1['codice'];?> + <?php echo $prodotto2['codice'];?></i>
									<a href="/dettaglio.php?id_abbinamento=<?php echo $abbinamento['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Dettagli prodotto</a>
				             	</div>
			            	</div>
			            </div>
						<?php endforeach;?>
					<?php endif;?>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>