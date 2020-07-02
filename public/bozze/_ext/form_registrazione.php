<?php 

$urlAction = self::_ROOT . "_ext/ajax/registrazione.php";

?>
<div id="form_registrazione_container">
	<form class="" action="#" id="formregistrazione" method="post" data-type="contact">
		<input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang?>" />
		
		<div class="form-group">
			<label for="nome" ><?php echo _NOME?>*</label>
	    	<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['nome'];?>" />
    	</div>
    	
    	<div class="form-group">
	    	<label for="cognome" ><?php echo _COGNOME ?>*</label>
	    	<input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo $_SESSION['cognome'];?>"  />
    	</div>
    	
    	<div class="form-group">
	    	<label for="email" >Email*</label>
	    	<input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'];?>"/>	
    	</div>
    	
    	<div class="form-group">
	    	<label for="password" >Password*</label>
	    	<input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['password'];?>" />
    	</div>	
    	
    	<div class="form-group">
	    	<label for="password" ><?php echo _RIDIGITA_PASS?>*</label>
	    	<input type="password" class="form-control" id="password2" name="password2" value="<?php echo $_SESSION['password'];?>" />	
    	</div>
    	
    	<div class="form-group">
	    	<label for="nascita" ><?php echo _DATA_NASCITA ?>*</label>
	    	<input type="text" class="form-control datepicker" id="nascita" name="nascita" value="<?php echo $_SESSION['nascita'];?>" />	
    	</div>
    	
    	<div class="form-group">
	    	<label for="luogo_nascita" ><?php echo _LUOGO_NASCITA ?>*</label>
	    	<input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" value="<?php echo $_SESSION['luogo_nascita'];?>" />	
    	</div>
    	
    	<div class="form-group">
		<p style="width: 100%;color:#000;font-size: 12px;text-align:left;">
	 	 	Privacy* <?php echo _CONSENSO?> 
	 	 	<input name="privacy" type="checkbox" id="privacy" value="Privacy"
				 />&nbsp;&nbsp; <br>
			<a href="#" style="color:#000"
				onclick="window.open('/informativa_<?php echo $this->lang?>.htm','informativa','scrollbars=yes,width=550,height=650');"><?php echo _INFORMATIVA?> </a>
		</p>
		</div>
		
		<div class="form-group">
			<button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000"><?php echo _REGISTRATI?></button>
			<span style="padding-top: 10px;font-size: 12px;color:#000; display: block;">* <?php echo _OBBLIGATORIO?></span>
		</div>
	</form>
	
</div>
<script>
$(document).ready(function() {
	$("#formregistrazione").validate({
		rules: {
		    nome:{ required: true },
		    cognome:{ required: true},	    
		    nascita:{ required: true},
		    luogo_nascita:{ required: true},
		    privacy:{ required: true},    
		    password:{ required:true, minlength: 4, maxlength:8},	
		    password2:{ equalTo: "#password"},   
		    email:{ required: true,email:true},
		  },
		messages: {
			nome:{ required: "<?php echo _WARN_1 ?>" },
		    cognome:{ required: "<?php echo _WARN_1 ?>" },	   
		    nascita:{ required: "<?php echo _WARN_1 ?>"},
		    luogo_nascita:{ required: "<?php echo _WARN_1 ?>"},
		    privacy:{ required: "<?php echo _WARN_1?>" },
		    password:{ required: "<?php echo _WARN_1 ?>",minlength:"deve essere min 5 e max 8 caratteri", maxlength:"deve essere compresa fra 3 e 8 caratteri"},
		    password2:{ equalTo: "<?php echo _WARN_4?>"},
		    email:{ required: "<?php echo _WARN_1?>",email:"<?php echo _WARN_2?>" },
		  },
		submitHandler: function(form)
		{ 
			$.ajax({
		    type: "POST",
		    url: "<?php echo $urlAction ?>",
		    data : $('#formregistrazione').serialize(),
		    dataType: "json",
		    
			success: function(data)
		    { 
				$(".modal-title").html( '<?php echo _REGISTRAZIONE?>' );
				$("#ajax-test").html( data.msg );
				$('#myModal').fadeIn();
				return;	 
		    },
		    error: function()
		    {
		    	$(".modal-title").html( 'Errore' );
				$("#ajax-test").html( 'errore!' );
				$('#myModal').fadeIn();
				return;	 
		    },
		  	});
		 },
	});
});
</script>
