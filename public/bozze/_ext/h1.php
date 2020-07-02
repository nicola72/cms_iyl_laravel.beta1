<?php if($this->page == 'categoria'):?>
	<?php if($this->lang == 'ita'):?>
		<?php $categoria = $this->categoria ? $this->categoria['nome_it'] : $this->macroCategoria['nome_it']?>
		<h1 class="h1 hidden-xs"><?php echo sprintf("%s online Vendita %s online Produzione Vendita %s Firenze Toscana", $categoria, $categoria, $categoria)?></h1>
	<?php else:?>
		<?php $categoria = $this->categoria ? $this->categoria['nome_en'] : $this->macroCategoria['nome_en']?>
		<h1 class="h1 hidden-xs"><?php echo sprintf("Production %s Italy Selling online %s Italy", $categoria, $categoria, $categoria)?></h1>
	<?php endif;?>
	
<?php elseif($this->page == 'scheda_prodotto'):?>
	<?php if($this->is_abbinamento):?>
		<?php $prodotto = ($this->lang == 'ita')? $this->prodotto['titolo'] : $prodotto['titolo_en']?>
	<?php else:?>
		<?php $prodotto = ($this->lang == 'ita')? $this->prodotto['nome_it'] : $prodotto['nome_en']?>
	<?php endif;?>
	<h1 class="h1 hidden-xs"><?php echo utf8_encode(sprintf($this->seo[$this->page][$this->lang]['title'], $prodotto,$prodotto,$prodotto))?></h1>
<?php else:?>
	<h1 class="h1 hidden-xs"><?php echo $this->seo[$this->page][$this->lang]['title']?></h1>
<?php endif;?>

