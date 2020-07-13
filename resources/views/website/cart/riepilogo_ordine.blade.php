@extends('layouts.website')
@section('content')
    <section class="lightSection clearfix pageHeader">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="page-title">
                        <h2 class="fjalla">@lang('msg.riepilogo_ordine')</h2>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br />
                <table id="carrello_tbl" class="table">
                    <tr>
                        <th>&nbsp;</th>
                        <th>@lang('msg.codice')</th>
                        <th class="hidden-xs">@lang('msg.prodotto')</th>
                        <th>@lang('msg.qta')</th>
                        <th>@lang('msg.totale')</th>
                    </tr>
                    @foreach($carts as $cart)
                        <tr>
                            <td>
                                <a href="{{ $website_config['cs_big_dir'].$cart->product->cover() }}" class="item-img">
                                    <img src="{{ $website_config['cs_small_dir'].$cart->product->cover() }}" alt="" class="img-carrello" />
                                </a>
                            </td>
                            <td>
                                <a href="{{ $cart->product->url() }}">{{ $cart->product->codice }}</a>
                            </td>
                            <td class="hidden-xs">
                                <a href="{{ $cart->product->url() }}">{{ $cart->product->{'nome_'.app()->getLocale()} }}</a>
                            </td>
                            <td>
                                {{ $cart->product->qta }}
                            </td>
                            <td>
                                @money($cart->product->prezzo_vendita() * $cart->qta)
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <table id="resume_tbl" class="table">
                    <tr>
                        <td class="right">@lang('msg.totale_prodotti')</td>
                        <td class="text-right">@money($lordo)</td>
                    </tr>
                    @if($esente_iva)
                    <tr>
                        <td>@lang('msg.rimborso_iva')</td>
                        <td class="text-right">@money($sconto_iva)</td>
                    </tr>
                    @endif
                    <tr>
                        <td>@lang('msg.importo_carrello')</td>
                        <td class="text-right">@money($importo)</td>
                    </tr>
                    <tr>
                        <td>@lang('msg.spese_spedizione')</td>
                        <td class="text-right">@money($spese_spedizione)</td>
                    </tr>
                    @if($spese_conf_regalo != 0)
                    <tr>
                        <td>@lang('msg.conf_regalo')</td>
                        <td class="text-right">@money($spese_conf_regalo)</td>
                    </tr>
                    @endif
                    @if($sconto_coupon != 0)
                    <tr>
                        <td>@lang('msg.sconto_coupon')</td>
                        <td class="text-right">@money($sconto_coupon)</td>
                    </tr>
                    @endif
                    @if($tipo_pagamento == 'contrassegno')
                    <tr>
                        <td>Costo per pagamento in contrassegno</td>
                        <td class="text-right">@money($spese_pagamento)</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="font-weight:bold;font-size:120%">@lang('msg.totale')</td>
                        <td class="text-right" style="font-weight:bold;font-size:120%">@money($totale)</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-12">
                <div class="stripe"><p style="font-size:120%;font-weight:bold;">@lang('msg.dettagli_spedizione_pagamento')</p></div>
                <table id="resume_user_tbl" class="table">
                    <tr>
                        <td>@lang('msg.nome')</td>
                        <td>{{session('ordine')['nome']}}</td>

                    </tr>
                    <tr>
                        <td>@lang('msg.cognome')</td>
                        <td>{{session('ordine')['cognome']}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{session('ordine')['email']}}</td>
                    </tr>
                    <tr>
                        <td>@lang('msg.telefono')</td>
                        <td>{{session('ordine')['tel']}}</td>
                    </tr>
                    <tr>
                        <td>@lang('msg.indirizzo_di_consegna')</td>
                        <td>{{session('ordine')['indirizzo']}}</td>

                    </tr>
                    <tr>
                        <td>@lang('msg.cap')</td>
                        <td>{{session('ordine')['cap']}}</td>
                    </tr>
                    <tr>
                        <td>@lang('msg.citta')</td>
                        <td>{{session('ordine')['citta']}}</td>

                    </tr>
                    <tr>
                        @if($nazione->id == '101')
                            <td>Provincia</td>
                            <td>{{session('ordine')['prov']}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>@lang('msg.nazione')</td>
                        <td>{{$nazione->{'nome_'.app()->getLocale()} }}</td>
                    </tr>

                    <tr>
                        <td>@lang('msg.pagamento')</td>
                        <td>
                            @if(session('ordine')['tipo_pagamento'] == 'bonifico')
                                @lang('msg.bonifico')
                            @elseif(session('ordine')['tipo_pagamento'] == 'paypal')
                                @lang('msg.carta_di_credito')
                            @else
                                contrassegno
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>@lang('msg.data_nascita')</td>
                        <td>{{session('ordine')['data_nascita']}}</td>
                    </tr>

                    <tr>
                        <td>@lang('msg.luogo_nascita')</td>
                        <td>{{session('ordine')['citta_nascita']}}</td>
                    </tr>
                </table>
                <br />
                <br />

            </div>
            <div class="col-md-6">
                <a class="btn btn-default" href="{{url(app()->getLocale().'/cart')}}" style="margin-bottom:10px;">
                    @lang('msg.torna_al_carrello')
                </a>
            </div>
            <div class="col-md-6 text-right">
                <form id="checkoutForm" method="post" action="{{url(app()->getLocale().'/cart/submit')}}" >
                    {{ csrf_field() }}
                    <input type="hidden" name="lang" id="lang" value="{{app()->getLocale()}}" />
                    <input type="submit" class="btn btn-default" value="@lang('msg.procedi_col_pagamento')">
                </form>
            </div>
        </div>
        <br >
        <br>
    </div>

@endsection
@section('js_script')

@stop