<form id="{{ $form_rec_password }}" action="" method="post" data-type="contact">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" id="email" />
    </div>
    <!-- per il CAPTCHA -->
    <div class="form-group col-sm-12">
        <div>
            <div class="g-recaptcha" data-sitekey="{{$website_config['recaptcha_key']}}"></div>
        </div>
    </div>
    <!-- fine CAPTCHA -->
    <div class="form-group">
        <button id="submit_btn" type="submit" class="btn btn-default" style="color:#fff; background-color:#000">@lang('msg.recupera_password')</button>
    </div>
    <div class="form-group">
        <div id="login_msg" style="color:red">

        </div>
    </div>
</form>
@section('js_script_form')
    <script src='https://www.google.com/recaptcha/api.js?hl={{app()->getLocale()}}'></script>
    <script>
        $(document).ready(function() {

            $("#{{ $form_rec_password }}").validate({
                rules: {
                    email:{ required: true },
                },
                messages: {
                    email:{ required: "@lang('msg.obbligatorio')" },
                },
                submitHandler: function(form)
                {

                    $.ajax({
                        type: "POST",
                        url: "{{url(app()->getLocale().'/retriew_password')}}",
                        data : $('#{{ $form_rec_password }}').serialize(),
                        dataType: "json",

                        success: function(data)
                        {
                            if (data.result === 1)
                            {
                                alert(data.msg)
                                location.assign(data.url);
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