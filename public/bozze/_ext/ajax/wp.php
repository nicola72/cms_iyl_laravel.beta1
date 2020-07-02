<?php
get_header();
?>
<?php include 'includes/variables.php';
?>
<div id="content">
	<div class="container"> 
		<div class="row">
		<!-- begin:article -->
			<div class="col-md-9 col-md-push-3">
				<div class="row" style="">
					<div class="col-md-12 single-post">
						<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php 
					if($localita!=""){?>
					<h2 style="font-size: 9px; color: grey;">
						<?php 
						echo "Immobili a ".$localita; ?>
					</h2>
					<?php } ?>
					
							<li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-university"></i> Dettaglio</a></li>
							<li><a href="#contattiancor"><i class="fa fa-paper-plane-o"></i> Contattaci</a></li>
							<!--<li id="indietro_single"><a onclick="goBack()"><i class="fa fa-arrow-left"></i> Indietro</a></li>-->
						</ul>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<script type="text/javascript">
 $(document).ready(function () {

	$("input[name='your-subject']").val('<?php echo $riferimento;  ?>');
	//$("input[name='your-subject']").attr("readonly", true); 
	
	});
</script>	
<div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade in active" id="detail">
<div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">

<p class="hide">&nbsp;</p>
<!--<div align="left"><h5><a href="<?php echo $_SESSION['back']; ?>"><strong>&lt;&lt; INDIETRO</strong></a></h5></div>--> 
<h2><?php echo $riferimento; ?> - <?php echo $localita ?></h2> 
<h3>Per informazioni chiama il numero <?php echo $telefono_agenzia; ?></h3>
<!--<a href="<?php echo $_SESSION['back']; ?>" style="font-weight:bold; font-size:15px;"><strong>&lt;&lt; INDIETRO</strong></a><br /><br />-->

	<?php 
	$sliderimages = get_post_meta($post->ID, 'images_value', true); 
	if ($sliderimages) {
		$arr_sliderimages = explode("\n", $sliderimages);
	} else {
		$arr_sliderimages = get_gallery_images();
	}
	?>	
		
	<!-- loop through images -->	
	<div id="slider-property"  class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                          <?php
			$count = 1;
			foreach ($arr_sliderimages as $image) {
				$image = $arr_sliderimages[$count - 1];
				$image = parse_url($image);
				$image = $image[path];
			
				if($count == 1) {
					$active = "active";
				}else{
					$active = "";
				}				
				if($count != 1) {
					$hide = "style='display: none;'";
				}
				
				// Modifica Stefan
				//$resized = timthumb(300, 436, $image, 1);
				$resized = $image;
			?>
				<li data-target="#slider-property" data-slide-to="<?php echo $count-1; ?>" class="<?php echo $active; ?>">
				  
				  <!--<li data-target="#slider-property" data-slide-to="1" class="<?php echo $active; ?>">-->
                              <img width="436" height="300" alt="Image for <?php echo $address; ?>" title="<?php echo $resized ?>" src="<?php echo $resized ?>" />
                            </li>
		<?php 
		$count = $count + 1;
		} ?>
                          </ol>
                          <div class="carousel-inner">
                          <?php
			$count = 1;
			foreach ($arr_sliderimages as $image) {
				$image = $arr_sliderimages[$count - 1];
				$image = parse_url($image);
				$image = $image[path];
			
				if($count != 1) {
					$hide = "style='display: none;'";
				}
				
				if($count == 1) {
					$active = "active";
				}else{
					$active = "";
				}
				
				
				//$resized = timthumb(300, 436, $image, 1);
				$resized = $image;
			?>
                             <div class="item <?php echo $active; ?>">
                             <img style="max-height:470px; width:auto; margin:0 auto; display:block;" alt="Image for <?php echo $address; ?>" src="<?php echo $resized ?>" />
                            </div>

		<?php 
		$count = $count + 1;
		} ?>
                          </div>
                         <a class="left carousel-control" href="#slider-property" role="button" data-slide="prev">
        <span style="line-height:45px; font-weigh:bold;">&lt;</span>
      </a>
      <a class="right carousel-control" href="#slider-property" role="button" data-slide="next">
        <span style="line-height:45px; font-weigh:bold;">&gt;</span>
      </a>
                        </div>
            <?php /*            
	<div id="sliderimage">
	
	
		<?php if(count($arr_sliderimages) > 1) { ?>
			<div class="imagehover"></div>
		<?php } ?>
        
		<?php if(count($arr_sliderimages) < 1) { ?>
        <div class="image" <?php echo $hide; ?>>
                <a rel="prettyPhoto[pp_gal]" href="http://www.tuccimmobiliare.it/wp/wp-content/uploads/2012/05/sfondo-vuoto.jpg">
                <img width="436" height="300" alt="Image for <?php echo $address; ?>" src="http://www.tuccimmobiliare.it/wp/wp-content/uploads/2012/05/sfondo-vuoto.jpg" />
                </a>
                <div class="shadow-large"></div>
            </div>
         <?php } ?>
		
		
		<?php if ($banner == "Ribassato") { ?>
		<div class="banner-large reduced"></div>
		<?php } ?>

		<?php if ($banner == "Venduto") { ?>
		<div class="banner-large sold"></div>
		<?php } ?>
		
		<?php if ($banner == "Affittato") { ?>
		<div class="banner-large affittato"></div>
		<?php } ?>
		

	
		<?php
			$count = 1;
			foreach ($arr_sliderimages as $image) {
				$image = $arr_sliderimages[$count - 1];
				$image = parse_url($image);
				$image = $image[path];
			
				if($count != 1) {
					$hide = "style='display: none;'";
				}
				
				
				$resized = timthumb(300, 436, $image, 1);
				
			?>
			<div class="image" <?php echo $hide; ?>>
				<a rel="prettyPhoto[pp_gal]" href="<?php echo $image ?>">
				<img width="436" height="300" alt="Image for <?php echo $address; ?>" src="<?php echo $resized ?>" />
				</a>
				<div class="shadow-large"></div>
				<br/>
				<br/>
				<br/>
			</div>

		<?php 
		$count = $count + 1;
		} ?>
	</div><!-- end sliderimage -->
	
	*/?>
	
	
<!-- Videos section.  Will only show up if there are entries in the Video section of a post  -->

<?php

$videoimages = explode("\n", get_post_meta($post->ID, 'video_thumbnail_value', true));
$videourl = explode("\n", get_post_meta($post->ID, 'video_url_value', true));

$count1 = count($videoimages);
$count2 = count($videourl);
?>

<?php 

if ($count1 >= 1 && get_post_meta($post->ID, 'video_thumbnail_value', true) != "" && $count1 == $count2) { ?>
<div id="videos">
<h3><?php echo get_option('wp_heading_videos');  ?></h3>
<?php for ($i=0; $i<count($videoimages); $i++)
	{ 
	?>
		<a href="<?php echo $videourl[$i]; ?>" rel="prettyPhoto" title="Video per <?php echo $riferimento; ?>">
		<img alt="Video for <?php echo $address; ?>" width="62" height="62" src="<?php echo bloginfo('template_directory');?>/scripts/timthumb.php?src=<?php echo $videoimages[$i]; ?>&amp;w=62&amp;h=62&amp;zc=1&amp;q=<?php echo get_option('wp_imagequality') ?>" />
		</a>
	<?php } ?>

</div><!-- end videos -->
<div class="clear"></div>
<?php
}
?>


<h3>Dettagli</h3>
<?php include 'includes/features.php'; ?>

<h3>Descrizione</h3>
<?php the_content(); ?>
<br /><br />
<!--<a id="indietro_single" onclick="goBack()" style="font-weight:bold; font-size:15px;"><strong>&lt;&lt; INDIETRO</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><a href="http://www.printfriendly.com/print/v2?url=<?php the_permalink(); ?>" rel="nofollow" target="blank" style="font-weight:bold; font-size:15px;"><i class="fa fa-print"></i> Stampa la pagina</a>
<br /><br />
<?php if($otherinfo) { ?>
	<p>Altre Informazioni: <?php echo $otherinfo ?></p>
<?php } ?>


<?php

	
	if (get_the_term_list($post->ID, 'property_features')) {
		echo "<div id='threecolumnfeatures'>";
		echo "<h3>" . get_option('wp_features') . "</h3>";
		echo get_the_term_list($post->ID, 'property_features');
		echo "</div>";
	}
	
	if (get_option('wp_demo') == "on") {
		echo "<p style='margin-top: 10px; font-size: .9em; clear: left; margin-bottom: 0;'>Note: this features section is created automatically. When you make a Listing, you simply check off all the features from a long list of feature checkboxes that YOU define ahead of time.</p>";
	}
	
?>

<?php edit_post_link('Edit this page', '<strong>', '</strong>');  ?>

<!--<div class="listingnavigation">
<div class="prevlisting"><'?php previous_post('<< Rif. %', '', 'yes'); ?></div>
<div class="nextlisting"><'?php next_post('Rif. % >> ', '', 'yes'); ?></div>
</div>-->



<?php if(get_option('wp_showsociallinks2') == "show") {
	include 'includes/sociallinks.php';
	}
?>


	<div class="page-break"></div>
	<?php /*$mapaddress = get_post_meta($post->ID, "google_location_value", $single = true) ?>
	<?php if ($mapaddress) { ?>
		<div id="listinglocation">
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
			<?php include 'includes/googlemaps.php'; ?>
			<?php if(get_option('wp_show_sv') == 'hide' || $streetview == 'No') {
					$hidestreetview = "style='display:none;'";
					$class = "mapnostreetview";
			} ?>
			<div id="locationmap">
				<div class="<?php echo $class ?>" id="map"></div>
			</div>
			<div <?php echo $hidestreetview ?> id="locationstreetview">
			<div id="streetview"></div>
			</div>
	</div><!-- end map -->
<? } */?>

<?php include 'includes/related.php'; ?>
<?php if (get_option('wp_showcontactform') == "show") { ?>

	<div id="listingcontact" class="singlearticlelistingcontact">

	<?php
		global $wpdb;
		$sql = " SELECT *
		FROM $wpdb->posts AS p
		WHERE p.post_type = 'agent' 
		AND p.post_title = '". $theagent ."'";
		$agentarray = $wpdb->get_results($sql);
	?>


	<?php if ($agentarray) { ?>
	<?php foreach ($agentarray as $post) { ?>
		<?php setup_postdata($post); ?>
		<?php include 'includes/variables.php' ?>
		
			<h3 class="agent"><?php echo get_option('wp_agentcontactustext')  ?></h3>
			<div id="agentbox">
				<?php
				$arr_sliderimages = get_gallery_images();
				if ($arr_sliderimages) { ?>
					<?php $resized = timthumb(100, 80, $arr_sliderimages[0], 1); ?>
					<img class="alignleft" width="80" height="100" alt="" src="<?php echo $resized ?>" />
				<?php } ?>
				
				<p><strong><?php the_title() ?></strong><br />
				
				<?php if ($agenttitle) { ?>
					<?php echo $agenttitle ?><br />
				<?php } ?>
				
				<?php if($agentphoneoffice) { ?>
					<?php echo "Office: " . $agentphoneoffice ?><br />
				<?php } ?>
				
				<?php if($agentphonemobile) { ?>
					<?php echo "Mobile: " . $agentphonemobile ?><br />
				<?php } ?>
				
				<?php if($agentfax) { ?>
					<?php echo "Fax: " . $agentfax ?><br />
				<?php } ?>
				
				<a href="<?php the_permalink() ?>">Other listings</a>
				
			</p>
			</div>
			
			<?php echo do_shortcode($agentcontactform);  ?>
	<?php } ?>
	
	
	<?php } else { ?>

			<!--<h3 id="contact"><?php echo get_option('wp_contactustext'); ?></h3>
			<p><?php echo stripslashes(get_option('wp_contactussubtext')); ?></p>-->
			
			<div name="contattiancor"  id="contattiancor" class="col-md-12" style="border-top:1px dotted #ccc;">
			<br /><br /><br />
                        <h3>Contattaci per una consulenza gratuita</h3>
                          <h4>Chiamaci allo 0573 401878 o al 347 6916639,  oppure compila il form sottostante</h4>
                      </div>

			<?php echo do_shortcode(stripslashes(get_option('wp_contactshortcode')));  ?>

	<?php } ?>
	
	</br>
    <!--<div align="left"><h5><a href="<?php echo $_SESSION['back']; ?>"><strong>&lt;&lt; INDIETRO</strong></a></h5></div>-->
	
	</div><!-- end listing contact -->


<?php } ?>

	

	
	
<div><a class='top' href='#top'><?php echo get_option('wp_top');  ?></a></div>
	
</div></div></div><!-- end post -->




<?php endwhile; else: ?>
	  <p><strong>The page cannot be found. Please try somewhere else.</strong></p>
	  
<?php endif; ?>
		
		
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
					</div>
                    		</div>
                    			<?php 
					if($localita!=""){?>
					<h1 style="font-size: 9px; color: grey;">
						<?php 
						echo "Immobili a ".$localita; ?>
					</h1>
					<?php } ?>
		<!-- break -->        
	          </div>
	          <!-- end:article -->
		<!-- begin:sidebar -->
		<div class="col-md-3 col-md-pull-9 sidebar">
			<div class="widget widget-white">
				<?php get_sidebar(); ?>
			</div>
		<!-- break -->
		</div>
		<!-- end:sidebar -->
        </div>
</div>
<?php get_footer(); ?>

<? /*
<div id="columnswrapper" class="columns-1">

<?php include 'includes/variables.php' ?>

<?php get_sidebar(); ?>

<div id="content" class="norightsidebar">
<div class="inner">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<script type="text/javascript">
 $(document).ready(function () {

	$("input[name='your-subject']").val('<?php echo $riferimento;  ?>');
	//$("input[name='your-subject']").attr("readonly", true); 
	
	});
</script>	

<div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">

<p class="hide">&nbsp;</p>
<div align="left"><h5><a href="<?php echo $_SESSION['back']; ?>"><strong>&lt;&lt; INDIETRO</strong></a></h5></div>
<h2><?php echo $riferimento; ?> - <?php echo $localita ?></h2> 
<h3>Per informazioni chiama il numero <?php echo $telefono_agenzia; ?></h3>

	<?php 
	$sliderimages = get_post_meta($post->ID, 'images_value', true); 
	if ($sliderimages) {
		$arr_sliderimages = explode("\n", $sliderimages);
	} else {
		$arr_sliderimages = get_gallery_images();
	}
	?>	
		
	<!-- loop through images -->	
	<div id="sliderimage">
	
	
		<?php if(count($arr_sliderimages) > 1) { ?>
			<div class="imagehover"></div>
		<?php } ?>
        
		<?php if(count($arr_sliderimages) < 1) { ?>
        	<div class="image" <?php echo $hide; ?>>
                <a rel="prettyPhoto[pp_gal]" href="http://www.tuccimmobiliare.it/wp/wp-content/uploads/2012/05/sfondo-vuoto.jpg">
                <img width="436" height="300" alt="Image for <?php echo $address; ?>" src="http://www.tuccimmobiliare.it/wp/wp-content/uploads/2012/05/sfondo-vuoto.jpg" />
                </a>
                <div class="shadow-large"></div>
            </div>
         <?php } ?>
		
		
		<?php if ($banner == "Ribassato") { ?>
		<div class="banner-large reduced"></div>
		<?php } ?>

		<?php if ($banner == "Venduto") { ?>
		<div class="banner-large sold"></div>
		<?php } ?>
		
		<?php if ($banner == "Affittato") { ?>
		<div class="banner-large affittato"></div>
		<?php } ?>
		

	
		<?php
			$count = 1;
			foreach ($arr_sliderimages as $image) {
				$image = $arr_sliderimages[$count - 1];
				$image = parse_url($image);
				$image = $image[path];
			
				if($count != 1) {
					$hide = "style='display: none;'";
				}
				
				
				$resized = timthumb(300, 436, $image, 1);
				
			?>
			<div class="image" <?php echo $hide; ?>>
				<a rel="prettyPhoto[pp_gal]" href="<?php echo $image ?>">
				<img width="436" height="300" alt="Image for <?php echo $address; ?>" src="<?php echo $resized ?>" />
				</a>
				<div class="shadow-large"></div>
				<br/>
				<br/>
				<br/>
			</div>

		<?php 
		$count = $count + 1;
		} ?>
	</div><!-- end sliderimage -->
	
	<div align="left"><h5><a href="<?php echo $_SESSION['back']; ?>"><strong>&lt;&lt; INDIETRO</strong></a></h5></div>
	</br>
	
	
<!-- Videos section.  Will only show up if there are entries in the Video section of a post  -->

<?php

$videoimages = explode("\n", get_post_meta($post->ID, 'video_thumbnail_value', true));
$videourl = explode("\n", get_post_meta($post->ID, 'video_url_value', true));

$count1 = count($videoimages);
$count2 = count($videourl);
?>

<?php 

if ($count1 >= 1 && get_post_meta($post->ID, 'video_thumbnail_value', true) != "" && $count1 == $count2) { ?>
<div id="videos">
<h3><?php echo get_option('wp_heading_videos');  ?></h3>
<?php for ($i=0; $i<count($videoimages); $i++)
	{ 
	?>
		<a href="<?php echo $videourl[$i]; ?>" rel="prettyPhoto" title="Video per <?php echo $riferimento; ?>">
		<img alt="Video for <?php echo $address; ?>" width="62" height="62" src="<?php echo bloginfo('template_directory');?>/scripts/timthumb.php?src=<?php echo $videoimages[$i]; ?>&amp;w=62&amp;h=62&amp;zc=1&amp;q=<?php echo get_option('wp_imagequality') ?>" />
		</a>
	<?php } ?>

</div><!-- end videos -->
<div class="clear"></div>
<?php
}
?>



<?php include 'includes/features.php'; ?>



<?php the_content(); ?>


<?php if($otherinfo) { ?>
	<p>Altre Informazioni: <?php echo $otherinfo ?></p>
<?php } ?>


<?php

	
	if (get_the_term_list($post->ID, 'property_features')) {
		echo "<div id='threecolumnfeatures'>";
		echo "<h3>" . get_option('wp_features') . "</h3>";
		echo get_the_term_list($post->ID, 'property_features');
		echo "</div>";
	}
	
	if (get_option('wp_demo') == "on") {
		echo "<p style='margin-top: 10px; font-size: .9em; clear: left; margin-bottom: 0;'>Note: this features section is created automatically. When you make a Listing, you simply check off all the features from a long list of feature checkboxes that YOU define ahead of time.</p>";
	}
	
?>

<?php edit_post_link('Edit this page', '<strong>', '</strong>');  ?>

<!--<div class="listingnavigation">
<div class="prevlisting"><'?php previous_post('<< Rif. %', '', 'yes'); ?></div>
<div class="nextlisting"><'?php next_post('Rif. % >> ', '', 'yes'); ?></div>
</div>-->



<?php if(get_option('wp_showsociallinks2') == "show") {
	include 'includes/sociallinks.php';
	}
?>


	<div class="page-break"></div>
	<?php $mapaddress = get_post_meta($post->ID, "google_location_value", $single = true) ?>
	<?php if ($mapaddress) { ?>
		<div id="listinglocation">
		<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
			<?php include 'includes/googlemaps.php'; ?>
			<?php if(get_option('wp_show_sv') == 'hide' || $streetview == 'No') {
					$hidestreetview = "style='display:none;'";
					$class = "mapnostreetview";
			} ?>
			<div id="locationmap">
				<div class="<?php echo $class ?>" id="map"></div>
			</div>
			<div <?php echo $hidestreetview ?> id="locationstreetview">
			<div id="streetview"></div>
			</div>
	</div><!-- end map -->
<? } ?>

<?php include 'includes/related.php'; ?>

<?php if (get_option('wp_showcontactform') == "show") { ?>

	<div id="listingcontact">

	<?php
		global $wpdb;
		$sql = " SELECT *
		FROM $wpdb->posts AS p
		WHERE p.post_type = 'agent' 
		AND p.post_title = '". $theagent ."'";
		$agentarray = $wpdb->get_results($sql);
	?>


	<?php if ($agentarray) { ?>
	<?php foreach ($agentarray as $post) { ?>
		<?php setup_postdata($post); ?>
		<?php include 'includes/variables.php' ?>
		
			<h3 class="agent"><?php echo get_option('wp_agentcontactustext')  ?></h3>
			<div id="agentbox">
				<?php
				$arr_sliderimages = get_gallery_images();
				if ($arr_sliderimages) { ?>
					<?php $resized = timthumb(100, 80, $arr_sliderimages[0], 1); ?>
					<img class="alignleft" width="80" height="100" alt="" src="<?php echo $resized ?>" />
				<?php } ?>
				
				<p><strong><?php the_title() ?></strong><br />
				
				<?php if ($agenttitle) { ?>
					<?php echo $agenttitle ?><br />
				<?php } ?>
				
				<?php if($agentphoneoffice) { ?>
					<?php echo "Office: " . $agentphoneoffice ?><br />
				<?php } ?>
				
				<?php if($agentphonemobile) { ?>
					<?php echo "Mobile: " . $agentphonemobile ?><br />
				<?php } ?>
				
				<?php if($agentfax) { ?>
					<?php echo "Fax: " . $agentfax ?><br />
				<?php } ?>
				
				<a href="<?php the_permalink() ?>">Other listings</a>
				
			</p>
			</div>
			
			<?php echo do_shortcode($agentcontactform);  ?>
	<?php } ?>
	
	
	<?php } else { ?>

			<h3 id="contact"><?php echo get_option('wp_contactustext'); ?></h3>
			<p><?php echo stripslashes(get_option('wp_contactussubtext')); ?></p>
			<?php echo do_shortcode(stripslashes(get_option('wp_contactshortcode')));  ?>

	<?php } ?>
	
	</br>
    <div align="left"><h5><a href="<?php echo $_SESSION['back']; ?>"><strong>&lt;&lt; INDIETRO</strong></a></h5></div>
	
	</div><!-- end listing contact -->


<?php } ?>

	

	
	
<div><a class='top' href='#top'><?php echo get_option('wp_top');  ?></a></div>
	
</div><!-- end post -->




<?php endwhile; else: ?>
	  <p><strong>The page cannot be found. Please try somewhere else.</strong></p>
	  
<?php endif; ?>

<!--<div class="listingnavigationcontainer"></div>-->




</div><!-- end inner -->
</div><!-- end content -->



</div><!-- end columnswrapper -->

<?php get_footer(); */ ?>




