<?php 

$urlAction = self::_ROOT . "_ext/ajax/recupera_pwd.php";

?>

<form class="" action="#" id="formrecupera" method="post" data-type="contact">
	<input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang?>" />
	<div class="form-group">
		<label>Email</label>
		<input class="form-control" name="email" id="email" />
	</div>
	<div class="form-group">
		<button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000"><?php echo _INVIA?></button>
	</div>
</form>


<script>
$(document).ready(function() {

	$("#formrecupera").validate({
	  ignore: [],
	  event: 'blur',
	  rules: {
		  email:{ required: true,email:true},
	    
	  },
	  messages: {
		  email:{ required: "<?php echo _WARN_1?>",email:"<?php echo _WARN_2?>" },	    
	
	  },
	  submitHandler: function(form)
	  { 
	    $.ajax({
	    type: "POST",
	    url: "<?php echo $urlAction ?>",
	    data : $('#formrecupera').serialize(),
	    dataType: "json",
	    
	    success: function(data)
	    {   
		    
	    	$(".modal-title").html( 'PASSWORD' );
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