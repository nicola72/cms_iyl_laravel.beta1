<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Ordine n° {{$order->id}}</title>
</head>

<body>
<div>
    Buongiorno,<br><br>
    hai appena ricevuto un ordine dal sito web di Chess Store.<br>
    Qui di seguito i dettagli di tale ordine:<br><br>

</div>
<table style="border-collapse:collapse;" width="100%" style="max-width:600px;margin-left:auto;margin-right:auto;border:1px solid #ddd;margin-top:20px;padding:20px;margin-bottom:20px" cellpadding="2" cellspacing="2">
    <tr>
        <th style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.prodotto')</th>
        <th style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.codice')</th>
        <th style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.qta')</th>
        <th style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.totale')</th>
    </tr>
    @foreach($order->orderDetails as $item)
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">{{ $item->nome_prodotto }}</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">{{ $item->codice }}</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">{{ $item->qta }}</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($item->prezzo)</td>
        </tr>
    @endforeach
</table>
<br><br>
<p style="font-weight:bold;">@lang('msg.dettaglio_costi')</p>
<table style="border-collapse:collapse;">
    @if($order->sconto_iva != '0.00' && $order->sconto_iva != '')
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">Total amount</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->importo)</td>
        </tr>
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">Tax refund</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->sconto_iva)</td>
        </tr>
    @else
        <tr><td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.imponibile')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->imponibile)</td>
        </tr>
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.iva')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->iva)</td>
        </tr>
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.importo_carrello')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->importo)</td>
        </tr>
    @endif
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.spese_spedizione')</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->spese_spedizione)</td>
    </tr>
    @if($order->sconto != '0.00' && $order->sconto != '')
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.sconto')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->sconto)</td>
        </tr>
    @endif
    @if($order->spese_pagamento != '0.00' && $order->spese_pagamento != '')
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.spese_contrassegno')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->spese_contrassegno)</td>
        </tr>
    @endif
    @if($order->spese_conf_regalo != '0.00' && $order->spese_conf_regalo != '')
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.spese_confezione_regalo')</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">@money($order->spese_conf_regalo)</td>
        </tr>
    @endif
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.totale')</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">
            @money($order->importo + $order->spese_spedizione + $order->spese_conf_regalo + $order->sepse_scontrassegno - $order->sconto - $order->sconto_iva)
        </td>
    </tr>
</table>
<br><p style="font-weight:bold;">@lang('msg.dettagli_per_la_spedizione')</p>
<table style="border-collapse:collapse;">
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.nome'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->nome}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.cognome'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->cognome}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">Email:</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->email}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.telefono'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->telefono}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.indirizzo_di_consegna'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->indirizzo}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.cap'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->cap}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.citta'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->citta}}</td>
    </tr>
    @if(app()->getLocale() == 'it')
        <tr>
            <td style="border:solid 1px #c0c0c0;padding:5px;">Provincia:</td>
            <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->provincia}}</td>
        </tr>
    @endif
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.nazione'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->orderShipping->nazione}}</td>
    </tr>
</table>
<br><br>
<p style="font-weight:bold;">@lang('msg.dettagli_personali')</p>
<table style="border-collapse:collapse;">
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.data_nascita'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->data_nascita->format('d-m-Y')}}</td>
    </tr>
    <tr>
        <td style="border:solid 1px #c0c0c0;padding:5px;">@lang('msg.luogo_nascita'):</td>
        <td style="border:solid 1px #c0c0c0;padding:5px;">{{$order->luogo_nascita}}</td>
    </tr>
</table>
<br><br>
Cordiali Saluti<br><br>Lo Staff di Chess Store
</body>
</html>
