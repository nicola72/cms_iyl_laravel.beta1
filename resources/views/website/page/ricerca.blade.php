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
                            <h2 class="fjalla">{{ $titolo }}</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">{{ $titolo }}</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content">
                            <div class="categoria-description">{{ $descrizione_categoria }}</div>
                            <div class="fjalla" style="text-align:left; font-size:130%;padding-bottom:20px;">
                                @lang('msg.ci_sono_n_prodotti_per_questa_ricerca',['number'=>$totali])
                            </div>

                            <div id="product_list">

                                @foreach($list as $key=>$item)
                                    @if($item['type'] == 'product')
                                        @include('website.page.partials.box_prodotto',['product'=>$item['object']])
                                    @elseif($item['type'] == 'pairing')
                                        @include('website.page.partials.box_abbinamento',['pairing'=>$item['object']])
                                    @endif
                                @endforeach

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
