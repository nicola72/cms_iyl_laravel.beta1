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
                    @if($order->modalita_pagamento == "paypal")
                        <div class="conferma_order">
                            Gentile
                            <b>
                                {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                            </b>,
                            <br><br>
                            ti confermiamo la corretta ricezione del pagamento. Provvederemo ad evadere il
                            tuo ordine al più presto<br><br>
                            Cordiali Saluti<br><br>
                        </div>
                    @elseif($order->modalita_pagamento == "bonifico")
                        <div class="conferma_order">
                            Gentile
                            <b>
                                {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                            </b>,
                            <br><br>
                            ti confermiamo la corretta ricezione del tuo ordine. Provvederemo ad evadere il
                            tuo ordine dopo aver ricevuto il bonifico.<br><br>
                            Intestatario: MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
                            Banca: BANCA INTESA SAN PAOLO<br>
                            IBAN: IT37A0306937761100000000268<br>
                            SWIFT: BCITITMM<br><br>
                            Cordiali Saluti<br><br>
                        </div>
                    @else
                        <div class="conferma_order">
                            Gentile
                            <b>
                                {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                            </b>,
                            <br><br>
                            ti confermiamo la corretta ricezione del tuo ordine. Provvederemo ad evadere il
                            tuo ordine nel più breve tempo possibile.<br><br>
                            Cordiali Saluti<br><br>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_script')

@stop