<?php 
$urlAction = self::_ROOT . "_ext/ajax/modifica_account.php";
$user = $this->userManager->getUserInfo($_SESSION['id_user']);
?>
<div id="form_registrazione_container">
	<form class="" action="#" id="formmodificaaccount" method="post" data-type="contact">
		<input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang?>" />
		
		<div class="form-group">
			<label for="nome" ><?php echo _NOME?>*</label>
	    	<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $user['nome'];?>" />
    	</div>
    	
    	<div class="form-group">
	    	<label for="cognome" ><?php echo _COGNOME?>*</label>
	    	<input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo $user['cognome'];?>"  />
    	</div>
    	
    	<div class="form-group">
	    	<label for="email" >Email*</label>
	    	<input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'];?>"/>	
    	</div>
    	
    	<?php echo _MODIFICA_PASS?>&nbsp;<input type="checkbox" id="mod_pwd" name="mod_pwd" value="1" onclick="$('#Other').toggle();" /><br><br>
    	
    	<div id="Other" style="display:none">
	    	<div class="form-group">
		    	<label for="password" ><?php echo _VECCHIA_PASS?>*</label>
		    	<input type="password" class="form-control" id="vecchia_password" name="vecchia_password" value="" />
	    	</div>
	    	
	    	<div class="form-group">
		    	<label for="password" ><?php echo _NUOVA_PASS?>*</label>
		    	<input type="password" class="form-control" id="nuova_password" name="nuova_password" value="" />
	    	</div>	
	    	
	    	<div class="form-group">
		    	<label for="password" ><?php echo _RIDIGITA_PASS?>*</label>
		    	<input type="password" class="form-control" id="nuova_password2" name="nuova_password2" value="" />	
	    	</div>
    	</div>
    
		
		<div class="form-group">
			<button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000"><?php echo _INVIA?></button>
			
		</div>
	</form>
</div>
<script>
$(document).ready(function() {
	$("#formmodificaaccount").validate({
		rules: {
		    nome:{ required: true },
		    cognome:{ required: true},	   		
		    email:{ required: true,email:true},
		    nuova_password2:{ equalTo: "#nuova_password"},  
		  },
		messages: {
			nome:{ required: "<?php echo _WARN_1 ?>" },
		    cognome:{ required: "<?php echo _WARN_1 ?>" },	   		    
		    email:{ required: "<?php echo _WARN_1?>",email:"<?php echo _WARN_2?>" },
		    nuova_password2:{ equalTo: "<?php echo _WARN_4?>"},
		  },
		submitHandler: function(form)
		{ 
			$.ajax({
		    type: "POST",
		    url: "<?php echo $urlAction ?>",
		    data : $('#formmodificaaccount').serialize(),
		    dataType: "json",
		    
			success: function(data)
		    { 
				$(".modal-title").html( 'ACCOUNT' );
				$("#ajax-test").html( data.msg );
				$('#myModal').fadeIn();
				return;	 
		    },
		    error: function()
		    {
		    	$(".modal-title").html( 'ACCOUNT' );
				$("#ajax-test").html( 'errore!' );
				$('#myModal').fadeIn();
				return;	 
		    },
		  	});
		 },
	});
});
</script>