@extends('layouts.website')
@section('content')
<div class="col-md-12" style="background-color:#e4e0dc;">
    <div class="row">
        <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">

            <!-- ORDINAMENTO -->
            <div class="">
                <div class="fjalla" style="font-weight:100;padding-left:15px;font-size:16px;text-transform: uppercase">@lang('msg.ordina_per'):</div>
                @include('website.form.form_ordinamento')
                <hr style="border-top:3px solid #fff;">
            </div>
            <!-- -->

            <!-- FILTRI -->
            @if($pairings)
                <div class="">
                    <div class="fjalla" style="font-weight:100;padding-left:15px;font-size:16px;text-transform: uppercase">@lang('msg.filtra_per'):</div>
                    @include('website.form.form_filtro')
                </div>
                <hr style="border-top:3px solid #fff;">
            @endif
            <!-- -->


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
                <div class="col-12 col-md-6">
                    <div class="page-title">
                        <h2 class="fjalla">{{ $titolo }}</h2>
                    </div>
                </div>

                <div class="col-md-6 hidden-xs">
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
                            @lang('msg.ci_sono_n_prodotti_in_questa_categoria',['number'=>$totali])
                        </div>

                        <div id="product_list">

                            <!-- ABBINAMENTI -->
                            @if($pairings)
                                <!-- PAGINATORE -->
                                {{$pairings->links('website.pagination.on_scroll')}}
                                <!-- -->

                                @foreach($pairings as $key=>$pairing)
                                    @include('website.page.partials.box_abbinamento')
                                @endforeach

                                <!-- PAGINATORE -->
                                {{$pairings->links('website.pagination.on_scroll')}}
                                <!-- -->
                            @endif
                            <!-- FINE ABBINAMENTI -->

                            <!-- PRODOTTI SINGOLI -->
                            @if($products)
                                <!-- PAGINATORE -->
                                {{$products->links('website.pagination.on_scroll')}}
                                <!-- -->

                                @foreach($products as $key=>$product)
                                    @include('website.page.partials.box_prodotto')
                                @endforeach

                                <!-- PAGINATORE -->
                                {{$products->links('website.pagination.on_scroll')}}
                                <!-- -->
                            @endif
                            <!-- FINE PRODOTTI SINGOLI -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_script')
    <script type="text/javascript">
        var $name_category = $('#name_category');
        if ( $name_category.length && !$name_category.text().trim() ){
            var name_category  = $('a.categoria', $('.nav.fjalla .collapseItem:not(.collapse)').parent()).text().trim();
            $name_category.text(name_category);
        }

    </script>
@stop
