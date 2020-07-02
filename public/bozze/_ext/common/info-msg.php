<div class="info-msg">
	<div class="loader-wrapper">
		<div class="loader">
			<img src="<?php echo self::_ROOT?>_ext/img/loading.gif">
		</div>
	</div>	
	
	<?php if(isset($_SESSION['msg'])):?>
	<?php echo $_SESSION['msg']?>
	<?php endif?>
</div>