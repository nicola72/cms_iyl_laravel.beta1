<form id="newsletter_form" method="post" action="{{url(app()->getLocale().'/add_to_newsletter')}}" >
    <div class="input-group">
        {{ csrf_field() }}
        <input name="news_email" id="news_email" type="text" class="form-control"	placeholder="inserisci la tua email" aria-describedby="basic-addon2">
        <a href="javascript:void(0)" class="input-group-addon" id="basic-addon2" onclick="$('#newsletter_form').submit();">
            @lang('msg.invia') <i class="fa fa-arrow-circle-right"></i>
        </a>

    </div>
</form>