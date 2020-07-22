@extends('layouts.website')
@section('content')
    <section class="lightSection clearfix pageHeader">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="page-title">
                        <h2 class="fjalla">@lang('msg.carrello')</h2>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @if(count($carts) == 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p style="padding:40px 0;font-size:140%;">@lang('msg.nessun_prodotto_nel_carrello')</p>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row" style="margin-top:10px;">
            <div class="pull-right">
                <a href="/" class="fjalla btn btn-default">@lang('msg.continua_gli_acquisti')</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br />

                <!-- ELENCO PRODOTTI NEL CARRELLO -->
                <table id="carrello_tbl" class="table">
                    <tr>
                        <th>&nbsp;</th>
                        <th>@lang('msg.codice')</th>
                        <th class="hidden-xs">@lang('msg.prodotto')</th>
                        <th>@lang('msg.qta')</th>
                        <th>@lang('msg.totale')</th>
                        <th>@lang('msg.elimina')</th>
                    </tr>
                    @foreach($carts as $cart)
                    <tr>
                        <td>
                            <a href="{{ $website_config['cs_big_dir'].$cart->product->cover() }}" class="item-img galleria-item">
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
                            <input type="text" name="qta" value="{{ $cart->qta }}" class="center" data-idrow="{{ $cart->id }}" style="width:30px;">
                            <a href="javascript:void(0);" onclick="cartUpdateQta( '{{ url(app()->getLocale().'/cart/update') }}' , {{$cart->id}} );">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </td>
                        <td>
                            @money($cart->product->prezzo_vendita() * $cart->qta)
                        </td>
                        <td>
                            <a href="{{ url(app()->getLocale().'/cart/destroy',$cart->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <!-- FINE PRODOTTI CARRELLO -->

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">

                <!-- RISCATTO COUPON se non è già presente nella sessione -->
                @if(!session()->has('coupon'))
                <div class="row">
                    <div class="col-md-5" style="line-height: 40px;font-size:120%; font-weight:bold;">@lang('msg.hai_un_coupon_sconto')</div>
                    <div class="col-md-4" style="line-height: 40px;">
                        <input class="form-control" type="text" name="coupon" id="coupon" style="margin:3px 15px 0 15px;">
                    </div>
                    <div class="col-md-3" style="line-height: 40px;">
                        <a class="fjalla btn btn-default" style="" href="javascript:void(0);" onclick="couponRedeem('{{url(app()->getLocale().'/cart/redeem_coupon')}}');">
                            @lang('msg.riscattalo_ora')
                        </a>
                    </div>
                </div>
                @endif
                <!-- FINE RISCATTO COUPON -->

            </div>

        </div>
        <br />
        <!-- Se il carrello supera il massimo peso -->
        @if($peso_carrello > 1000)
            <div class="row">
                <div class="col-md-12">
                    <div class="order-failed">@lang('msg.troppo_peso_per_procedere') <a href="mailto:customerservice@chess-store.it" style="color:#840025;">Customer Service</a></div>
                    <br><br>
                </div>
            </div>
        @else

            <!-- FORM DATI SPEDIZIONE -->
            <div class="row" style="padding-top:30px;">
                <div class="col-md-12">
                    <h3>@lang('msg.dettagli_per_spedizione_e_pagamento')</h3>
                    @include('website.form.form_carrello')
                </div>
            </div>
            <!-- FINE FORM DATI SPEDIZIONE -->

        @endif
        </div>
    @endif

@endsection
@section('js_script')

@stop
