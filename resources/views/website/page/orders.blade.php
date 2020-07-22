@extends('layouts.website')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="background-color:#e4e0dc;">
                <div class="row">
                    <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding-top:20px;padding-bottom: 20px;">
                        <!-- MENU' DESKTOP -->
                        @include('layouts.website_menu_desktop')
                        <!-- FINE MENU' DESKTOP -->
                    </div>
                    <div class="col-md-10" style="background-color: #fff">
                        <!-- TITOLO PAGINA -->
                        <div class="row header-page">
                            <div class="col-xs-6">
                                <div class="page-title">
                                    <h2 class="fjalla">@lang('msg.i_tuoi_ordini')</h2>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <ol class="breadcrumb pull-right">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="#" id="name_category">@lang('msg.i_tuoi_ordini')</a></li>
                                </ol>
                            </div>
                        </div>
                        <!-- FINE TITOLO PAGINA -->
                        <div class="row" style="padding-top:40px;padding-bottom:40px;min-height:500px;">
                            <div class="col-md-12">
                                @if(count($orders) > 0)
                                    @foreach($orders as $key=>$order)
                                        <div class="order-item">
                                            <span class="order-title">
                                                @lang('msg.ordine') n° {{$order->id}} - {{$order->created_at->format('d-m-Y')}}
                                            </span>
                                            <span class="pull-right">
							                    <a class="btn-xs btn-default" href="javascript:void(0)" onclick="$('#dettagli_{{$key}}').toggle();">
                                                    @lang('msg.dettagli')
                                                </a>
						                    </span>

                                            <div id="dettagli_{{$key}}" class="order-dettagli" style="display:none;">

                                                <table class="table" >
                                                    <tr>
                                                        <th style="width:40%;">@lang('msg.prodotto')</th>
                                                        <th style="width:20%;">@lang('msg.qta')</th>
                                                        <th style="width:20%;">@lang('msg.totale')</th>
                                                        <th style="width:20%;">&nbsp;</th>
                                                    </tr>
                                                    @foreach($order->orderDetails as $detail)
                                                        <tr>
                                                            <th>
                                                                <a href="{{$detail->product->url()}}">
                                                                    {{$detail->nome_prodotto}}
                                                                </a>
                                                            </th>
                                                            <th>{{$detail->qta}}</th>
                                                            <th>{{$detail->totale}}</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    @endforeach

                                                    <!-- RIASSUNTO TOTALI -->
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>@lang('msg.totale')</th>
                                                        <th>@money($order->importo)</th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>@lang('msg.spese_spedizione')</th>
                                                        <th>@money($order->spese_spedizione)</th>
                                                    </tr>
                                                    @if($order->spese_conf_regalo != '0.00' && $order->spese_conf_regalo != '')
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>@lang('msg.spese_confezione_regalo')</th>
                                                            <th>@money($order->spese_conf_regalo)</th>
                                                        </tr>
                                                    @endif

                                                    @if($order->spese_contrassegno != '0.00' && $order->spese_contrassegno != '')
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>@lang('msg.spese_contrassegno')</th>
                                                            <th>@money($order->spese_contrassegno)</th>
                                                        </tr>
                                                    @endif

                                                    @if($order->sconto != '0.00' && $order->sconto != '')
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>@lang('msg.sconto')</th>
                                                            <th>@money($order->sconto)</th>
                                                        </tr>
                                                    @endif

                                                <!--  -->
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="color:#840025;">
                                                            @lang('msg.totale_finale')
                                                        </th>
                                                        <th style="color:#840025;">
                                                            @money($order->importo - $order->sconto + $order->spese_spedizione + $order->spese_conf_regalo + $order->spese_contrassegno)
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:10px;">
                                        @lang('msg.nessun_ordine')
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('js_script')
@stop
