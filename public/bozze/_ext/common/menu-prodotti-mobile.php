<div class="panel panel-default">
	<div class="panel-heading fjalla" style="font-weight: 100;text-transform: uppercase;"><?php echo _PRODOTTI?></div>
	<div class="panel-body">
		<?php $macro = $site->productManager->getMacroCategorie()?>
		<div class="collapse navbar-collapse navbar-ex2-collapse navbar-side-collapse">
			<ul class="nav navbar-nav side-nav fjalla">
				<?php $count = 1?>
				<?php foreach($macro as $item):?>
					<li class="categoria_li">
						<a href="javascript:void(0);"	data-toggle="collapse" data-target="#m_sez_<?php echo $count?>" class="categoria">
							<?php echo $item["nome_$this->langDir"]?><i class="fa fa-plus"></i>
						</a>
						<?php $categorie = $site->productManager->getCategorie($item['id'])?>
						<ul id="m_sez_<?php echo $count?>" class="collapse collapseItem">
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
					<?php $count++;?>
				<?php endforeach;?>
			</ul>					
			
		</div>
	</div>
</div>