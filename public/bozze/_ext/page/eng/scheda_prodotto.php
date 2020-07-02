<?php if($site->is_abbinamento):?>
	<?php $site->getFile('scheda_abbinamento', true)?>
<?php else:?>
	<?php $site->getFile('scheda_prodotto_singolo', true)?>
<?php endif;?>
