<?php

if(isset($_SESSION['id_user']))
{
	$user = $this->userManager->getUserInfo($_SESSION['id_user']);
	$user_details = $this->userManager->getUserDetails($_SESSION['id_user']);
}
else
{
	$user = array();
	$user_details = array();
}

$province = $this->getProvince();
$nazioni = $this->getNazioni();
?>
<form id="form_carrello" method="post" action="<?php $this->getUrl('rivedi_ordine')?>">
	<input type="hidden" name="lang" id="lang" value="<?php echo $this->lang?>" />
	<input type="hidden" value="<?php echo $this->carrello->importo_totale;?>" name="importo_carrello">
	<div class="form-group">
		<div class="row">
			<div class="col-md-6">			
				
				<div class="checkbox">
    			<label>
      				<input type="checkbox" name="regalo" id="regalo"/> <span class="conf-reg" style="font-size:130%;font-weight:bold"><?php echo _CONF_REGALO?></span>
    			</label>
  				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">		
			<div class="col-md-6">
				<label for="nome" ><?php echo _NOME?>*</label>
		   		<input type="text" class="form-control" id="nome" name="nome" value="<?php echo ($_SESSION['carrello']['spedizione']['nome']!="") ? $_SESSION['carrello']['spedizione']['nome'] : $user['nome']?>" />
			</div>
			<div class="col-md-6">
				<label for="cognome" ><?php echo _COGNOME?>*</label>
		    	<input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo ($_SESSION['carrello']['spedizione']['cognome']!="") ? $_SESSION['carrello']['spedizione']['cognome'] : $user['cognome']; ?>"  />
			</div>
		</div>
    </div>
    
    <div class="form-group">
    	<div class="row">	
	    	<div class="col-md-6">
		    	<label for="email" >Email*</label>
		    	<input type="text" class="form-control" id="email" name="email" value="<?php echo ($_SESSION['carrello']['spedizione']['email']!="") ? $_SESSION['carrello']['spedizione']['email'] : $user['email'];?>"/>	
	    	</div>
	    	<div class="col-md-6">
	    		<label for="tel" ><?php echo _TELEFONO?>*</label>
	    		<input type="text" class="form-control" id="tel" name="tel" value="<?php echo $_SESSION['carrello']['spedizione']['tel']; ?>"/>	
	    	</div>
	    </div>
    </div>	
    
    <div class="form-group">
    	<div class="row">	
	    	<div class="col-md-6">
	    		<label for="indirizzo" ><?php echo _INDIRIZZO_CONSEGNA?>*</label>
	    		<input type="text" class="form-control" name="indirizzo" value="<?php echo $_SESSION['carrello']['spedizione']['indirizzo'];?>">
	    	</div>
	    	<div class="col-md-6">
	    		<label for="cap"><?php echo _CAP?>*</label>
				<input type="text" class="form-control" name="cap" value="<?php echo $_SESSION['carrello']['spedizione']['cap'];?>" maxlength="7">
	    	</div>
	    </div>
    </div>		

	<div class="form-group">
		<div class="row">	
			<div class="col-md-4">
				<label for="citta"><?php echo _CITTA?>*</label>
				<input type="text" class="form-control" name="citta" value="<?php echo $_SESSION['carrello']['spedizione']['citta'];?>">
			</div>
			<?php if($this->lang == 'ita'):?>
			<div class="col-md-4">
				<div id="prov-camp">
				<label for="prov">Provincia*</label>
				<select id="prov" name="prov" class="form-control">
					<option value="">&nbsp;</option>
					<?php foreach($province as $prov):?>
					<?php $selected = ($prov['sigla'] == $_SESSION['carrello']['spedizione']['prov']) ? 'selected="selected"': ''; ?>
					<option value="<?php echo $prov['sigla'];?>" <?php echo $selected;?>><?php echo utf8_encode($prov['provincia']);?></option>
					<?php endforeach;?>
				</select>
				</div>
			</div>
			<?php endif;?>
			<div class="col-md-4">
				<label for="nazione"><?php echo _NAZIONE?>*</label>
				<select id="nazione" name="nazione" class="form-control" onchange="dropProvincia();">
					<option value="">&nbsp;</option>
					<?php foreach($nazioni as $nazione):?>
					<?php if($this->lang == 'ita'):?>
						<?php $selected = ($nazione['nome_it'] == 'Italia') ? 'selected="selected"': ''; ?>
						<option value="<?php echo $nazione['id'];?>" <?php echo $selected;?>><?php echo utf8_encode($nazione['nome_it']);?></option>
					<?php else:?>
						<?php $selected = ($nazione['nome_en'] == $_SESSION['carrello']['spedizione']['prov']) ? 'selected="selected"': ''; ?>
						<option value="<?php echo $nazione['id'];?>" <?php echo $selected;?>><?php echo utf8_encode($nazione['nome_en']);?></option>
					<?php endif;?>
					
					<?php endforeach;?>
				</select> 
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
				<?php 
					$date = date_create($user_details['data_nascita']);
					$data_formattata = date_format($date, 'd/m/Y');
					//$value = ($_SESSION['carrello']['spedizione']['data_nascita']!="") ? $_SESSION['carrello']['spedizione']['data_nascita'] : $user_details['data_nascita'];
					$value = ($_SESSION['carrello']['spedizione']['data_nascita']!="") ? $_SESSION['carrello']['spedizione']['data_nascita'] : $data_formattata;
					
					$value = ($value!="") ? $value : "";
					
				
				?>
				<label for="data_nascita"><?php echo _DATA_NASCITA?>*</label>
				<input type="text" class="form-control datepicker" id="data_nascita" name="data_nascita" value="<?php echo $value;?>">
			</div>
			<div class="col-md-4">
				<?php 
					$value = ($_SESSION['carrello']['spedizione']['citta_nascita']!="") ? $_SESSION['carrello']['spedizione']['citta_nascita'] : $user_details['citta_nascita'];
				
				?>
				<label for="citta_nascita"><?php echo _LUOGO_NASCITA?>*</label>
				<input type="text" class="form-control" id="citta_nascita" name="citta_nascita" value="<?php echo $value;?>">
			</div>
			<div class="col-md-4">
				<label for="pagamento"><?php echo _PAGAMENTO?>*</label>
				<select class="form-control" id="pagamento" name="pagamento">
					<option value="">&nbsp;</option>
					<option value="bonifico"><?php echo _BONIFICO?></option>
					<?php if($this->carello->importo_totale < 1000 && $this->lang == 'ita'):?>
					<option value="contrassegno" id="contrassegno">Contrassegno (solo Italia)</option>
					<?php endif;?>							
					<option value="paypal"><?php echo _CARTA_CREDITO?></option>
				</select>
			</div>
			
			<!-- privacy -->
			<div class="col-sm-12" style="margin-bottom:0px;margin-top:20px;">
				<p style="width: 100%;font-size: 12px;text-align:left;">
			 	 	Privacy* <?php echo _CONSENSO?> 
			 	 	<input name="privacy" type="checkbox" id="privacy" value="Privacy"
						 onclick="abilita()" />&nbsp;&nbsp; <br>
					<?php if($this->lang == 'ita'):?>
					<a href="/modalita-pagamento.php" style="color:#000"><?php echo _INFORMATIVA?> </a>
					<?php else:?>
					<a href="/eng/type-of-payment.php" style="color:#000"><?php echo _INFORMATIVA?> </a>
					<?php endif;?>
				</p>
			</div>
			<!-- fine privacy -->
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
				<button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#840025;"><?php echo _CONTINUA?></button>
				<span style="padding-top: 10px;font-size: 12px;color:#000; display: block;">* <?php echo _OBBLIGATORIO?></span>
			</div>
		</div>
	</div>
	
</form>

<script>
$(document).ready(function() {
	$("#form_carrello").validate({
		rules: {
		    nome:{ required: true },
		    cognome:{ required: true},	    
		    email:{ required: true,email:true},
		    tel:{ required: true},	
			indirizzo:{ required: true},	
			cap:{ required: true},	
			citta:{ required: true},	
			<?php if($this->lang == 'ita'):?>
			prov:{ required: true},	
			<?php endif;?>
			nazione:{ required: true},	
			data_nascita:{ required: true, dateITA : true},	
			pagamento:{ required: true},
			privacy:{ required: true},
		  },
		messages: {
			nome:{ required: "<?php echo _WARN_1 ?>" },
		    cognome:{ required: "<?php echo _WARN_1 ?>" },			    
		    email:{ required: "<?php echo _WARN_1?>",email:"<?php echo _WARN_2?>" },
		    tel:{ required: "<?php echo _WARN_1 ?>" },
			indirizzo:{ required: "<?php echo _WARN_1 ?>" },
			cap:{ required: "<?php echo _WARN_1 ?>" },
			citta:{ required: "<?php echo _WARN_1 ?>" },	
			<?php if($this->lang == 'ita'):?>
			prov:{ required: "<?php echo _WARN_1 ?>" },
			<?php endif;?>
			nazione:{ required: "<?php echo _WARN_1 ?>" },	
			data_nascita:{ required: "<?php echo _WARN_1 ?>" },
			pagamento:{ required: "<?php echo _WARN_1 ?>" },
			privacy:{ required: "<?php echo _WARN_1 ?>" },
		  },
		submitHandler: function (form) {
			    ga("send", "event", "formacquisto", "submit");
			    form.submit();
		}
	});

});
</script>
