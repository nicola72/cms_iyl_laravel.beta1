
<form action="" method="get" id="form_ordinamento" style="margin-top:10px;"><!-- /ordinamento.php 
    <input type="hidden" name="lang" id="lang" value="<?php echo $this->lang?>" />
    <?php if($this->lang == 'ita'):?>
    <input type="hidden" name="uri" id="uri" value="<?php echo $this->macroCategoria['url_it']?>" />
    <?php else:?>
    <input type="hidden" name="uri" id="uri" value="<?php echo $this->macroCategoria['url_en']?>" />
    <?php endif;?>
    -->
    <input type="hidden" name="categoria" id="categoria" value="<?php echo $_GET['categoria']?>" /> 
    <input type="hidden" name="sottocategoria" id="sottocategoria" value="<?php echo $_GET['sottocategoria']?>" />
    
    <?php if($site->is_abbinamento):?>
        <!--select name="ordine" id="ordine" onchange="$('#form_ordinamento').submit()">
            <option value="prezzo_comp|ASC" <?php if($_GET['order']=="prezzo_comp|ASC"){echo 'selected="selected"';}?>><?php echo _PREZZOBASSO?></option>
            <option value="prezzo_comp|DESC" <?php if($_GET['order']=="prezzo_comp|DESC"){echo 'selected="selected"';}?>><?php echo _PREZZOALTO?></option>
            <option value="titolo|ASC" <?php if($_GET['order']=="titolo|ASC"){echo 'selected="selected"';}?>><?php echo _NOME_A_Z?></option>
            <option value="titolo|DESC" <?php if($_GET['order']=="titolo|DESC"){echo 'selected="selected"';}?>><?php echo _NOME_Z_A?></option>
        </select-->
        <input type="hidden" id="ordine" name="order">
        <div class="cursor pl-15<?=($_GET['order']=="prezzo_comp|ASC")?' underline':''?>" 
             onclick="$('#ordine').val('prezzo_comp|ASC');$('#form_ordinamento').submit();">
            <?=_PREZZOBASSO?>
        </div>
        <div class="cursor pl-15<?=($_GET['order']=="prezzo_comp|DESC")?' underline':''?>" 
             onclick="$('#ordine').val('prezzo_comp|DESC');$('#form_ordinamento').submit();">
            <?=_PREZZOALTO?>
        </div>
        <div class="cursor pl-15<?=($_GET['order']=="titolo|ASC")?' underline':''?>" 
             onclick="$('#ordine').val('titolo|ASC');$('#form_ordinamento').submit();">
            <?=_NOME_A_Z?>
        </div>
    <?php else:?>
        <!--select name="ordine" id="ordine" onchange="$('#form_ordinamento').submit()">
            <option value="prezzo|ASC" <?php if($_GET['order']=="prezzo|ASC"){echo 'selected="selected"';}?>><?php echo _PREZZOBASSO?></option>
            <option value="prezzo|DESC" <?php if($_GET['order']=="prezzo|DESC"){echo 'selected="selected"';}?>><?php echo _PREZZOALTO?></option>
            <option value="codice|ASC" <?php if($_GET['order']=="codice|ASC"){echo 'selected="selected"';}?>><?php echo _NOME_A_Z?></option>
            <option value="codice|DESC" <?php if($_GET['order']=="codice|DESC"){echo 'selected="selected"';}?>><?php echo _NOME_Z_A?></option>
        </select-->
        <input type="hidden" id="ordine" name="order">
        <div class="cursor pl-15<?=($_GET['order']=="prezzo|ASC")?' underline':''?>" 
            onclick="$('#ordine').val('prezzo|ASC');$('#form_ordinamento').submit();">
            <?=_PREZZOBASSO?>
        </div>
        <?php if (  $this->page == 'categoria' and $_GET['sottocategoria'] != '89' ): ?>
            <div class="cursor pl-15<?=($_GET['order']=="prezzo|DESC")?' underline':''?>" 
                onclick="$('#ordine').val('prezzo|DESC');$('#form_ordinamento').submit();">
                <?=_PREZZOALTO?>
            </div>
        <?php endif;?>
        <div class="cursor pl-15<?=($_GET['order']=="codice|ASC")?' underline':''?>" 
            onclick="$('#ordine').val('codice|ASC');$('#form_ordinamento').submit();">
            <?=_CODE_A_Z?>
        </div>
    <?php endif;?>
</form>
<style type="text/css">.cursor{cursor: pointer;}.pl-15{padding-left: 15px;}.underline{text-decoration: underline;}</style>