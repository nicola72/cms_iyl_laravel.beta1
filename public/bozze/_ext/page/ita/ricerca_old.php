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
				<?php $prodotti = $site->productManager->searchProducts($_POST['searchterm']);?>
				
				<?php if(count($prodotti) > 0):?>					
					<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">La ricerca di <?php echo $_POST['searchterm']?> ha prodotto  <?php echo $this->productManager->nr_prodotti?> risultati</div>
					
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
						<div class="col-sm-4 col-xs-12">
			            	<div class="productBox">
			                	<div class="productImage clearfix">
			                		<img src="https://www.chess-store.it<?php echo $img;?>" alt="<?php $site->getAlt();?>">
		                    		<div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
		                      			<ul class="list-inline btn-group" role="group" style="width:103px;">
		                        			<li><a data-toggle="modal" href="javascript:void(0)" onclick="addToWishList(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a></li>
		                        			<li><a href="javascript:void(0)" onclick="addToCart(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a></li>
		                                </ul>
		                    		</div>
			                  	</div>
				                <div class="productCaption clearfix">
				                	<a href="/dettaglio.php?id_prodotto=<?php echo $prodotto['id'];?>">
				                    	<div class="titolo_prodotto"><?php echo utf8_encode($prodotto['nome_it']);?></div>
				                    </a>
					                <div class="fjalla prezzo" >
					                	<?php if($prezzo_scontato):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php echo Utils::formatPrice($prezzo)."&nbsp;&euro;";?>
					                	<?php endif;?>
					                	
					                </div>
									<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
									
									<i>Codice prodotto: <?php echo $prodotto['codice'];?></i>
									<a href="/dettaglio.php?id_prodotto=<?php echo $prodotto['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Dettagli prodotto</a>
				             	</div>
			            	</div>
			            </div>
						<?php endforeach;?>
				<?php else:?>
				<p style="padding:40px 0px;font-size:140%;">Nessun risultato per questa ricerca</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>