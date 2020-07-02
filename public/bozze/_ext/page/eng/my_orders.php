<section class="lightSection clearfix pageHeader">
	<div class="container">
    	<div class="row">
            <div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">MY ORDERS</h2>
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
					
				</div>
			</div>
			
			<div class="col-md-9 col-sm-12 col-xs-12 sideBar ">
			
				<!-- se NON LOGGATO -->
				<?php if(!$site->isLogged()):?>
				<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">To take advantage of this functionality of the site you need to log</div>
				
				<!-- LOGGATO -->
				<?php else:?>
				
				<?php $ordini = $site->orderManager->getOrdini();?>
				<?php if(count($ordini) == 0):?>
				<div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">You have not made any orders to date </div>
				<?php else:?>
					<?php $count = 1;?>
					<?php foreach($ordini as $ordine):?>
					
					<?php list($a,$m,$g) = explode("-", $ordine['data']);?>
					<div class="order-item"><span class="order-title"><?php echo "Order ".$ordine['id']." of ".$g."/".$m."/".$a?></span>
						<span class="pull-right">
							<a class="btn-xs btn-default" href="javascript:void(0)" onclick="$('#dettagli_<?php echo $count?>').toggle();">details</a>
						</span>
					
						<div id="dettagli_<?php echo $count?>" class="order-dettagli" style="display:none;">
							<?php $dettagli = $site->orderManager->getDettagli($ordine['id'])?>
							<?php $totale_ordine = 0?>
							<table class="table" >
								<tr>
									<th style="width:40%;"><?php echo _PRODOTTO ?></th>
									<th style="width:20%;"><?php echo _QTA?></th>
									<th style="width:20%;"><?php echo _TOTALE?></th>
									<th style="width:20%;">&nbsp;</th>
								</tr>
								<?php foreach($dettagli as $dettaglio):?>
								<tr>
									<th><a href="<?php echo $this->getUrl('scheda_prodotto')?>.?id_prodotto=<?php $dettaglio['id_prodotto']?>"><?php echo $dettaglio['prodotto'] ?></a></th>
									<th><?php echo $dettaglio['qta'] ?></th>
									<th><?php echo Utils::formatPrice($dettaglio['importo_tot']) ?> &euro;</th>
									<th>&nbsp;</th>
								</tr>
								<?php $totale_ordine += $dettaglio['importo_tot'];?>
								<?php endforeach;?>
								<!-- RIASSUNTO TOTALI -->
								<?php 
									$spese_spedizione = $ordine['spese_spedizione'];
									$spese_conf = $ordine['spese_conf_regalo'];
									$spese_contrassegno = $ordine['spese_contrassegno'];
									$sconto = $ordine['sconto'];
									
									$gran_total = $totale_ordine + $spese_conf + $spese_contrassegno + $spese_spedizione - $sconto;
								?>
								<tr>
									<th></th>
									<th></th>
									<th><?php echo strtoupper( _TOTALE)?></th>
									<th><?php echo Utils::formatPrice($totale_ordine)?> &euro;</th>
								</tr>
								<tr>
									<th></th>
									<th></th>
									<th><?php echo strtoupper( _SPESE_SPEDIZIONE)?></th>
									<th><?php echo Utils::formatPrice($spese_spedizione)?> &euro;</th>
								</tr>
								<?php if($spese_conf != '0.00' && $spese_conf != ''):?>
								<tr>
									<th></th>
									<th></th>
									<th><?php echo strtoupper( _COSTO_CONF_REGALO)?></th>
									<th><?php echo Utils::formatPrice($spese_conf)?> &euro;</th>
								</tr>
								<?php endif;?>
								<?php if($spese_contrassegno != '0.00'):?>
								<tr>
									<th></th>
									<th></th>
									<th><?php echo strtoupper( _COSTO_CONTRASSEGNO)?></th>
									<th><?php echo Utils::formatPrice($spese_contrassegno)?> &euro;</th>
								</tr>
								<?php endif;?>
								<?php if($sconto != '0.00' && $sconto != ''):?>
								<tr>
									<th></th>
									<th></th>
									<th><?php echo strtoupper( _SCONTO)?></th>
									<th><?php echo Utils::formatPrice($sconto)?> &euro;</th>
								</tr>
								<?php endif;?>
								<!--  -->
								<tr>
									<th></th>
									<th></th>
									<th style="color:#840025;"><?php echo strtoupper( _TOTALE_FINALE)?></th>
									<th style="color:#840025;"><?php echo Utils::formatPrice($gran_total)?> &euro;</th>
								</tr>
							</table>
						</div>
					</div>
					<?php $count++?>
					<?php endforeach;?>
				<?php endif;?>
				
				<?php endif;?>
			</div>
		</div>
	</div>
</section>