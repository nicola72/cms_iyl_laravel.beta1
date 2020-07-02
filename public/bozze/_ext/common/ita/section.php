<section class="lightSection clearfix"	style="height: auto; padding-top: 20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-4"
				style="font-size: 130%; line-height: 1.6em; margin-bottom: 30px;">
				<img src="img/care.png" alt="" class="img-responsive" style="height: 70px; float: left; margin-right: 20px;" /> 
				<strong>Customer	Care</strong><br /> Per consegne urgenti:<br />
				<i class="fa fa-phone"></i> +39 328 0090798<br />

			</div>
			<!-- <div class="col-md-4" style="margin-bottom: 30px;">
				<?php if($this->page != 'scheda_prodotto' || $this->page != 'categoria'):?>
				<div class="fb-page"
					data-href="https://www.facebook.com/Marsilis-Company-316915328512344/"
					data-small-header="false" data-adapt-container-width="true"
					data-hide-cover="false" data-show-facepile="true">
					<blockquote
						cite="https://www.facebook.com/Marsilis-Company-316915328512344/"
						class="fb-xfbml-parse-ignore">
						<a
							href="https://www.facebook.com/Marsilis-Company-316915328512344/">Marsili&#039;s
							Company</a>
					</blockquote>
				</div> 
				<?php endif;?>

			</div> -->
			<div class="col-md-4" style="margin-bottom: 30px;">
				<div class="newsletter clearfix">
					<h4>Iscriviti alla nostra Newsletter</h4>
					<form id="newsletter_form" method="get" action="" onsubmit="addToNewsletter('<?php echo $this->lang?>')">
					<div class="input-group">
						
							<input name="news_email" id="news_email" type="text" class="form-control"	placeholder="inserisci la tua email" aria-describedby="basic-addon2"> 
							<a href="javascript:void(0)" class="input-group-addon" id="basic-addon2" onclick="addToNewsletter('<?php echo $this->lang?>')">
								invia <i class="glyphicon glyphicon-chevron-right"></i>
							</a>						
						
					</div>
					</form>	
				</div>
			</div>
		</div>
	</div>
</section>