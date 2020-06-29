<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="robots" content="noindex" />
        <title>Chess Store</title>
        <link href="https://www.inyourlifetest.com/assets/css/pdf.css" rel="stylesheet">
        <style>



        </style>
    </head>
    <body>
    <table id="tb_wrapper" style="" cellpadding="2" cellspacing="2">
        <tr>
            <td style="text-align: center">
                <img src="https://www.chess-store.it/_ext/img/logo/scacchi_online_1.jpg" alt="" />
            </td>
        </tr>
        <tr>
            <th id="testata">
                <h3 style="margin-bottom: 30px">Ordine n° {{$order->id}} del {{$order->created_at->format('d/m/Y')}}</h3>
            </th>
        </tr>

        <tr>
            <td>
                <table width="100%" cellpadding="2" cellspacing="0" style="font-size: 12px;">
                    <tr>
                        <th>Codice</th>
                        <th>Nome</th>
                        <th>Q.tà</th>
                        <th>Prezzo</th>
                        <th>Totale</th>
                    </tr>
                    @foreach($order->orderDetails as $item)
                        <tr>
                            <td style="border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                {{$item->codice}}
                            </td>
                            <td style="border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                {{$item->nome_prodotto}}
                            </td>
                            <td style="border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                {{$item->qta}}
                            </td>
                            <td style="border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                @money($item->prezzo)
                            </td>
                            <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                @money($item->totale)
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr style="text-align:right">
            <td style="text-align:right">
                <table style="margin-bottom:20px;" cellpadding="2" cellspacing="2">
                    <tr>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>Sconto:</h4>
                        </td>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>@money($order->sconto)</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>Imponibile:</h4>
                        </td>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>@money($order->imponibile)</h4>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>Iva:</h4>
                        </td>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>@money($order->iva)</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>Sconto IVA</h4>
                        </td>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h4>@money($order->sconto_iva)</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h3>Totale:</h3>
                        </td>
                        <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                            <h3>@money($order->importo)</h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr style="clear: both">
            <td>
                <table cellpadding="2" cellspacing="2" style="font-size:12px;">
                    <tr>
                        <td><b>Spese spedizione</b>: @money($order->spese_spedizione)</td>
                    </tr>
                    <tr>
                        <td><b>Spese conf.regalo</b>: @money($order->spese_conf_regalo)</td>
                    </tr>
                    <tr>
                        <td><b>Spese pagamento</b>: @money($order->spese_contrassegno)</td>
                    </tr>
                    <tr>
                        <td><b>Sconto</b>: @money($order->sconto)<br></td>
                    </tr>
                    <tr>
                        <td><b>Modalità pagamento</b>: {{$order->modalita_pagamento}}</td>
                    </tr>
                    <tr>
                        <td><b>Pagato</b>: {{($order->stato_pagamento == 1) ? 'si':'no'}}</td>
                    </tr>
                    <tr>
                        <td><b>Nr Trans.</b>: {{$order->idtranspag}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @if($order->user_id != '')
        <tr>
            <td>
                <table width="100%" cellpadding="2" cellspacing="2">
                    <tr>
                        <td>
                            <h4>DETTAGLI CLIENTE:</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellpadding="2" cellspacing="2">
                                <tr>
                                    <td>Nome:</td>
                                    <td>{{$order->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{$order->user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Data di nascita:</td>
                                    <td>{{$order->data_nascita}}</td>
                                </tr>
                                <tr>
                                    <td>Luogo di nascita</td>
                                    <td>{{$order->luogo_nascita}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @endif
        <tr>
            <td>
                <table width="100%" cellspacing="2" cellpadding="2">
                    <tr>
                        <th>Indirizzo Spedizione</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{$order->orderShipping->nome}}</td>
                    </tr>
                    <tr>
                        <td>Cognome:</td>
                        <td>{{$order->orderShipping->cognome}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$order->orderShipping->email}}</td>
                    </tr>
                    <tr>
                        <td>Telefono:</td>
                        <td>{{$order->orderShipping->telefono}}</td>
                    </tr>
                    <tr>
                        <td>Indirizzo:</td>
                        <td>{{$order->orderShipping->indirizzo}}</td>
                    </tr>
                    <tr>
                        <td>Cap:</td>
                        <td>{{$order->orderShipping->cap}}</td>
                    </tr>
                    <tr>
                        <td>Città:</td>
                        <td>{{$order->orderShipping->citta}}</td>
                    </tr>
                    <tr>
                        <td>Provincia:</td>
                        <td>{{$order->orderShipping->provincia}}</td>
                    </tr>
                    <tr>
                        <td>Nazione:</td>
                        <td>{{$order->orderShipping->nazione}}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

    </body>
</html>
