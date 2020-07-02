<section class="lightSection clearfix pageHeader">
	<div class="container">
    	<div class="row">
            <div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">LOGIN</h2>
              	</div>
            </div>
        
    	</div>
	</div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-12 col-xs-12 sideBar hidden-xs hidden-sm">
        		<?php $site->getFile('menu-prodotti')?>
            </div>
            
            <div class="col-md-9 col-xs-12 col-sm-12">
            	<?php $site->getFile('info-msg')?>
            	<div class="row">
            		<div class="col-md-6">
            			<div class="page-header">
            				<h3  class="fjalla" style="color:#840025;">YOU ARE ALREADY REGISTERED</h3>
            			</div>
            			<?php $site->getFormLogin();?>
            			<br />
            			<p><a style="font-size:120%; font-weight:bold; color:#840025" href="<?php $site->getUrl('recupera_pwd')?>">Retrieve password</a></p>
            		</div>
            		<div class="col-md-6">
            			<div class="page-header">
            				<h3  class="fjalla" style="color:#840025;">CREATE AN ACCOUNT</h3>
            			</div>
            			<?php $site->getFormRegistrazione()?>
            		</div>
            		
            	</div>
            </div>
        </div>
    </div>
</section>