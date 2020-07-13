@extends('layouts.website')
@section('content')
    <section class="lightSection clearfix pageHeader">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title">
                        <h2 class="fjalla">@lang('msg.conferma_ordine')</h2>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        @if(app()->getLocale() == 'it')
                            Spiacente...<br>
                            Il pagamento non è andato a buon fine!<br>
                            Non possiamo procedere con l'ordine.
                            <br>
                            <br>
                            <br>
                            <a class="testo-bottone btn btn-light btn-aggiungi pb-2 pt-2 pr-4 pl-4" href="/">Torna allo shop</a>
                        @else
                            Sorry ... <br>
                            Payment was not successful! <br>
                            We cannot proceed with the order.
                            <br>
                            <br>
                            <br>
                            <a class="testo-bottone btn btn-light btn-aggiungi pb-2 pt-2 pr-4 pl-4" href="/">Back to shop</a>
                        @endif
                    </h4>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_script')

@stop