<?php 
$pages = array('home','agriturismo','appartamenti','prodotti','galleria','sagre_eventi','dove_siamo','contatti');
?>
<ul class="nav navbar-nav">
<?php foreach ($pages as $page):?>
<?php $class = ($page == $this->page)? 'active':'';?>
	<?php if($page == 'appartamenti'):?>
	<li class="dropdown menu-large ">
		<a href="javascript:void(0)"><?php $site->getLabel($page)?></a>
		<ul class="dropdown-menu megamenu row">
			<li>
				<ul>
					<li><a href="<?php $site->getUrl($page)?>?t=fattoria" style="font-size: 12px;"><img src="<?php echo self::_ROOT?>_ext/img/fattoria.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
					La Fattoria</a></li>
				</ul>
			</li>
			<li>
				<ul>
					<li><a href="<?php $site->getUrl($page)?>?t=podere" style="font-size: 12px;"><img src="<?php echo self::_ROOT?>_ext/img/borghetto.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
					Podere Il Masso</a></li>
				</ul>
			</li>
			<li>
				<ul>
					<li><a href="<?php $site->getUrl($page)?>?t=borghetto" style="font-size: 12px;"><img src="<?php echo self::_ROOT?>_ext/img/girasoli.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
					Borghetto</a></li>
				</ul>
			</li>
			<li>
				<ul>
					<li><a href="<?php $site->getUrl('prezzi')?>" style="font-size: 12px;"><img src="<?php echo self::_ROOT?>_ext/img/book.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
					<?php $site->getLabel('prezzi')?></a></li>
				</ul>
			</li>
			<li>
				<ul>
					<li><a href="<?php $site->getUrl('last_minute')?>" style="font-size: 12px;"><img src="<?php echo self::_ROOT?>_ext/img/last.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
					Last Minute</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<?php elseif($page == 'prodotti'):?>
	<li class="dropdown  menu-large">
		<a href="javascript:void(0)"><?php $site->getLabel($page)?></a>
		<ul class="dropdown-menu megamenu row" style="padding-left: 15px; padding-right: 15px;">
			<li class="col-md-4">
				<ul>
					<li>
					<a href="<?php $site->getUrl($page)?>?id=1"	style="font-size: 13px;"><img src="<?php echo self::_ROOT?>_ext/img/vino_1.jpg" alt="<?php $site->getAlt();?>" class="img-responsive hidden-xs hidden-sm" /> 
						<?php echo _VINO?></a>
					</li>
				</ul>
			</li>
			<li class="col-md-4">
				<ul>
					<li>
						<a href="<?php $site->getUrl($page)?>?id=2" style="font-size: 13px;"><img src="<?php echo self::_ROOT?>_ext/img/olio.jpg" alt="<?php $site->getAlt();?>"	class="img-responsive hidden-xs hidden-sm" />
						<?php echo _OLIO?></a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
	<?php else:?>
	<li class="<?php echo $class?>"><a href="<?php $site->getUrl($page)?>"><?php $site->getLabel($page)?></a></li>	
	<?php endif;?>						
<?php endforeach;?>
</ul>
