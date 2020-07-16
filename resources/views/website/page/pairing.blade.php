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
                            <h2 class="fjalla">{{ $pairing->{'nome_'.app()->getLocale()} }}</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">{{ $pairing->{'nome_'.app()->getLocale()} }}</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content singleProduct">
                            <div class="row media">

                                <!-- SLIDER FOTO PRODOTTO -->
                                <div class="col-sm-8">
                                    <div class="media productSlider">
                                        <div id="carousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @php $count=1 @endphp
                                                @if($pairing->images)
                                                    @foreach($pairing->images as $img)
                                                        <div class="item {{ ($count == 1) ? 'active' : '' }}" data-thumb="0">
                                                            <a href="{{ $website_config['cs_big_dir'].$img->path }}"  class="galleria-item" data-lightbox="image-1">
                                                                <img src="{{ $website_config['cs_big_dir'].$img->path }}" class="img-responsive" alt="{{$seo->alt ?? ''}}"/>
                                                            </a>
                                                        </div>
                                                        @php $count++ @endphp
                                                    @endforeach
                                                @endif
                                            </div>
                                            @if($pairing->images->count() > 1)
                                                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <!-- FINE SLIDER FOTO PRODOTTO -->

                                <div class="col-sm-4">
                                    <div class="media-body">

                                        <!-- nome abbinamento -->
                                        <h2 style="margin-top: 10px;">{{ $pairing->{'nome_'.app()->getLocale()} }}</h2>
                                        <!-- -->

                                        <!-- prezzo abbinamento -->
                                        @if($pairing->product1->prezzo_scontato != '0.00' || $pairing->product2->prezzo_scontato != '0.00')
                                            <h3 style="margin-bottom:6px;">
                                                <span class="prezzo_pieno">@money($pairing->product1->prezzo + $pairing->product2->prezzo)</span>
                                                <br>
                                                <span style="color:#840025;">@money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())</span>
                                            </h3>
                                        @else
                                            <h3 style="margin-bottom:6px;">
                                                <span>@money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())</span>
                                            </h3>
                                    @endif
                                    <!-- -->

                                        <!-- codice/descrizione -->
                                        <div style="margin-bottom:16px;line-height:1.6;font-size:14px;">
                                            @lang('msg.codice_prodotto'): <strong>{{ $pairing->product1->codice }} + {{ $pairing->product2->codice }}</strong>
                                            <br /><br />
                                            {{ $pairing->{'desc_'.app()->getLocale()} }}
                                        </div>
                                        <!-- -->

                                        <!-- pulsante CARRELLO -->
                                        <div class="btn-area">
                                            <a href="javascript:void(0)" onclick="addToCart('{{ url(app()->getLocale().'/cart/addpairing',$pairing->id) }}')" class="btn btn-primary btn-block">
                                                + carrello <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <!-- -->

                                        <!-- pulsante WHISLIST -->
                                        <a href="javascript:void(0)" onclick="addToWishList('{{ url(app()->getLocale().'/wishlist_addpairing',$pairing->id) }}')" style="background-color: #840025; padding: 10px;">
                                            <i class="fa fa-heart" aria-hidden="true" style="font-size: 130%;"></i>
                                        </a>
                                        <br /><br><br>
                                        <!-- -->

                                        <iframe
                                            src="//www.facebook.com/plugins/share_button.php?href={{request()->fullUrl()}}&amp;layout=button_count&amp;appId=552773188215847"
                                            scrolling="no" frameborder="0" allowtransparency="true"
                                            style="height: 30px;">

                                            <!-- pulsanti SOCIAL -->
                                        </iframe>
                                        <div class="clearfix"></div>
                                        <div class="g-plus" data-action="share" style="margin:0px 0 5px 0;"></div>
                                        <div class="clearfix"></div>
                                        <a class="twitter-share-button"  href="https://twitter.com/intent/tweet">Tweet</a>

                                        <script>
                                            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
                                        </script>
                                        <!-- -->

                                    </div>
                                </div>

                            </div>

                            <!-- PRODOTTI SINGOLI -->
                            @include('website.page.partials.pairing_single_products')
                            <!-- FINE PRODOTTI SINGOLI -->

                            <!-- abbinamenti correlati -->
                            @include('website.page.partials.correlated_pairings')
                            <!-- fine abbinamenti correlati -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_script')

@stop
