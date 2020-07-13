<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@lang('msg.recupera_password')</title>
</head>

<body>
@if(app()->getLocale() == 'it')
    Gentile {{$user->name}} {{$user->surname}},
    <br><br>
    a seguito della sua richiesta le ricordiamo che la password per accedere alla sua area privata del sito Chess Store &egrave; <b>{{$clear_pwd}}</b><br><br>
    Cordiali Saluti
    <br><br>
    Lo staff di Chess-Store.it
@else
    Dear {{$user->name}} {{$user->surname}},
    following your request we remind you that the password to login into your private area of the site Chess Store is <b>{{$clear_pwd}}</b><br><br>
    Best Regards
    <br><br>
    Chess-Store.org
@endif
</body>
</html>
