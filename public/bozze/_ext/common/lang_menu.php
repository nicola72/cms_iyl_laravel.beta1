<?php 
$urlpage = $this->page;
if($this->page == 'appartamenti' || $this->page == 'prodotti')
{
	$urlpage = 'home';
}
?>
<?php if($this->lang == 'ita'):?>
	<a href="<?php $site->getUrl($urlpage,'eng')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_eng.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'deu')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_deu.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'fra')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_fra.jpg" alt="<?php $site->getAlt();?>" /></a>
<?php elseif($this->lang == 'eng'):?>
	<a href="<?php $site->getUrl($urlpage,'ita')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_ita.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'deu')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_deu.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'fra')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_fra.jpg" alt="<?php $site->getAlt();?>" /></a>
<?php elseif($this->lang == 'deu'):?>
	<a href="<?php $site->getUrl($urlpage,'eng')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_eng.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'ita')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_ita.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'fra')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_fra.jpg" alt="<?php $site->getAlt();?>" /></a>
<?php else:?>
	<a href="<?php $site->getUrl($urlpage,'eng')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_eng.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'deu')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_deu.jpg" alt="<?php $site->getAlt();?>" /></a> | 
	<a href="<?php $site->getUrl($urlpage,'ita')?>"><img src="<?php echo self::_ROOT?>_ext/img/flag_ita.jpg" alt="<?php $site->getAlt();?>" /></a>
<?php endif;?>
	
