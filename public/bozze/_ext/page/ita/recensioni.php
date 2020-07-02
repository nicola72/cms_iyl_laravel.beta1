<section class="lightSection clearfix pageHeader">
	<div class="container">
    	<div class="row">
            <div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">RECENSIONI</h2>
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
        		<?php $site->getFile('box_facebook',true)?>
            </div>
         	<div class="col-md-9 col-xs-12 col-sm-12">
         		<?php $recensioni = $site->getRecensioni();?>
         		<?php if(is_array($recensioni) && count($recensioni) > 0):?>
	         		<?php foreach($recensioni as $recensione):?>
	         		<div class="recensione-item">
	         			<div class="recensione-data"><?php echo $recensione['data_ins']?></div>
	         			<div class="recensione-nome"><?php echo $recensione['nome'] ?></div>
	         			<div class="recensione-messaggio"><?php echo utf8_encode($recensione['messaggio']) ?></div>
	         		</div>
	         		<?php endforeach;?>
	         	<?php else:?>
	         	<p></p>
	         	<?php endif;?>
         	</div>
         </div>
	</div>
</section>
<style>
.recensione-item{
	margin-bottom:30px;
}

.recensione-data{
	font-size:18px;
	padding-bottom:8px;
	font-style: italic;
	color:#000;
}

.recensione-nome{
	font-size:18px;
	padding-bottom:12px;
	font-weight:bold;
	color:#840025;
}

.recensione-messaggio{
	font-size:16px;
	color:#000;
}
.recensione-messaggio p{
	font-size:16px;
	color:#000;
}
</style>