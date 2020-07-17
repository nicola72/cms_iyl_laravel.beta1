@extends('layouts.website_errors')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-content" style="padding:60px 0;padding-bottom:60px;min-height: 400px">
            Errore 404!<br>
            La pagina che cercavi non esiste.<br>
            <a href="{{url('/')}}">clicca qui per tornare alla homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection
