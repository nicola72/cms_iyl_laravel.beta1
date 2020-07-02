<?php 

$urlAction = self::_ROOT . "_ext/ajax/login.php";

?>

<form class="" action="#" id="formlogin" method="post" data-type="contact">
	<input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang?>" />
	<div class="form-group">
		<label>username/email</label>
		<input class="form-control" name="username" id="username" />
	</div>
	<div class="form-group">
		<label>password</label>
		<input class="form-control" type="password" name="pass" id="pass" />
		 
	</div>
	<div class="form-group">
		<button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000">Login</button>
	</div>
</form>


<script>
$(document).ready(function() {

	$("#formlogin").validate({
	  ignore: [],
	  event: 'blur',
	  rules: {
	    username:{ required: true },
	    pass:{ required: true},
	  },
	  messages: {
	    username:{ required: "<?php echo _WARN_1 ?>" },
	    pass:{ required: "<?php echo _WARN_1?>" },
	
	  },
	  submitHandler: function(form)
	  { 
	    $.ajax({
	    type: "POST",
	    url: "<?php echo $urlAction ?>",
	    data : $('#formlogin').serialize(),
	    dataType: "json",
	    
	    success: function(data)
	    {   
		    if(data.msg == 'auth')
			{
				<?php if($this->lang == 'ita'):?>
				window.location.assign("https://www.chess-store.it");
				<?php else:?>
				window.location.assign("https://www.chess-store.org");
				<?php endif;?>
		    	return;
			}
	    	$(".modal-title").html( 'LOGIN' );
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