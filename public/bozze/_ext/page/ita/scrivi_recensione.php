<?php 

$urlAction = self::_ROOT . "_ext/mail_form/invio_recensione.php";

?>
<section class="lightSection clearfix pageHeader">
	<div class="container">
    	<div class="row">
            <div class="col-xs-6">
            	<div class="page-title">
                	<h2 class="fjalla">RECENSIONE</h2>
              	</div>
            </div>
        
    	</div>
	</div>
</section>
<section class="mainContent clearfix productsContent">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-12 col-xs-12 sideBar hidden-xs hidden-sm">
        		<?php //$site->getFile('menu-prodotti')?>
        		<?php $site->getFile('box_facebook',true)?>
            </div>
            
            <div class="col-md-9 col-xs-12 col-sm-12">
            	<p class="messaggioattesa" style="text-align: center;">
					<img src="<?php echo self::_ROOT?>_ext/img/loading.gif">
				</p>
				<div id="messaggio_ri" style="padding-top: 10px;"></div>
            	<div class="page-content">
                	<form id="formrecensioni" method="post" action="#" >
                		<input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang?>" />
                		<div class="row">
	                		<div class="form-group col-sm-12">
	                			<label style="display:block">Nome*</label>
	                			<input type="text" class="form-control" name="nome" id="nome" />
	                			<br>
	                			<label style="display:block">Recensione*</label>
	                			<textarea rows="7" class="form-control" name="messaggio" id="messaggio"></textarea>
	                		</div>                		
	  						<!-- per il CAPTCHA -->
							<div class="form-group col-sm-12">
								<div>
									<img style="float: left; width: 165px;" alt="CAPTCHA Image"
										id="captcha"
										src="<?php echo self::_ROOT?>_ext/mail_form/securimage/securimage_show.php" />
						
									<a style="float: left; display: block; padding-left: 4px;" href="#"
										onclick="document.getElementById('captcha').src = '<?php echo self::_ROOT?>_ext/mail_form/securimage/securimage_show.php?' + Math.random(); return false">
										<img style="height: 28px;"
										src="<?php echo self::_ROOT?>_ext/mail_form/img/refresh.png">
									</a>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="form-group col-sm-12" style="margin-bottom:10px;">
						
									<input maxlength="6" class="form-control" name="captcha_code"
										id="captcha_code" 
										placeholder="<?php echo _RISULTATOIMMAGINE?>" type="text" />
									<div id="messaggio_errore" style="padding-top: 10px;"></div>
							
							</div>
							<!-- fine CAPTCHA -->
						
							<!-- privacy -->
							<div class="form-group col-sm-12" style="margin-bottom:0px;">
								<p style="width: 100%;font-size: 12px;text-align:left;">
							 	 	Privacy* <?php echo _CONSENSO?> 
							 	 	<input name="privacy" type="checkbox" id="privacy" value="Privacy"
										 onclick="abilita()" />&nbsp;&nbsp; <br>
									<a href="#" 
										onclick="window.open('/informativa_<?php echo $this->lang?>.htm','informativa','scrollbars=yes,width=550,height=650');"><?php echo _INFORMATIVA?> </a>
								</p>
							</div>
							<!-- fine privacy -->
						
							<div class="form-group col-sm-12">
								<button id="submit_btn" type="submit"
									class="btn btn-default"><?php echo _INVIA?></button>
									<span style="padding-top: 10px;font-size: 12px;display: block;">* <?php echo _OBBLIGATORIO?></span>
							</div>
						</div>
                	</form> 
                	
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo self::_ROOT?>_ext/js/jquery.validate.js"></script>
<script src="<?php echo self::_ROOT?>_ext/js/additional-methods.js"></script>


<style>
.error {
	color: #f88d27;
	font-size: 80%;
}

.messaggioattesa,#messaggio_ri,#messaggio_errore {
	display: none;
}
</style>
<script>

	$("#formrecensioni").validate({
	  ignore: [],
	  event: 'blur',
	  rules: {
	    nome:{ required: true },
	    privacy:{required:true},
	    messaggio:{ required: true },
	    captcha_code:{ required: true}    
	  },
	  messages: {
	    nome:{ required: "<?php echo _WARN_1 ?>" },
	    messaggio:{ required: "<?php echo _WARN_1?>" },
	    privacy:{ required: "<?php echo _WARN_1?>" },
	    captcha_code:{ required: "<?php echo _WARN_1?>" }
	  },
	  submitHandler: function(form)
	  { 
	    $.ajax({
	    type: "POST",
	    url: "<?php echo $urlAction ?>",
	    data : $('#formrecensioni').serialize(),
	    dataType: "html",
	    beforeSend: function() {
	      $("#formrecensioni").hide();
	      $(".messaggioattesa").show();
	    },
	    success: function(msg)
	    { 
	      if(msg.search("errore") != -1)
	      {
	        $(".messaggioattesa").hide();
	        $("#formrecensioni").hide();
	        $("#messaggio_errore").empty();
	        $("#messaggio_errore").html(msg);
	        $("#messaggio_errore").fadeIn("slow");
	      }
	      else
	      {
	        var msgnew=msg.replace("errore,", "");
	        $(".messaggioattesa").fadeOut("slow");
	        $("#messaggio_ri").empty();
	        $("#messaggio_ri").html(msgnew);
	        $("#messaggio_ri").fadeIn();
	        $("#formrecensioni").hide();
	      }
	    },
	    error: function()
	    {
	      $("#messaggio_errore").empty();
	      $("#messaggio_errore").html("<?php echo _WARN_3?>");
	      $("#messaggio_errore").fadeIn();
	      $("#formrecensioni").fadeIn();
	    },
	  });
	  },
	  invalidHandler: function(form)
	  {
	    
	  }
	});
</script>