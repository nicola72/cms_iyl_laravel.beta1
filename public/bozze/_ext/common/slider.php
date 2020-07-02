<!-- BANNER -->
      <div class="bannercontainer">
        <div class="fullscreenbanner-container">
          <div class="fullscreenbanner">
            <ul>
            	<?php $slider_images = $site->getSliderImages();?>
            	<?php if(count($slider_images) > 0):?>
            		<?php foreach($slider_images as $image):?>
           			
           			
           			<?php $img = str_replace("https://www.chess-store.it", "../..", $image['file']);?>
           			
           			<?php $img = '/_ext/include/watermark.php?f='.$img.'&amp;r=180&amp;b=100'?>
            		<li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1" >
          				<img src="<?php echo $img?>" alt="<?php $site->getAlt()?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
	               		<div class="slider-caption container captionCenter">
		                  	<div class="tp-caption rs-caption-1 sft start captionCenterAlign"
			                    data-x="center"
			                    data-y="0"
			                    data-speed="800"
			                    data-start="1500"
			                    data-easing="Back.easeInOut"
			                    data-endspeed="300">
			                    <?php if($this->lang == 'ita'):?>
			                    <span class="slider-caption hidden-xs">Shop online<br><i class="fa fa-angle-down"></i></span>
			                    <?php else:?>
			                    <span class="slider-caption hidden-xs">Shop online<br><i class="fa fa-angle-down"></i></span>
			                    <?php endif;?>
			                    
		                  	</div>
						</div>
              		</li>
            		<?php endforeach;?>
            	<?php else:?>
          		<li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1" >
          			<img src="/_ext/img/scacchi_online_1.jpg" alt="<?php $site->getAlt()?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
               		<div class="slider-caption container captionCenter">
	                  	<div class="tp-caption rs-caption-1 sft start captionCenterAlign"
		                    data-x="center"
		                    data-y="0"
		                    data-speed="800"
		                    data-start="1500"
		                    data-easing="Back.easeInOut"
		                    data-endspeed="300">
		                    <span class="slider-caption">E-commerce<br><i class="fa fa-arrow-down"></i></span>
	                  	</div>
					</div>
              	</li>
              	<li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
                	<img src="/_ext/img/scacchi_online_2.jpg" alt="<?php $site->getAlt()?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
               		<div class="slider-caption container captionCenter">
		                <div class="tp-caption rs-caption-1 sft start captionCenterAlign"
		                    data-x="center"
		                    data-y="0"
		                    data-speed="800"
		                    data-start="1500"
		                    data-easing="Back.easeInOut"
		                    data-endspeed="300">
		                    <span class="slider-caption">E-commerce<br><i class="fa fa-arrow-down"></i></span>
		                </div>
                   </div>
              	</li>
              	<li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700"  data-title="Slide 3">
                	<img src="/_ext/img/scacchi_online_3.jpg" alt="<?php $site->getAlt()?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
              		<div class="slider-caption container captionCenter">
                  		<div class="tp-caption rs-caption-1 sft start captionCenterAlign"
		                    data-x="center"
		                    data-y="0"
		                    data-speed="800"
		                    data-start="1500"
		                    data-easing="Back.easeInOut"
		                    data-endspeed="300">
                   			<span class="slider-caption">E-commerce<br><i class="fa fa-arrow-down"></i></span>
                  		</div>
                 	</div>
              	</li>


              	<li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 4">
                	<img src="/_ext/img/scacchi_online_4.jpg" alt="<?php $site->getAlt()?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
               		<div class="slider-caption container captionCenter">
			        	<div class="tp-caption rs-caption-1 sft start captionCenterAlign"
		                    data-x="center"
		                    data-y="0"
		                    data-speed="800"
		                    data-start="1500"
		                    data-easing="Back.easeInOut"
		                    data-endspeed="300">
		                    <span class="slider-caption">E-commerce<br><i class="fa fa-arrow-down"></i></span>
			            </div>
                  	</div>
              	</li>
              	<?php endif;?>
            </ul>
          </div>
        </div>
      </div>