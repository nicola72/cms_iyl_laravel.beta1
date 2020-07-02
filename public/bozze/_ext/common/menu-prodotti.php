<div class="panel panel-default">
	<div class="panel-heading fjalla" style="font-weight: 100;"><a href="/<?=($this->lang=='ita'?'scacchi_in_ottone.php':'eng/production_brass.php')?>"><?php echo _TUTTI_PRODOTTI?></a></div>
	<div class="panel-body">
		<?php $macro = $site->productManager->getMacroCategorie()?>
		<div class="collapse navbar-collapse navbar-ex2-collapse navbar-side-collapse">
			<ul class="nav navbar-nav side-nav fjalla">
				<?php $count = 1?>
				<?php foreach($macro as $item):?>
					<?php $class_li = ($count > 5)? 'categoria_li_1':'categoria_li';?>
					
					<?php if($item['id'] == 22):?>
					<?php $categorie = $site->productManager->getCategorie($item['id'])?>
						<?php foreach($categorie as $itemCat):?>
						<li class="categoria_li">
							<?php if($this->lang == 'ita'):?>
							<a class="categoria" href="<?php echo $item['url_it']?>?categoria=<?php echo $item['id']?>&sottocategoria=<?php echo $itemCat['id']?>">
								<?php echo $itemCat['nome_it']?>
							</a>
							<?php else:?>
							<a class="categoria" href="<?php echo $item['url_en']?>?categoria=<?php echo $item['id']?>&sottocategoria=<?php echo $itemCat['id']?>">
								<?php echo $itemCat['nome_en']?>
							</a>
							<?php endif;?>
						</li>
						<?php endforeach;?>
					<?php else:?>
					<li class="<?php echo $class_li?>" >
						<a href="<?php echo $item['url_'.($this->lang=='ita'?'it':'en')]?>?categoria=<?php echo $item['id']?>"	data-toggle="collapse" data-target="#sez_<?php echo $count?>" class="categoria" <?php if($count == 6){ /*echo 'style="margin-bottom:25px"';*/}?>>
							<?php echo $item["nome_$this->langDir"]?><i class="fa fa-plus"></i>
						</a>
						<?php $classCollapse = (!empty($_GET['categoria']) && $item['id'] == $_GET['categoria']) ? '':'collapse'?>
						<?php $categorie = $site->productManager->getCategorie($item['id'])?>
						<ul id="sez_<?php echo $count?>" class="<?php echo $classCollapse?> collapseItem">
							<?php foreach($categorie as $itemCat):?>
								<?php if($this->lang == 'ita'):?>
								<li>
									<a href="<?php echo $item['url_it']?>?categoria=<?php echo $item['id']?>&sottocategoria=<?php echo $itemCat['id']?>">
										<i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $itemCat['nome_it']?>
									</a>
								</li>
								<?php else:?>
								<li>
									<a href="<?php echo $item['url_en']?>?categoria=<?php echo $item['id']?>&sottocategoria=<?php echo $itemCat['id']?>">
										<i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $itemCat['nome_en']?>
									</a>
								</li>
								<?php endif;?>
							<?php endforeach?>
						</ul>
					</li>
					<?php endif;?>
					
					<?php $count++;?>
				<?php endforeach;?>
			</ul>					
			
		</div>
	</div>
</div>