<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="robots" content="noindex" />
    <title>Chess Store</title>
    @section('styles')

        <link href="{{ mix('/cms_assets/css/all.css') }}" rel="stylesheet">
        <link href="{{ mix('/cms_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    @show
</head>
<body onload="window.print()" style="background-color: #fff;">
<div class="container">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content ">
                <div class="row border-bottom" style="padding-top:30px;padding-bottom:30px;">
                    <div class="col-md-12">
                        <h3>Ordine n° {{$order->id}} del {{$order->created_at->format('d/m/Y')}}</h3>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4">
                        <b>Spese spedizione</b>: @money($order->spese_spedizione)<br>
                    </div>
                    <div class="col-md-4">
                        <b>Spese conf.regalo</b>: @money($order->spese_conf_regalo)<br>
                    </div>
                    <div class="col-md-4">
                        <b>Spese pagamento</b>: @money($order->spese_contrassegno)<br>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <b>Sconto</b>: @money($order->sconto)<br>
                    </div>
                </div>
                <div class="row mb-2">

                    <div class="col-md-4">
                        <b>Modalità pagamento</b>: {{$order->modalita_pagamento}}<br>
                    </div>
                    <div class="col-md-4">
                        <b>Pagato</b>: {{($order->stato_pagamento == 1) ? 'si':'no'}}<br>
                    </div>
                    <div class="col-md-4">
                        <b>Nr Trans.</b>: {{$order->idtranspag}}<br>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <b>Data di nascita</b>: {{$order->data_nascita}}<br>
                    </div>
                    <div class="col-md-4">
                        <b>Luogo di nascitta</b>: {{$order->luogo_nascita}}<br>
                    </div>
                </div>
                <div class="row mb-2">

                    <div class="col-md-4">
                        <b>Imponibile</b>: @money($order->imponibile)<br>
                    </div>
                    <div class="col-md-4">
                        <b>Iva</b>: @money($order->iva)<br>
                    </div>
                    <div class="col-md-4">
                        <b>Sconto Iva</b>: @money($order->sconto_iva)<br>
                    </div>
                </div>
                <div class="row mb-4 border-bottom">
                    <div class="col-md-12 text-right">
                        <h4>Importo: @money($order->importo)</h4>
                        <h4>TOTALE: @money($order->importo + $order->spese_spedizione + $order->spese_conf_regalo + $order->spese_contrassegno - $order->sconto - $order->sconto_iva)</h4>
                    </div>
                </div>

                <div class="row mb-4 border-bottom">
                    <div class="col-md-12">
                        <h4>Indirizzo di spedizione</h4>
                    </div>
                    <div class="col-md-4">
                        <b>Nome</b>: {{$order->orderShipping->nome}}
                    </div>
                    <div class="col-md-4">
                        <b>Cognome</b>: {{$order->orderShipping->cognome}}
                    </div>
                    <div class="col-md-4">
                        <b>Email</b>: {{$order->orderShipping->email}}
                    </div>
                    <div class="col-md-4">
                        <b>Tel.</b>: {{$order->orderShipping->telefono}}
                    </div>
                    <div class="col-md-4">
                        <b>Indirizzo</b>: {{$order->orderShipping->indirizzo}}
                    </div>
                    <div class="col-md-4">
                        <b>Cap</b>: {{$order->orderShipping->cap}}
                    </div>
                    <div class="col-md-4">
                        <b>Città</b>:{{$order->orderShipping->citta}}
                    </div>
                    <div class="col-md-4">
                        <b>Provincia</b>:{{$order->orderShipping->provincia}}
                    </div>
                    <div class="col-md-4">
                        <b>Nazione</b>:{{$order->orderShipping->nazione}}
                    </div>
                </div>

                @foreach($order->orderDetails as $detail)
                    <div class="row mb-4 border-bottom">
                        <div class="col-md-12">
                            <h4>Prodotti ordinati</h4>
                        </div>
                        <div class="col-md-1">
                            <b>Q.tà</b>:{{$detail->qta}}
                        </div>
                        <div class="col-md-5">

                            <b>Codice</b>:{{$detail->codice}}
                            {{$detail->nome_prodotto}}

                        </div>
                        <div class="col-md-3">
                            <b>Prezzo</b>: @money($detail->prezzo)
                        </div>
                        <div class="col-md-3 text-right">
                            <b>Totale</b>: @money($detail->totale)
                        </div>
                    </div>
                @endforeach

                @if($order->user_id != '')
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Cliente</h4>
                        </div>
                        <div class="col-md-4">
                            <b>Nome</b>: {{$order->user->name}}
                        </div>
                        <div class="col-md-4">
                            <b>Cognome</b>: {{$order->user->surname}}
                        </div>
                        <div class="col-md-4">
                            <b>Email</b>: {{$order->user->email}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
