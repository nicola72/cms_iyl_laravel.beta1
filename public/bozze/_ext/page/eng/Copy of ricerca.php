<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">SEARCH</h2>
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
			
			<div class="col-md-9 col-sm-12 sideBar ">
				<?php $prodotti = $site->productManager->searchProducts($_POST['searchterm']);?>
				
				<?php if(count($prodotti) > 0):?>					
					<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">The search of <?php echo $_POST['searchterm']?> has produced  <?php echo $this->productManager->nr_prodotti?> results</div>
					
					<?php foreach($prodotti as $item):?>
						<?php 
							$prodotto = $site->productManager->getProdotto($item['id']);
							$prezzo = $prodotto['prezzo'];
							$prezzo_scontato = ($prodotto['prezzo_scontato']!="" && $prodotto['prezzo_scontato']!="0.00") ? $prodotto['prezzo_scontato'] : false;						
							
							$img = ($prodotto['img_1'] !="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
							
							if($prodotto['descrizione_breve_en']!=""){
								$descrizione = $prodotto['descrizione_breve_en'];
							} else {
								$descrizione = (strlen($prodotto['descrizione_en']) < 70) ? $prodotto['descrizione_en'] : substr($prodotto['descrizione_en'], 0, 66)."&hellip;";
							}
								
						?>
						<div class="col-sm-4">
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
				                	<a href="/eng/details.php?id_prodotto=<?php echo $prodotto['id'];?>">
				                    	<div class="titolo_prodotto"><?php echo utf8_encode($prodotto['nome_en']);?></div>
				                    </a>
					                <div class="fjalla prezzo" >
					                	<?php if($prezzo_scontato):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php echo Utils::formatPrice($prezzo)."&nbsp;&euro;";?>
					                	<?php endif;?>
					                	
					                </div>
									<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
									
									<i>Product code: <?php echo $prodotto['codice'];?></i>
									<a href="/eng/details.php?id_prodotto=<?php echo $prodotto['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Product details</a>
				             	</div>
			            	</div>
			            </div>
						<?php endforeach;?>
				<?php else:?>
				<p style="padding:40px 0px;font-size:140%;">No results for this search</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>