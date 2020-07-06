<div class="row featuredProducts" style="margin-top:30px;">

    <div class="col-xs-12">
        <div class="page-header">
            <h3 class="fjalla titolo-offerte">@lang('msg.novita_in_vetrina')</h3>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="owl-carousel featuredProductsSlider">
            @if($prodotti_novita)
                @foreach($prodotti_novita as $product)
                    <div class="slide">
                        <div class="productImage clearfix">
                            <a href="{{$product->url()}}">
                                <img src="{{$website_config['cs_small_dir'].$product->cover()}}" alt="{{$seo->alt ?? ''}}">
                            </a>
                        </div>
                        <div class="productCaption clearfix">
                            <a href="{{$product->url()}}">
                                <div class="titolo_prodotto">
                                    {{$product->{'nome_'.app()->getLocale()} }}
                                </div>
                            </a>
                            <div class="fjalla prezzo">
                                @if($product->is_scontato())
                                    <span class="prezzo_pieno">@money($product->prezzo)  &euro;</span>
                                    &nbsp;&nbsp;
                                    <span>@money($product->prezzo_scontato)</span>
                                @else
                                    <span>@money($product->prezzo)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($abbinamenti_novita)
                @foreach($abbinamenti_novita as $pairing)
                    <div class="slide">
                        <div class="productImage clearfix">
                            <a href="{{$pairing->url()}}">
                                <img src="{{$website_config['cs_small_dir'].$pairing->cover()}}" alt="{{$seo->alt ?? ''}}">
                            </a>
                        </div>
                        <div class="productCaption clearfix">
                            <a href="{{$pairing->url()}}">
                                <div class="titolo_prodotto">
                                    {{$pairing->{'nome_'.app()->getLocale()} }}
                                </div>
                            </a>
                            <div class="fjalla prezzo">
                                @if($pairing->product1->prezzo_scontato != '0.00' && $pairing->product2->prezzo_scontato != '0.00')
                                    <span class="FullProdPrice">
                                                            @money($pairing->product1->prezzo + $pairing->product2->prezzo)
                                                        </span>
                                    @money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())
                                @else
                                    @money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>