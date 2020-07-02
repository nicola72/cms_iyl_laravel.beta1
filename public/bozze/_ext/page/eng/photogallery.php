<section data-background="/_ext/img/agriturismo_piscina_siena_1.jpg"
	style="background-position: center bottom;"
	class="module-hero color-white parallax  bg-black-alfa-10">
	<div class="hero-caption">
		<div class="hero-text">
			<div class="container" style="min-height: 300px;">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h8 class="m-0 pacifico">Photo Gallery</h8>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
$images = $site->getGalleryImages();
?>
<section>
	<div class="row-gallery">
		<div class="gallery">
				
				<?php if(count($images) > 0):?>
					<?php foreach($images as $img):?>
					
					<?php $file = $this->estensionefile($img['file']);?>
					<div class="gallery-item rigatone brunch">
						<div data-background="<?php echo "/file/tb_fotogallery_".$img['id_elem']."/".$file[0]."_thumbs_800".$file[1] ?>" class="gallery-wrapper">
							<a href="<?php echo "/file/tb_fotogallery_".$img['id_elem']."/".$file[0]."_thumbs_800".$file[1] ?>" title="<?php echo $img['didascalia_eng']?>"
								class="gallery-link"></a>
							<div class="gallery-overlay">
								<div class="gallery-caption">
									<h6 class="gallery-title"><?php echo $img['didascalia_eng']?></h6>
								</div>
							</div>
						</div>
					</div>				
					
					<?php endforeach;?>
					
				<?php endif;?>
				<br />
				<br />	
				
		</div>
	</div>
</section>
<!-- END HERO-->
<!-- ABOUT-->