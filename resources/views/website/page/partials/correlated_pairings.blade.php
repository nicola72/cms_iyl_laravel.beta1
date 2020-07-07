<div class="row">
    @if($pairing_correlati->count() > 0)
        <div class="col-md-12 col-sm-12" style="background-color: #fff;">
            <div class="page-header" style="padding-top: 50px;">
                <h4>
                    <span style="font-size: 130%; font-family: 'Fjalla One', sans-serif; color: #840025">@lang('msg.set_correlati')</span>
                </h4>
            </div>
            <div class="row">
                @foreach($pairing_correlati as $pairing)
                    <div class="col-md-3 col-sm-6 col-xs-12" style="background-color: #fff;">
                        <div class="productBox">
                            <div class="productImage clearfix">
                                <a href="{{$pairing->url()}}">
                                    <img src="{{ $website_config['cs_small_dir'].$pairing->cover() }}" alt="{{$seo->alt ?? ''}}">
                                </a>
                            </div>
                            <div class="productCaption clearfix">
                                <a href="{{$pairing->url()}}">
                                    <div class="titolo_prodotto">
                                        {{$pairing->{'nome_'.app()->getLocale()} }}
                                    </div>
                                </a>
                                <div class="fjalla prezzo" >
                                    @if($pairing->product1->prezzo_scontato != '0.00' || $pairing->product2->prezzo_scontato != '0.00')
                                        <span class="FullProdPrice">
                                                                @money($pairing->product1->prezzo + $pairing->product2->prezzo)
                                                            </span>
                                        @money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())
                                    @else
                                        @money($pairing->product1->prezzo_vendita() + $pairing->product2->prezzo_vendita())
                                    @endif
                                </div>
                                <div class="prodDescrizione">
                                    <strong>{{ $pairing->{'desc_'.app()->getLocale()} }}</strong>
                                </div>

                                <i>@lang('msg.codice_prodotto'): {{$pairing->product1->codice}} + {{$pairing->product2->codice}}</i>
                                <a href="{{$pairing->url()}}" class="dettagli" >
                                    <i class="fa fa-search"></i> @lang('msg.dettagli_prodotto')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
