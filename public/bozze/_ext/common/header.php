	<?php $pages = array('home','azienda','dove_siamo','contatti','recensioni');?>
	<div class="header clearfix">
        <!-- TOPBAR -->
        <div class="topBar">
        	<?php $site->getH1()?>
          <div class="container">
            <div class="row">
              <div class="col-md-6 hidden-sm hidden-xs">
                <ul class="list-inline">
                  
                  <li><a href="https://www.facebook.com/Marsilis-Company-316915328512344/" target="_blank"><i class="fa fa-facebook"></i></a></li>
             
                </ul>
              </div>
              <div class="col-md-6 col-xs-12">
                <ul class="list-inline pull-right">
                	<li>
                		<?php if($this->lang == 'ita'):?>
                      		<a href="<?php $site->getUrl('home','eng')?>"><img src="/_ext/img/flag_eng.jpg" alt="" /></a>
                      	<?php else:?>
                      		<a href="<?php $site->getUrl('home','ita')?>"><img src="/_ext/img/flag_ita.jpg" alt="" /></a>
                      	<?php endif;?>
                      		<a href="https://www.chess-store.net"><img src="/_ext/img/flag_esp.jpg" alt="" /></a>
                      		<a href="https://www.chess-store-italy.ru"><img src="/_ext/img/flag_rus.jpg" alt="" /></a>
                            <a href="https://www.chessstore.de"><img src="/_ext/img/flag_deu.jpg" alt="" /></a>
                	</li>
                  	<?php if($site->isLogged()):?>
                  	<?php $site->getFile('auth_menu')?>
                  	<?php else:?>
                  	<?php $site->getFile('no_auth_menu')?>
                  	<?php endif;?>
                 	<li class="dropdown searchBox">
                    	<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                    	
                        <ul class="dropdown-menu dropdown-menu-right" style="margin-left:30px;">
                          <li>
                          	<form id="search_form" action="<?php $site->getUrl('ricerca')?>" method="get">
                            <span class="input-group">
	                            
	                            	<input type="text" name="searchterm" class="form-control" placeholder="<?php echo _SEARCH ?>" aria-describedby="basic-addon2">
	                            	<span style="cursor:pointer" class="input-group-addon" id="basic-addon2" onclick="$('#search_form').submit();"><?php echo _SEARCH ?></span>
	                                                      
                            </span>
                            </form> 
                          </li>
                        </ul>
                        
                  	</li>
                  	<li><a href="<?php $site->getUrl('wishlist')?>">&nbsp;&nbsp;<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;&nbsp;</a></li>
                 	<!-- pulsante carrello per mobile -->
                 	<li class="hidden-md hidden-sm hidden-lg">
                   		<a href="<?php $site->getUrl('carrello')?>"><i class="fa fa-shopping-cart"></i> <span class="carrello_nr"><?php echo $site->getCartCount();?></span> </a>                    
                 	</li>   
                 	<!--  --> 
                  	
                  	<!-- pulsante carrello per desktop -->
                 	<li class="dropdown hidden-xs" >
                   		<a href="<?php $site->getUrl('carrello')?>" class="dropdown-toggle" data-toggle="dropdown disabled"><i class="fa fa-shopping-cart"></i> <span class="carrello_nr"><?php echo $site->getCartCount();?></span> </a> 
                   		<?php $prod_nel_carrello = $site->carrello->getProdottiCarrello()?>
                   		<ul id="cart-menu" class="dropdown-menu dropdown-menu-right">
                   			
                   			<?php if(count($prod_nel_carrello) > 0):?>
		                      	<li><?php echo _CARRELLO_MSG?></li>
		                      	
		                      	<?php foreach($prod_nel_carrello as $prod):?>
		                      	<li>
		                      		<?php $prodotto = $site->productManager->getInfoProduct($prod['id_prodotto']);?>
		                      		<?php $img = ($prodotto['img_1']!="") ? "/file/".$prodotto['img_1'] : "/_ext/img/default.jpg";?>
		                       		<a href="javascript:void(0)">
		                          		<div class="media">
		                            		<img class="media-left media-object foto_carrello" src="https://www.chess-store.it<?php echo $img?>" alt="">
		                            		<div class="media-body">
		                              			<h5 class="media-heading" style="max-width:130px;overflow: hidden;">
		                              				<?php echo substr($prodotto['nome_'.$this->langDir],0,10);?>...
		                              				<br>
		                              				<span><?php echo $prod['qta'];?> X &euro; <?php echo Utils::formatPrice($prod['prezzo'])?></span>
		                             			 </h5>
		                            		</div>
		                          		</div>
		                        	</a>
		                      	</li>
		                      	<?php endforeach;?>
		                    <?php else:?>
		                    	<li><?php echo _CARRELLO_MSG2?></li>
	                     	<?php endif;?>
	                      	<li>
	                        	<div class="btn-group" role="group" aria-label="..." style="text-align:rigth;">
	                          		<button type="button" class="btn btn-default" style="color:#000;margin-left:130px;" onclick="location.href='<?php $site->getUrl('carrello')?>';"><?php echo _CARRELLO?></button>
	                          
	                        	</div>
	                      	</li>
	                    </ul>                   
                 	</li> 
                 	<!--  -->                  
                </ul>
              </div>
            </div>
          </div>    
        </div>

        <!-- NAVBAR -->
        <nav class="navbar navbar-main navbar-default" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php $site->getUrl('home')?>" style="min-height:70px; display:block; float:none;">
              	<img src="<?php $site->getLogo()?>" alt="<?php $site->getAlt();?>" style="margin-bottom:2px;">
              </a>
              <?php if($this->page == 'home_old'):?>
              <span class="negozio" ><?php echo ($this->lang == 'ita')? 'IL NEGOZIO DI SCACCHI A FIRENZE':'THE CHESS STORE IN FLORENCE<br>FOR EXTRA UE SHIPPINGS THE ITALIAN VAT WILL BE AUTOMATICALLY DEDUCED DURING THE PURCHASE';?></span>
              <?php else:?>
              <span class="negozio scritta hidden-sm hidden-md hidden-lg text-center" style="line-height:1.1em; font-size:20px;">
              	<?php echo ($this->lang == 'ita')? 'IL NEGOZIO DI SCACCHI<br />A FIRENZE':'THE CHESS STORE<br />IN FLORENCE';?></span>
              <?php endif;?>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">            
              <ul class="nav navbar-nav navbar-right">
              	<?php foreach($pages as $page):?>
              	<?php $class = ($page == $this->page)?'active':'';?>
              		<li class="<?php echo $class?>"><a href="<?php $site->getUrl($page)?>"><?php $site->getLabel($page)?></a></li>
              	<?php endforeach;?>
                
              </ul>
            </div><!-- /.navbar-collapse -->
          </div>
          <?php if(/*$this->page != 'home' && */$this->lang == 'ita'):?>
          <div class="negozio scritta hidden-xs col-sm-12 col-md-12 text-center abril shipping_sm" >
          	<span style="color:#000; font-family: 'Fjalla One', sans-serif; font-size:50%;" class="hidden-sm">
          		<img src="img/shipping_1.jpg" alt="" style="width:100px;"/>
          		<br/>SPEDIZIONE STANDARD GRATIS IN TUTTA ITALIA<br/>
				<span style="font-size:90%;">per ordini di importo superiore a 49 €</span></span>
				<br/><br/>
				<span style="line-height:1.6em; font-size:20px;">IL NEGOZIO DI SCACCHI A FIRENZE</span>
			
		  </div>


           <div class="col-md-6 col-md-offset-3" style="/*border-bottom:1px dotted #850728*/; padding-top:5px; margin-bottom:10px;"></div>
           <?php else:?>
           <div class="negozio scritta hidden-xs col-sm-12 col-md-12 text-center abril shipping_sm" >
          		<br><br>
				<span style="line-height:1.6em; font-size:20px;">THE CHESS STORE IN FLORENCE</span>
				<span style="font-size:16px"><br>FOR EXTRA UE SHIPPINGS THE ITALIAN VAT WILL BE AUTOMATICALLY DEDUCED DURING THE PURCHASE</span>
			
		   </div>
           <div class="col-md-6 col-md-offset-3" style="/*border-bottom:1px dotted #850728*/; padding-top:5px; margin-bottom:10px;"></div>
          <?php endif;?>
        </nav>

      </div>