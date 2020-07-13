<div id="form_registrazione_container">
    <form class="" action="#" id="{{$form_registrazione}}" method="post" data-type="contact">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="nome" >@lang('msg.nome')*</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" />
        </div>

        <div class="form-group">
            <label for="cognome" >@lang('msg.cognome')*</label>
            <input type="text" class="form-control" id="cognome" name="cognome" value="{{old('cognome')}}"  />
        </div>

        <div class="form-group">
            <label for="email" >Email*</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"/>
        </div>

        <div class="form-group">
            <label for="password" >Password*</label>
            <input type="password" class="form-control" id="reg_password" name="reg_password" value="" />
        </div>

        <div class="form-group">
            <label for="password" >@lang('msg.ridigita_password')*</label>
            <input type="password" class="form-control" id="password2" name="password2" value="" />
        </div>

        <div class="form-group">
            <label for="nascita" >@lang('msg.data_nascita')*</label>
            <input type="text" class="form-control datepicker" id="data_nascita" name="data_nascita" value="{{old('data_nascita')}}" />
        </div>

        <div class="form-group">
            <label for="luogo_nascita" >@lang('msg.luogo_nascita')*</label>
            <input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" value="{{old('luogo_nascita')}}" />
        </div>

        <!-- per il CAPTCHA -->
        <div class="form-group col-sm-12">
            <div>
                <div class="g-recaptcha" data-sitekey="{{$website_config['recaptcha_key']}}"></div>
            </div>
        </div>
        <!-- fine CAPTCHA -->

        <div class="form-group">
            <p style="width: 100%;color:#000;font-size: 12px;text-align:left;">
                Privacy* @lang('msg.consenso')
                <input name="privacy" type="checkbox" id="privacy" value="Privacy" required />&nbsp;&nbsp; <br>
                <a style="color:#000" href="{{$pages->where('nome','informativa')->first()->url()}}" >
                    @lang('msg.leggi_informativa')
                </a>
            </p>
        </div>

        <div class="form-group col-sm-12">
            <div id="{{$form_registrazione}}-errore" class="error" style="display: none"></div>
        </div>

        <div class="form-group col-sm-12">
            <button id="submit_btn" type="submit" class="btn btn-default">@lang('msg.invia')</button>
            <span style="padding-top: 10px;font-size: 12px;display: block;">* @lang('msg.obbligatorio')</span>
        </div>
    </form>

</div>
@section('js_script_form2')

    <!-- DATEPICKER -->
    @if(app()->getLocale() == 'it')
        <script src="/assets/js/il18n-datepicker-it.js"></script>
        <script>
            $(document).ready(function () {
                var d = new Date();
                var final_dp_date = d.getFullYear();
                $('.datepicker').datepicker({
                    dateFormat: "dd/mm/yy",
                    yearRange: "1920:" + final_dp_date + "",
                    changeYear: true,
                    regional: "it"
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function () {
                var d = new Date();
                var final_dp_date = d.getFullYear();
                $('.datepicker').datepicker({
                    dateFormat: "dd/mm/yy",
                    yearRange: "1920:" + final_dp_date + "",
                    changeYear: true,

                });
            });
        </script>
    @endif
    <!-- FINE DATEPICKER -->

    <script src='https://www.google.com/recaptcha/api.js?hl={{app()->getLocale()}}'></script>
    <script>
        $(document).ready(function() {
            $("#{{$form_registrazione}}").validate({
                rules: {
                    nome:{ required: true },
                    cognome:{ required: true},
                    data_nascita:{ required: true},
                    luogo_nascita:{ required: true},
                    privacy:{ required: true},
                    reg_password:{ required:true, minlength: 4, maxlength:8},
                    password2:{ equalTo: "#reg_password"},
                    email:{ required: true,email:true},
                },
                messages: {
                    nome: {required: "@lang('msg.obbligatorio')"},
                    cognome:{ required: "@lang('msg.obbligatorio')" },
                    data_nascita:{ required: "@lang('msg.obbligatorio')"},
                    luogo_nascita:{ required: "@lang('msg.obbligatorio')"},
                    privacy:{ required: "@lang('msg.obbligatorio')" },
                    reg_password:{ required: "@lang('msg.obbligatorio')",minlength:"@lang('msg.deve_essere_min_5_e_max_8_caratteri')", maxlength:"@lang('msg.deve_essere_compresa_fra_3_e_8_caratteri')"},
                    password2:{ equalTo: "@lang('msg.la_password_deve_essere_uguale')"},
                    email:{ required: "@lang('msg.obbligatorio')",email:"@lang('msg.inserisci_email_valida')" },
                },
                submitHandler: function(form)
                {
                    $.ajax({
                        type: "POST",
                        data: $('#{{ $form_registrazione }}').serialize(),
                        url: "{{url(app()->getLocale().'/register')}}",
                        dataType: "json",

                        success: function(data)
                        {
                            if (data.result === 1)
                            {
                                $(".form-preloader").hide();
                                alert(data.msg);
                                location.reload();
                            } else
                            {
                                $(".form-preloader").hide();
                                alert(data.msg);
                                location.reload();

                            }
                        },
                        error: function()
                        {
                            $(".form-preloader").hide();
                            $("#{{ $form_registrazione }}-errore").html("@lang('msg.errore')");
                            $("#{{ $form_registrazione }}-errore").fadeIn();
                            $("#{{ $form_registrazione }}").fadeIn();
                        },
                    });
                },
            });
        });
    </script>
@stop