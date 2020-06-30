<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="robots" content="noindex" />
    <title>Chess Store</title>
    <link href="https://www.italfama.it/assets/css/pdf.css" rel="stylesheet">
    <style>



    </style>
</head>
<body style="text-align: center;width:100%">
<div style="width:100%;padding:20px">
<table id="tb_wrapper" style="width:100%" cellpadding="2" cellspacing="2">
    <tr>
        <td style="text-align: center">
            <img src="https://www.italfama.it/img/logo.png" alt="" />
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <table style="margin-bottom:20px;width:100%" cellpadding="2" cellspacing="2">
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
                                    <h3>Totale:</h3>
                                </td>
                                <td style="text-align: right;border-bottom:1px solid #ddd;padding-bottom: 6px;padding-top: 6px;">
                                    <h3>@money($order->importo)</h3>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellpadding="2" cellspacing="2" style="font-size:12px;width:100%">
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </td>
    </tr>

</table>
</div>

</body>
</html>
