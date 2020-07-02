<section class="lightSection clearfix pageHeader">
	<div class="container">
    	<div class="row">
            <div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">ACCOUNT</h2>
              	</div>
            </div>
        
    	</div>
	</div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-12 col-xs-12 sideBar ">
        		<?php $site->getFile('menu-prodotti')?>
            </div>
            
            <div class="col-md-9 col-xs-12 col-sm-12">
            	<?php $site->getFile('info-msg')?>
            	<div class="row">
            		<div class="col-md-8">
            			<?php if($site->isLogged()):?>
            			
            				<?php $site->getFormModificaAccount()?>
            			<?php else:?>
            			<?php echo _WARN_9?>
            			<?php endif;?>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</section>