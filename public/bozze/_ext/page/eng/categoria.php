<section class="lightSection clearfix pageHeader">
    <div class="container">
    	<div class="row">
        	<div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla"><?php echo $this->categoria['nome_en']?></h2>
                </div>
            </div>
         
        <div class="col-xs-6">
            <ol class="breadcrumb pull-right">
                <li>
                  <a href="javascript:void(0)">Home</a>
                </li>
                <li>
                  <a href="#"><?php echo $this->categoria['nome_en']?></a>
                </li>
           
              </ol>
            </div>
        </div>
    </div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-12 sideBar ">
				<div class="panel panel-default" style="padding-bottom:20px;">
     				<div class="panel-heading fjalla" style="font-weight:100; background-color:#eee; color:#666;">Order by:</div>
    
    				<?php $site->getFormOrdinamento();?>    				
    			</div>
    			<?php if($this->is_abbinamento == true):?>
    			<div class="panel panel-default" style="padding-bottom:20px;">
 					<div class="panel-heading fjalla" style="font-weight:100; background-color:#eee; color:#666;">Filter by:</div>
    				
    				<?php $site->getFormFiltro()?>    				
				</div>
				<?php endif;?>
				<div class="panel panel-default hidden-xs hidden-sm">
					<?php $site->getFile('menu-prodotti')?>
					<?php $site->getFile('box_facebook',true)?>
    				<?php //$site->getFile('box_spedizione',true)?>
				</div>
			</div>
			
			<div class="col-md-9 col-sm-12 sideBar ">
				<?php if($site->categoria['descrizione_en'] != ''):?>
				<div class="categoria-description"><?php echo utf8_encode($site->categoria['descrizione_en'])?></div>
				<?php endif;?>
				
				<!-- prodotti abbinati -->
				<?php if($this->is_abbinamento):?>
				<?php $prodotti = $site->productManager->getAbbinamenti();?>
				<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">There are <?php echo $this->productManager->nr_prodotti?> products in this category</div>
				
					
					<?php if(count($prodotti) > 0):?>
						<?php foreach($prodotti as $abbinamento):?>
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
							
							$descrizione = ($abbinamento['descrizione_en']!="") ? $abbinamento['descrizione_en'] : substr($abbinamento['descrizione_en'], 0, 130)."&hellip;";
							
							$prezzo_abbinamento = $prezzo_1 + $prezzo_2;
						?>
						<div class="col-sm-4">
			            	<div class="productBox">
			                	<div class="productImage clearfix">
			                		<a href="/eng/details.php?id_abbinamento=<?php echo $abbinamento['id'];?>"><img src="https://www.chess-store.it<?php echo $img_abbinamento;?>" alt="<?php $site->getAlt();?>"></a>
		                    		<!-- <div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
		                      			<ul class="list-inline btn-group" role="group" style="width:103px;">
		                        			<li><a data-toggle="modal" href="javascript:void(0)" onclick="addAbbinamentoToWishList(<?php echo $abbinamento['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a></li>
		                        			<li><a href="javascript:void(0)" onclick="addAbbinamentoToCart(<?php echo $abbinamento['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a></li>
		                                </ul>
		                    		</div> -->
			                  	</div>
				                <div class="productCaption clearfix">
				                	<a href="/eng/details.php?id_abbinamento=<?php echo $abbinamento['id'];?>">
				                    	<div class="titolo_prodotto"><?php echo utf8_encode($abbinamento['titolo_en']);?></div>
				                    </a>
					                <div class="fjalla prezzo" >					                	
					                	<?php if($prezzo_scontato_1 != '' || $prezzo_scontato_2 != ''):?>
					                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo_intero_1 + $prezzo_intero_2)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php else:?>
					                		<?php echo Utils::formatPrice($prezzo_abbinamento)."&nbsp;&euro;";?>
					                	<?php endif;?>
					                </div>
									<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
									
									<i>Product code: <?php echo $prodotto1['codice'];?> + <?php echo $prodotto2['codice'];?></i>
									<a href="/eng/details.php?id_abbinamento=<?php echo $abbinamento['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Product details</a>
				             	</div>
			            	</div>
			            </div>
						<?php endforeach;?>
					<?php endif;?>
					
					<?php $site->getFile('paginatore');?>
				<!-- fine prodotti abbinati -->
				
				<!-- prodotti non abbinati -->	
				<?php else:?>
					<?php $prodotti = $site->productManager->getProdotti();?>
					<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">There are <?php echo $this->productManager->nr_prodotti?> products in this category</div>
					<?php if(count($prodotti) > 0):?>
						<?php foreach($prodotti as $item):?>
						<?php 
							$prodotto = $site->productManager->getProdotto($item['id']);
							$prezzo = $prodotto['prezzo'];
							$prezzo_scontato = ($prodotto['prezzo_scontato']!="" && $prodotto['prezzo_scontato']!="0.00") ? $prodotto['prezzo_scontato'] : false;						
							
							$img = ($prodotto['img_1'] !="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";
							$img = $site->addWatermarks($img);
							
							if($prodotto['descrizione_breve_en']!=""){
								$descrizione = $prodotto['descrizione_breve_en'];
							} else {
								$descrizione = (strlen($prodotto['descrizione_en']) < 70) ? $prodotto['descrizione_en'] : substr($prodotto['descrizione_en'], 0, 66)."&hellip;";
							}
								
						?>
						<div class="col-sm-4">
			            	<div class="productBox">
			                	<div class="productImage clearfix">
			                		<a href="/eng/details.php?id_prodotto=<?php echo $prodotto['id'];?>"><img src="https://www.chess-store.it<?php echo $img;?>" alt="<?php $site->getAlt();?>"></a>
		                    		<!-- <div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
		                      			<ul class="list-inline btn-group" role="group" style="width:103px;">
		                        			<li><a data-toggle="modal" href="javascript:void(0)" onclick="addToWishList(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-heart"></i></a></li>
		                        			<li><a href="javascript:void(0)" onclick="addToCart(<?php echo $prodotto['id']?>,'<?php echo $this->lang?>')" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a></li>
		                                </ul>
		                    		</div> -->
			                  	</div>
				                <div class="productCaption clearfix">
				                	<a href="/eng/details.php?id_prodotto=<?php echo $prodotto['id'];?>">
				                    	<div class="titolo_prodotto">
				                    		<?php if(strlen($prodotto['nome_it']) > 50):?>
				                    		<?php echo substr(utf8_encode($prodotto['nome_en']),0, 50);?>...
				                    		<?php else:?>
				                    		<?php echo utf8_encode($prodotto['nome_en']);?>
				                    		<?php endif;?>
				                    	</div>
				                    	
				                    </a>
					                <div class="fjalla prezzo" >
					                	<?php if($prezzo != '0.00' && $prezzo != '100000.00'):?>
						                	<?php if($prezzo_scontato):?>
						                		<span class="FullProdPrice"><?php echo Utils::formatPrice($prezzo)?>&nbsp;&euro;</span>&nbsp;&nbsp;<?php echo Utils::formatPrice($prezzo_scontato)."&nbsp;&euro;";?>
						                	<?php else:?>
						                		<?php echo Utils::formatPrice($prezzo)."&nbsp;&euro;";?>
						                	<?php endif;?>
					                	<?php else:?>
						                	Made to order
						                <?php endif;?>
					                </div>
									<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
									
									<i>Product code: <?php echo $prodotto['codice'];?></i>
									<a href="/eng/details.php?id_prodotto=<?php echo $prodotto['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Product details</a>
				             	</div>
			            	</div>
			            </div>
						<?php endforeach;?>
					<?php endif;?>
					<?php $site->getFile('paginatore');?>
				<?php endif;?>
				
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