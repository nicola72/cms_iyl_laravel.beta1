@extends('layouts.website')
@section('content')
    <div class="col-md-12" style="background-color:#e4e0dc;">
        <div class="row">
            <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">
                <!-- MENU' DESKTOP -->
            @include('layouts.website_menu_desktop')
            <!-- FINE MENU' DESKTOP -->
                <!-- box facebook -->
            @include('layouts.website_box_facebook')
            <!-- -->
                <!-- box spedizione -->
            @if(app()->getLocale() == 'it')
                @include('layouts.website_box_spedizione')
            @endif
            <!-- -->
            </div>
            <div class="col-md-10" style="background-color: #fff;">
                <!-- TITOLO PAGINA -->
                <div class="row header-page">
                    <div class="col-xs-6">
                        <div class="page-title">
                            <h2 class="fjalla">@lang('msg.modalita_spedizione')</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">@lang('msg.modalita_spedizione')</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content">
                            @if(app()->getLocale() == 'it')
                                <b>Corrieri e Spedizionieri:</b> per le proprie spedizioni Marsili's Company si avvale della collaborazione di <b>UPS</b> e <b>DHL</b>.<br>
                                &Egrave; possibile conoscere in ogni momento la posizione dei prodotti acquistati tramite il codice della spedizione TRACKING-NUMBER che vi viene fornito via e-mail. Il pacco viene consegnato presso il cliente direttamente dal corriere, che in caso di contrassegno, riceve l'importo in contanti.<br><br>
                                <b>Costo della spedizione:</b> viene evidenziato all'interno della pagina del carrello di acquisto prima di procedere con il pagamento ed è dipendente dal luogo di spedizione inserito dal cliente e il peso/volumetrico dei prodotti acquistati.<br><br>
                                <h3 style="text-decoration:underline;">IN TUTTA ITALIA SPEDIZIONE GRATUITA</h3>
                                <b>Tempi di Consegna:</b> Per spedizioni in Italia considerare 72 ore da aggiungere al tempo dell'attuale disponibilità
                                segnata su ogni prodotto, Per spedizione all'estero considerare 4/6 giorni x la spedizione da aggiungere al tempo dell'attuale disponibilità segnata su ogni prodotto.<br><br>
                                <b>Forza maggiore:</b> In caso di forza maggiore o caso fortuito, non siamo responsabili nei confronti del cliente per il
                                ritardo o la mancata esecuzione delle consegne e abbiamo la facoltà di risolvere il tutto o in parte il contratto o
                                sospenderne o differire l'esecuzione.<br><br>
                            @else
                                <b>Couriers and Freight:</b> Marsili's Company ship through UPS and DHL. It's possible to know at any time the position of the products purchased through the shipping code-TRACKING NUMBER provided to you via e-mail. The goods is delivered to the customer directly by the carrier, which in the case of "cash at the courier", receives the cash amount.<br><br>
                                <b>Cost of Shipping:</b> is highlighted in the page of the shopping cart before you proceed with the payment, and is dependent on the shipping point entered by the customer and the weight / volume of the products purchased.<br>FREE DELIVERY IN ITALY.<br><br>
                                <h3 style="text-decoration:underline;">FREE SHIPPING ALL OVER ITALY</h3>
                                <b>Time Delivery:</b> For shipments in Italy consider 72 hours to add to the time of the current availability marked on each product, for deliveries abroad consider x 4/6 days shipping time to add to the current availability of marked each product.<br><br>
                                <b>Force Majeure:</b> In the event of force majeure or unforeseeable circumstances, we are not liable to the customer for the delay or non-performance of deliveries and we have the right to terminate all or part of the contract or suspend or postpone the execution.<br><br>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_script')
@stop
