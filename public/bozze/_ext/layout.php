<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->


<?php if($this->lang == 'spa'):?>
<html lang="es">
<?php else:?>
<html lang="<?php echo $site->langDir ?>">
<?php endif;?>

	<?php $site->getHead();?>
	<body>
	
	<!-- Se Spagnolo allora faccio vedere pagina statica -->
	<?php if($site->lang == 'spa'):?>
	
		<?php $site->getFile('home_spagnolo',true)?>
		<?php $site->getScript();?>
		<?php $site->getFile('window',true)?>
		<?php $site->getCookiesText();?>
	
	<!-- Se Russo allora faccio vedere pagina statica -->
	<?php elseif($site->lang == 'rus'):?>
	
		<?php $site->getFile('home_russo',true)?>
		<?php $site->getScript();?>
		<?php $site->getFile('window',true)?>
		<?php $site->getCookiesText();?>

    <?php elseif($site->lang == 'deu'):?>

        <?php $site->getFile('home_tedesco',true)?>
        <?php $site->getScript();?>
        <?php $site->getFile('window',true)?>
        <?php $site->getCookiesText();?>
	<?php else:?>
	
		<?php $site->getFbScript()?>
			
			
	        <div class="main-wrapper">
        	<?php $site->getFile('header');?>
        	
        	
        	<?php if($this->page == 'policy'):?>
			<?php $site->getPolicy()?>
			<?php else:?>
			<?php $site->getPage(true)?>
			<?php endif;?>
			
			
			<?php $site->getH2()?>
			<?php $site->getFile('section',true)?>
			</div>
		
		
		<?php $site->getFile('footer',true)?>
		<?php $site->getFile('window',true)?>
		
		<?php $site->getScript();?>
		<?php $site->getCookiesText();?>
	<?php endif;?>
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e71df268d24fc2265884dfa/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
	</body>
</html>