@extends('layouts.website')
@section('content')
    <section class="clearfix">
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
            <div class="row" style="min-height:500px;padding-top:30px;padding-bottom:30px;">
                <div class="col-md-12">
                    @if($order->modalita_pagamento == "paypal")
                        <div>
                            @if(app()->getLocale() == 'it')
                                Gentile
                                <b>
                                    {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                                </b>,
                                <br><br>
                                ti confermiamo la corretta ricezione del pagamento. Provvederemo ad evadere il
                                tuo ordine al più presto<br><br>
                                Cordiali Saluti<br><br>
                            @else
                                Dear
                                <b>
                                    {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                                </b>,
                                <br><br>
                                we are pleased to confirm you that we have correctly received your payment.
                                We will dispatch your order as sooon as possible.<br><br>
                                Best Regards<br><br>
                            @endif
                        </div>
                    @elseif($order->modalita_pagamento == "bonifico")
                        <div>
                            @if(app()->getLocale() == 'it')
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
                            @else
                                Dear
                                <b>
                                    {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                                </b>,
                                <br><br>
                                We confirm correct receipt of your order. We will process your order after receiving the transfer.<br><br>
                                Accountholder: MARSILI'S COMPANY snc  (via Borgo S. Iacopo 23/r, 50125 Firenze)<br>
                                Bank: BANCA INTESA SAN PAOLO<br>
                                IBAN: IT37A0306937761100000000268<br>
                                SWIFT: BCITITMM<br><br>
                                Best Regards<br><br>
                            @endif
                        </div>
                    @else
                        <div>
                            @if(app()->getLocale() == 'it')
                                Gentile
                                <b>
                                    {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                                </b>,
                                <br><br>
                                ti confermiamo la corretta ricezione del tuo ordine. Provvederemo ad evadere il
                                tuo ordine nel più breve tempo possibile.<br><br>
                                Cordiali Saluti<br><br>
                            @else
                                Dear
                                <b>
                                    {{$order->orderShipping->nome}} {{$order->orderShipping->cognome}}
                                </b>,
                                <br><br>
                                we are pleased to confirm you that we have correctly received your payment.
                                We will dispatch your order as sooon as possible.<br><br>
                                Best Regards<br><br>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js_script')

@stop