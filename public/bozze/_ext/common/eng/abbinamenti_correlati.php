<?php 
$id_prodotto1 = $this->prodotto['id_prodotto1'];
$id_prodotto2 = $this->prodotto['id_prodotto2'];
	
$id_abbinamento = $this->prodotto['id'];

$abbinamenti_correlati = $site->productManager->getAbbinamentiCorrelati($id_prodotto1, $id_prodotto2, $id_abbinamento);

?>
<?php if(count($abbinamenti_correlati) > 0):?>
	<div class="page-header" style="padding-top: 50px;">
		<h4>
			<span style="font-size: 130%; font-family: 'Fjalla One', sans-serif; color: #840025">Suggested combination</span>
		</h4>
	</div>
	<?php foreach($abbinamenti_correlati as $abbinamento):?>
	<?php 
		$alt_id_prd_1 = $abbinamento['id_prodotto1'];
		$alt_id_prd_2 = $abbinamento['id_prodotto2'];
			
		$alt_prd_1 = $site->productManager->getProdotto($alt_id_prd_1);
		$alt_prd_2 = $site->productManager->getProdotto($alt_id_prd_2);
					
		$img_abbinamento = ($abbinamento['img'] !="") ? "/file/".$abbinamento['img'] : "/_ext/img/default.jpg";
		$img_abbinamento = $site->addWatermarks($img_abbinamento);
		
		$prezzo_comp = $alt_prd_1['prezzo'] + $alt_prd_2['prezzo'];
						
		$descrizione = ($abbinamento['descrizione_en']!="") ? $abbinamento['descrizione_en'] : substr($abbinamento['descrizione_en'], 0, 130)."&hellip;";
	?>
	<div class="col-md-4 col-sm-6 col-xs-12" style="background-color: #fff;">
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
	        <div class="fjalla prezzo" ><?php echo Utils::formatPrice($prezzo_comp)."&nbsp;&euro;";?></div>
			<div class="prodDescrizione"><strong><?php echo $descrizione ?></strong></div>
				
				<i>Codice prodotto: <?php echo $alt_prd_1['codice'];?> + <?php echo $alt_prd_2['codice'];?></i>
				<a href="/eng/details.php?id_abbinamento=<?php echo $abbinamento['id'];?>" class="dettagli" ><i class="fa fa-search"></i> Product details</a>
	       	</div>
      	</div>
    </div>
	<?php endforeach;?>
<?php endif;?>

