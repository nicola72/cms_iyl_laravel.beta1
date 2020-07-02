<form id="form_filtro" method="get" action="/filtro.php" style="margin-top:10px;" class="pl-15">
	<input type="hidden" name="lang" value="<?php echo $this->lang?>" />
	<input type="hidden" name="categoria" value="<?php echo $_GET['categoria']?>" />	
	<input type="hidden" name="sottocategoria" value="<?php echo $_GET['sottocategoria']?>" />
	<input type="hidden" name="ordine" value="prezzo|ASC">
	<?php if($this->lang == 'ita'):?>
	<input type="hidden" name="uri" value="<?php echo $this->macroCategoria['url_it']?>" />
	<?php else:?>
	<input type="hidden" name="uri" value="<?php echo $this->macroCategoria['url_en']?>" />
	<?php endif;?>
	<!--select name="id_tipologia" onchange="$('#form_filtro').submit()">
		<option value="">&nbsp;</option>
		<optgroup label="<?php echo _MATERIALE_SCACCHI ?>">
			<option value="21" <?php if ($_GET['id_tipologia']=="21") { echo 'selected="selected"'; }?>><?php echo _IN_OTTONE?></option>
			<option value="24" <?php if ($_GET['id_tipologia']=="24") { echo 'selected="selected"'; }?>><?php echo _IN_METALLO?></option>
			<option value="25" <?php if ($_GET['id_tipologia']=="25") { echo 'selected="selected"'; }?>><?php echo _IN_METALLO_PITTURATI?></option>
			<option value="26" <?php if ($_GET['id_tipologia']=="26") { echo 'selected="selected"'; }?>><?php echo _IN_RESINA_PITTURATI?></option>
			<option value="27" <?php if ($_GET['id_tipologia']=="27") { echo 'selected="selected"'; }?>><?php echo _IN_RESINA_PELTRO?></option>
			<option value="28" <?php if ($_GET['id_tipologia']=="28") { echo 'selected="selected"'; }?>><?php echo _IN_LEGNO_PREGIATO?></option>
			<option value="56" <?php if ($_GET['id_tipologia']=="56") { echo 'selected="selected"'; }?>><?php echo _IN_LEGNO_LACCATO?></option>
			<option value="69" <?php if ($_GET['id_tipologia']=="69") { echo 'selected="selected"'; }?>><?php echo _IN_ALTRI_MATERIALI?></option>
		</optgroup>

		<optgroup label="<?php echo _MATERIALE_SCACCHIERA?>">
			<option value="33" <?php if ($_GET['id_tipologia']=="33") { echo 'selected="selected"'; }?>><?php echo _IN_RADICA?></option>
			<option value="34" <?php if ($_GET['id_tipologia']=="34") { echo 'selected="selected"'; }?>><?php echo _IN_LEGNO_PREGIATO?></option>
			<option value="35" <?php if ($_GET['id_tipologia']=="35") { echo 'selected="selected"'; }?>><?php echo _IN_ALABASTRO?></option>
			<option value="36" <?php if ($_GET['id_tipologia']=="36") { echo 'selected="selected"'; }?>><?php echo _IN_SIMILCUOIO?></option>
			<option value="37" <?php if ($_GET['id_tipologia']=="37") { echo 'selected="selected"'; }?>><?php echo _IN_LEGNO_METALLO?></option>
		</optgroup>

		<optgroup label="<?php echo _PREZZO?>">
			<option value="p_0_100" <?php if ($_GET['id_tipologia']=="p_0_100") { echo 'selected="selected"'; }?>>0 - 100 &euro;</option>
			<option value="p_100_200" <?php if ($_GET['id_tipologia']=="p_100_200") { echo 'selected="selected"'; }?>>100 - 200 &euro;</option>
			<option value="p_200_500" <?php if ($_GET['id_tipologia']=="p_200_500") { echo 'selected="selected"'; }?>>200 - 500 &euro;</option>
			<option value="p_500_1000" <?php if ($_GET['id_tipologia']=="p_500_1000") { echo 'selected="selected"'; }?>>500 - 1000 &euro;</option>
			<option value="p_1000_" <?php if ($_GET['id_tipologia']=="p_1000_") { echo 'selected="selected"'; }?>><?php echo _OLTRE?> 1000 &euro;</option>
		</optgroup>

		<optgroup label="<?php echo _STILE?>">
			<option value="st_Set_Tradizionali_da_Gioco" <?php if ($_GET['id_tipologia']=="st_Set_Tradizionali_da_Gioco") { echo 'selected="selected"'; }?>><?php echo _SET_TRADIZIONALI?></option>
			<option value="st_Set_Classici" <?php if ($_GET['id_tipologia']=="st_Set_Classici") { echo 'selected="selected"'; }?>><?php echo _SET_CLASSICI?></option>
			<option value="st_Set_Moderni" <?php if ($_GET['id_tipologia']=="st_Set_Moderni") { echo 'selected="selected"'; }?>><?php echo _SET_MODERNI?></option>
			<option value="st_Set_a_Tema" <?php if ($_GET['id_tipologia']=="st_Set_a_Tema") { echo 'selected="selected"'; }?>><?php echo _SET_A_TEMA?></option>
		</optgroup>
	</select-->
	<input type="hidden" id="id_tipologia" name="id_tipologia">
	<b><?=_STILE?></b>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="st_Set_Tradizionali_da_Gioco")?' underline':''?>" 
    	onclick="$('#id_tipologia').val('st_Set_Tradizionali_da_Gioco');$('#form_filtro').submit();"><?=_SET_TRADIZIONALI?></div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="st_Set_Classici")?' underline':''?>" 
    	onclick="$('#id_tipologia').val('st_Set_Classici');$('#form_filtro').submit();"><?=_SET_CLASSICI?></div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="st_Set_Moderni")?' underline':''?>" 
    	onclick="$('#id_tipologia').val('st_Set_Moderni');$('#form_filtro').submit();"><?=_SET_MODERNI?></div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="st_Set_a_Tema")?' underline':''?>" 
    	onclick="$('#id_tipologia').val('st_Set_a_Tema');$('#form_filtro').submit();"><?=_SET_A_TEMA?></div>

    <?php if (  $this->page == 'categoria' and $_GET['sottocategoria'] != '89' ): ?>
		<b><?=_MATERIALE_SCACCHI?></b>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="21,102,103,104,105")?' underline':''?>" onclick="$('#id_tipologia').val('21,102,103,104,105');$('#form_filtro').submit();"><?=_IN_OTTONE?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="24,25,106,107,108")?' underline':''?>" onclick="$('#id_tipologia').val('24,25,106,107,108');$('#form_filtro').submit();"><?=_IN_METALLO?></div>
	    <!--div class="cursor pl-15<?=($_GET['id_tipologia']=="25")?' underline':''?>" onclick="$('#id_tipologia').val('25');$('#form_filtro').submit();"><?=_IN_METALLO_PITTURATI?></div-->
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="28,56")?' underline':''?>" onclick="$('#id_tipologia').val('28,56');$('#form_filtro').submit();"><?=_IN_LEGNO?></div>
	    <!--div class="cursor pl-15<?=($_GET['id_tipologia']=="28")?' underline':''?>" onclick="$('#id_tipologia').val('28');$('#form_filtro').submit();"><?=_IN_LEGNO_PREGIATO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="56")?' underline':''?>" onclick="$('#id_tipologia').val('56');$('#form_filtro').submit();"><?=_IN_LEGNO_LACCATO?></div-->
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="26")?' underline':''?>" onclick="$('#id_tipologia').val('26');$('#form_filtro').submit();"><?=_IN_RESINA_PITTURATI?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="27")?' underline':''?>" onclick="$('#id_tipologia').val('27');$('#form_filtro').submit();"><?=_IN_RESINA_PELTRO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="69")?' underline':''?>" onclick="$('#id_tipologia').val('69');$('#form_filtro').submit();"><?=_IN_ALTRI_MATERIALI?></div>

	    <b><?=_MATERIALE_SCACCHIERA?></b>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="34,119")?' underline':''?>" onclick="$('#id_tipologia').val('34,119');$('#form_filtro').submit();"><?=_IN_LEGNO_PREGIATO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="35")?' underline':''?>" onclick="$('#id_tipologia').val('35');$('#form_filtro').submit();"><?=_IN_ALABASTRO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="33")?' underline':''?>" onclick="$('#id_tipologia').val('33');$('#form_filtro').submit();"><?=_IN_RADICA?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="37")?' underline':''?>" onclick="$('#id_tipologia').val('37');$('#form_filtro').submit();"><?=_IN_LEGNO_METALLO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="101")?' underline':''?>" onclick="$('#id_tipologia').val('101');$('#form_filtro').submit();"><?=_IN_PELLE?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="36")?' underline':''?>" onclick="$('#id_tipologia').val('36');$('#form_filtro').submit();"><?=_IN_SIMILCUOIO?></div>
	    <div class="cursor pl-15<?=($_GET['id_tipologia']=="118")?' underline':''?>" onclick="$('#id_tipologia').val('118');$('#form_filtro').submit();"><?=_IN_ALTRI_MATERIALI?></div>
    <?php endif;?>
    <!--b><?=_PREZZO?></b>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="p_0_100")?' underline':''?>"   onclick="$('#id_tipologia').val('p_0_100');  $('#form_filtro').submit();">0 - 100 &euro;</div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="p_100_200")?' underline':''?>" onclick="$('#id_tipologia').val('p_100_200');$('#form_filtro').submit();">100 - 200 &euro;</div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="p_200_500")?' underline':''?>" onclick="$('#id_tipologia').val('p_200_500');$('#form_filtro').submit();">200 - 500 &euro;</div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="p_500_1000")?' underline':''?>" onclick="$('#id_tipologia').val('p_500_1000');$('#form_filtro').submit();">500 - 1000 &euro;</div>
    <div class="cursor pl-15<?=($_GET['id_tipologia']=="p_1000_")?' underline':''?>"   onclick="$('#id_tipologia').val('p_1000_');  $('#form_filtro').submit();"><?=_OLTRE?> 1000 &euro;</div-->
</form>
<style type="text/css">
	#form_filtro .cursor:hover, #form_ordinamento .cursor:hover{ color: #840025; }
</style>