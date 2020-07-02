<?php
$urlAction = self::_ROOT . "_ext/mail_form/invio_email.php";
?>
<p class="messaggioattesa" style="text-align: center;">
    <img src="<?php echo self::_ROOT ?>_ext/img/loading.gif">
</p>
<div id="messaggio_ri" style="padding-top: 10px;"></div>


<form class="" action="#" id="formcontatti" method="post" data-type="contact">
    <div class="row">
        <input id="lang" name="lang" type="hidden"	value="<?php echo $this->lang ?>" />

        <div class="form-group col-sm-12">
            <input type="text" class="form-control" id="nome" name="nome"
                   value="<?php echo $_SESSION['nome']; ?>"
                   placeholder="<?php echo _NOME ?>" >

        </div>



        <div class="form-group col-sm-12">
            <input type="text" class="form-control" id="email" name="email"
                   value="<?php echo $_SESSION['email']; ?>" placeholder="E-mail*"
                   />

        </div>



        <div class="form-group col-sm-12">
            <textarea class="form-control" id="messaggio" name="messaggio"
                      rows="5" placeholder="<?php echo _MESSAGGIO ?>"><?php echo $_SESSION['messaggio']; ?></textarea>

        </div>


        <!-- per il CAPTCHA -->
        <div class="form-group col-sm-12">
            <div>
                <img style="float: left; width: 165px;" alt="CAPTCHA Image"
                     id="captcha"
                     src="<?php echo self::_ROOT ?>_ext/mail_form/securimage/securimage_show.php" />

                <a style="float: left; display: block; padding-left: 4px;" href="#"
                   onclick="document.getElementById('captcha').src = '<?php echo self::_ROOT ?>_ext/mail_form/securimage/securimage_show.php?' + Math.random(); return false">
                    <img style="height: 28px;"
                         src="<?php echo self::_ROOT ?>_ext/mail_form/img/refresh.png">
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="form-group col-sm-12" style="margin-bottom:10px;">

            <input maxlength="6" class="form-control" name="captcha_code"
                   id="captcha_code" 
                   placeholder="<?php echo _RISULTATOIMMAGINE ?>" type="text" />
            <div id="messaggio_errore" style="padding-top: 10px;"></div>

        </div>
        <!-- fine CAPTCHA -->

        <!-- privacy -->
        <div class="form-group col-sm-12" style="margin-bottom:0px;">
            <p style="width: 100%;font-size: 12px;text-align:left;">
                Privacy* <?php echo _CONSENSO ?> 
                <input name="privacy" type="checkbox" id="privacy" value="Privacy"
                       required />&nbsp;&nbsp; <br>
                <a href="#" 
                   onclick="window.open('/informativa_<?php echo $this->lang ?>.htm', 'informativa', 'scrollbars=yes,width=550,height=650');"><?php echo _INFORMATIVA ?> </a>
            </p>
        </div>
        <!-- fine privacy -->

        <div class="form-group col-sm-12">
            <button id="submit_btn" type="submit"
                    class="btn btn-default"><?php echo _INVIA ?></button>
            <span style="padding-top: 10px;font-size: 12px;display: block;">* <?php echo _OBBLIGATORIO ?></span>
        </div>
    </div>
</form>

<script src="<?php echo self::_ROOT ?>_ext/js/jquery.validate.js"></script>
<script src="<?php echo self::_ROOT ?>_ext/js/additional-methods.js"></script>


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
                       /*
                        * per il datepicker in lingua segui esempio qui sotto, cerca su internet i vari settaggi
                        */
                       /*
                        $(function(){
                        $('.datepicker').datepicker({'dateFormat':'dd-mm-yy', 'prevText':'', 'nextText':''});
                        
                        });
                        
                        $.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
                        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
                        prevText: '&lt;Préc', prevStatus: 'Voir le mois précédent',
                        nextText: 'Suiv&gt;', nextStatus: 'Voir le mois suivant',
                        currentText: 'Courant', currentStatus: 'Voir le mois courant',
                        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
                        'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
                        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
                        'Jul','Aoû','Sep','Oct','Nov','Déc'],
                        monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
                        weekHeader: 'Sm', weekStatus: '',
                        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
                        dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
                        dateFormat: 'dd/mm/yy', firstDay: 0, 
                        initStatus: 'Choisir la date', isRTL: false};
                        $.datepicker.setDefaults($.datepicker.regional['fr']);*/

                       $.validator.addMethod("valueNotEquals", function (value, element, arg) {
                           return arg != value;
                       }, "Value must not equal arg.");

                       $("#formcontatti").validate({
                           ignore: [],
                           event: 'blur',
                           rules: {
                               nome: {required: false},
                               email: {required: true, email: true},
                               messaggio: {required: false},
                               captcha_code: {required: true},
                               privacy: {required: true},
                           },
                           messages: {
                               nome: {required: "<?php echo _WARN_1 ?>"},
                               email: {required: "<?php echo _WARN_1 ?>", email: "<?php echo _WARN_2 ?>"},
                               messaggio: {required: "<?php echo _WARN_1 ?>"},
                               captcha_code: {required: "<?php echo _WARN_1 ?>"},
                               privacy: {required: "<?php echo _WARN_1 ?>"}
                           },
                           submitHandler: function (form)
                           {
                               $.ajax({
                                   type: "POST",
                                   url: "<?php echo $urlAction ?>",
                                   data: $('#formcontatti').serialize(),
                                   dataType: "html",
                                   beforeSend: function () {
                                       $("#formcontatti1").hide();
                                       $(".messaggioattesa").show();
                                   },
                                   success: function (msg)
                                   {
                                       if (msg.search("errore") != -1)
                                       {
                                           $(".messaggioattesa").hide();
                                           $("#contattaci").hide();
                                           $("#messaggio_errore").empty();
                                           $("#messaggio_errore").html(msg);
                                           $("#messaggio_errore").fadeIn("slow");
                                       } else
                                       {
                                           console.log('ready ga formcontatti');
                                           ga("send", "event", "formcontatti", "submit");
                                           console.log('sent ga formcontatti');
                                           var msgnew = msg.replace("errore,", "");
                                           $(".messaggioattesa").fadeOut("slow");
                                           $("#messaggio_ri").empty();
                                           $("#messaggio_ri").html(msgnew);
                                           $("#messaggio_ri").fadeIn();
                                           $("#formcontatti").hide();
                                       }
                                   },
                                   error: function ()
                                   {
                                       $("#messaggio_errore").empty();
                                       $("#messaggio_errore").html("<?php echo _WARN_3 ?>");
                                       $("#messaggio_errore").fadeIn();
                                       $("#formcontatti").fadeIn();
                                   },
                               });
                           },
                           invalidHandler: function (form)
                           {
                               //alert("errore");
                               //$(".messaggioerr").empty();
                               //$(".messaggioerr").html("<div style='border:2px solid red;padding:5px;margin-bottom:10px;color:red;'><i>Ricorda:</i> E' obbligatorio compilare i campi nelle lingue presenti</div>");
                           }
                       });
</script>
