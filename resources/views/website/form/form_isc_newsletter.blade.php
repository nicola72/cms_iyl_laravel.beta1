<form id="newsletter_form" method="post" action="{{url(app()->getLocale().'/add_to_newsletter')}}" >
    <div class="input-group">
        {{ csrf_field() }}
        <input name="news_email" id="news_email" type="text" class="form-control"	placeholder="inserisci la tua email" aria-describedby="basic-addon2">
        <a href="javascript:void(0)" class="input-group-addon" id="basic-addon2" onclick="$('#newsletter_form').submit();">
            @lang('msg.invia') <i class="fa fa-arrow-circle-right"></i>
        </a>

    </div>
    <p style="width: 100%;font-size: 12px;text-align:left;">
        Privacy* @lang('msg.consenso')
        <input name="privacy" type="checkbox" id="privacy" value="Privacy" required />&nbsp;&nbsp; <br>
        <a style="color:#000" href="{{$pages->where('nome','informativa')->first()->url()}}" target="_blank">
            @lang('msg.leggi_informativa')
        </a>
    </p>
</form>
@section('js_script_form')
    <script>
        $("#newsletter_form").validate({
            ignore: [],
            event: 'blur',
            rules: {
                news_email: {required: true, email: true},
                privacy: {required: true},
            },
            messages: {
                news_email: {required: "@lang('msg.obbligatorio')", email: "@lang('msg.inserisci_email_valida')"},
                privacy: {required: "@lang('msg.obbligatorio')"}
            },
        });
    </script>
@stop