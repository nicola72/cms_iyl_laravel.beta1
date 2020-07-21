<div id="form_registrazione_container">
    <form class="" action="#" id="{{$form_name}}" method="post" data-type="contact">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nome" >@lang('msg.nome')*</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{$user->name}}" />
        </div>

        <div class="form-group">
            <label for="cognome" >@lang('msg.cognome')*</label>
            <input type="text" class="form-control" id="cognome" name="cognome" value="{{$user->surname}}"  />
        </div>

        <div class="form-group">
            <label for="email" >Email*</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}"/>
        </div>

        @lang('msg.modifica_password')&nbsp;<input type="checkbox" id="mod_pwd" name="mod_pwd" value="1" onclick="$('#Other').toggle();" /><br><br>

        <div id="Other" style="display:none">
            <div class="form-group">
                <label for="password" >@lang('msg.vecchia_password')*</label>
                <input type="password" class="form-control" id="password" name="password" value="" />
            </div>

            <div class="form-group">
                <label for="password" >@lang('msg.nuova_password')*</label>
                <input type="password" class="form-control" id="nuova_password" name="nuova_password" value="" />
            </div>

            <div class="form-group">
                <label for="password" >@lang('msg.ridigita_password')*</label>
                <input type="password" class="form-control" id="nuova_password2" name="nuova_password2" value="" />
            </div>
        </div>

        <!-- per il CAPTCHA -->
        <div class="form-group col-sm-12">
            <div>
                <div class="g-recaptcha" data-sitekey="{{$website_config['recaptcha_key']}}"></div>
            </div>
        </div>
        <!-- fine CAPTCHA -->

        <div class="form-group">
            <button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000">@lang('msg.invia')</button>

        </div>
    </form>
</div>
@section('js_script_form')
    <script src='https://www.google.com/recaptcha/api.js?hl={{app()->getLocale()}}'></script>
    <script>
        $(document).ready(function() {

            $("#{{ $form_name }}").validate({
                rules: {
                    nome:{ required: true },
                    cognome:{ required: true},
                    email:{ required: true,email:true},
                    nuova_password2:{ equalTo: "#nuova_password"},
                },
                messages: {
                    nome:{ required: "@lang('msg.obbligatorio')" },
                    cognome:{ required: "@lang('msg.obbligatorio')" },
                    email:{ required: "@lang('msg.obbligatorio')" },
                    nuova_password2:{ equalTo: "@lang('msg.la_password_deve_essere_uguale')"},
                },
                submitHandler: function(form)
                {

                    $.ajax({
                        type: "POST",
                        url: "{{url(app()->getLocale().'/change_account')}}",
                        data : $('#{{ $form_name }}').serialize(),
                        dataType: "json",

                        success: function(data)
                        {
                            if (data.result === 1)
                            {
                                alert(data.msg)
                                location.reload();
                            }
                            else
                            {
                                alert(data.msg);
                                location.reload();
                            }

                        },
                        error: function(data)
                        {

                            if(data.status === 422)
                            {
                                $('#login_msg').html(data.responseJSON.message);
                            }
                            else
                            {
                                $('#login_msg').html('Errore');
                            }
                        },
                    });
                },

            });
        });
    </script>
@stop