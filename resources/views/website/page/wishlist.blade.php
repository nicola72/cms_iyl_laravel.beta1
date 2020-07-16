@extends('layouts.website')
@section('content')
    <div class="col-md-12" style="background-color:#e4e0dc;">
        <div class="row">
            <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">

            <!-- MENU' DESKTOP -->
            @include('layouts.website_menu_desktop')
            <!-- FINE MENU' DESKTOP -->

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
                    <div class="col-md-12" style="background-color: #fff;min-height: 440px;">
                        <div class="page-catalogo-content">
                            @if(Auth::guard('website')->check())

                                @if(count($products) > 0 || count($pairings) > 0)
                                    <!-- PRODOTTI SINGOLI -->
                                    @if(count($products) > 0)

                                        @foreach($products as $product)
                                            @include('website.page.partials.box_prodotto')
                                        @endforeach

                                    @endif
                                    <!-- FINE PRODOTTI SINGOLI -->
                                @else
                                    <h4>@lang('msg.nessun_prodotto_in_wishlist')</h4>
                                @endif

                            @else
                                <h4>@lang('msg.per_poter_usufruire_della_wishlist_devi_effettuare_il_login')</h4>
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
