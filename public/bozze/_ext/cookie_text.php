<?php 
if($_COOKIE['c_acceptance']!="yes"){
	?>
	<style type="text/css">
	#cookies {
		position:fixed;
		top: 0px;
		border-top: solid 1px #ccc;
		background:#fcfcfc; 
		z-index:10000000000000000;
		padding: 10px;
		padding-left:10px;
		text-align:center;
		width:100%;
		font-size:90%;
	}
	#cookies_ok{
		background: blue;
		padding:3px 5px;
		color:#fff;
		text-decoration: none;
	}
	#cookies_ok:hover{
		color:#fcfcfc;
	}
	</style>
    <script>
	function AcceptCookies(){	//Se funzione singola
		$.ajax({
			url: "/_ext/ajax/ajax.php", //Modificare a seconda del caso
			data: "az=15", //Modificare a seconda del caso
			type: "post",
			success: function(data){
			        
						$("#cookies").fadeOut('slow');
			}
		});
	}
	</script>
	<?php
    if($this->lang == 'ita')
    {
        $url = '/policy.php';
    }
    elseif($this->lang == 'eng')
    {
        $url = '/eng/policy.php';
    }
    elseif($this->lang == 'deu')
    {
        $url = '/de/policy.php';
    }
    elseif($this->lang == 'rus')
    {
        $url = '/ru/policy.php';
    }
    else
    {
        $url = '/spa/policy.php';
    }
	//$url = ($this->lang == 'ita')? '/policy.php' : '/eng/policy.php';
	
	//if($this->lang == 'spa'){ $url = '/spa/policy.php';}
	?>
	<div id="cookies" style="color:#000;">
	<?php echo _COOKIES_MSG_1?> <a href="<?php echo $url;?>" style="color:#407197; font-weight:bold;" target="_blank">Policy</a>);
	&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
	<?php echo _COOKIES_MSG_2?> <a href="javascript:void(0);" onclick="AcceptCookies();" id="cookies_ok" style="color:#fff;">OK</a>
	</div>	
<?php    
}


?>