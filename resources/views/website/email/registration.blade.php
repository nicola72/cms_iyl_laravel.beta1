<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@lang('msg.conferma_registrazione')</title>
</head>

<body>
    @if(app()->getLocale() == 'it')
        Gentile {{$user->name}} {{$user->surname}},
        <br><br>
        grazie per esserti iscritto al sito <a href='https://www.chess-store.it/'>www.chess-store.it</a>.<br><br>
        Le tue credenziali per accedere alla tua area privata sono:<br>
        Username: {{$user->email}}<br>
        Password: {{$clear_pwd}}<br>
        Cordiali Saluti
        <br><br>
        Lo staff di Chess-Store.it
    @else
        Dear {{$user->name}} {{$user->surname}},
        <br><br>thanks for registering at <a href='https://www.chess-store.org'>www.chess-store.org</a>.<br><br>
        Your credentials to login into your private area are:<br>
        Username: {{$user->email}}<br>
        Password: {{$clear_pwd}}<br>
        Best Regards
        <br><br>
        Chess-Store.org
    @endif
</body>
</html>
