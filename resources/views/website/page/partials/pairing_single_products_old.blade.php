<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="productBox">
                    <div class="productImage clearfix">
                        <a href="{{$pairing->product1->url()}}">
                            <img src="{{ $website_config['cs_small_dir'].$pairing->product1->cover() }}" alt="{{$seo->alt ?? ''}}">
                        </a>
                    </div>
                    <div class="productCaption clearfix">
                        <a href="{{$pairing->product1->url()}}">
                            <div class="titolo_prodotto">
                                {{$pairing->product1->{'nome_'.app()->getLocale()} }}
                            </div>
                        </a>
                        <div class="fjalla prezzo">
                            @if($pairing->product1->is_scontato())
                                <span class="FullProdPrice">@money($pairing->product1->prezzo)</span>
                                &nbsp;&nbsp;
                                <span>@money($pairing->product1->prezzo_scontato)</span>
                            @else
                                <span>@money($pairing->product1->prezzo)</span>
                            @endif
                        </div>
                        <div class="prodDescrizione">
                            <strong>{{ $pairing->product1->{'desc_'.app()->getLocale()} }}</strong>
                        </div>
                        <div class="prodDimensioni">
                            {{ $pairing->product1->{'misure_'.app()->getLocale()} }}
                        </div>
                        <div class="prodDisp">
                            {{ $pairing->product1->availability->{'nome_'.app()->getLocale()} }}
                        </div>
                        <br />
                        <i>@lang('msg.codice_prodotto'): {{ $pairing->product1->codice }}</i>
                        <a href="{{ $pairing->product1->url() }}" class="dettagli">
                            <i class="fa fa-search"></i> @lang('msg.dettagli_prodotto')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="productBox">
                    <div class="productImage clearfix">
                        <a href="{{ $pairing->product2->url() }}">
                            <img src="{{ $website_config['cs_small_dir'].$pairing->product2->cover() }}" alt="{{$seo->alt ?? ''}}">
                        </a>

                    </div>
                    <div class="productCaption clearfix">
                        <a href="{{ $pairing->product2->url() }}">
                            <div class="titolo_prodotto">
                                {{$pairing->product2->{'nome_'.app()->getLocale()} }}
                            </div>
                        </a>
                        <div class="fjalla prezzo">
                            @if($pairing->product2->is_scontato())
                                <span class="FullProdPrice">@money($pairing->product2->prezzo)</span>
                                &nbsp;&nbsp;
                                <span>@money($pairing->product2->prezzo_scontato)</span>
                            @else
                                <span>@money($pairing->product2->prezzo)</span>
                            @endif
                        </div>
                        <div class="prodDescrizione">
                            <strong>{{ $pairing->product2->{'desc_'.app()->getLocale()} }}</strong>
                        </div>
                        <div class="prodDimensioni">
                            {{ $pairing->product2->{'misure_'.app()->getLocale()} }}
                        </div>
                        <div class="prodDisp">
                            {{ $pairing->product2->availability->{'nome_'.app()->getLocale()} }}
                        </div>
                        <br />
                        <i>@lang('msg.codice_prodotto'): {{ $pairing->product2->codice }}</i>
                        <a href="{{ $pairing->product2->url() }}" class="dettagli">
                            <i class="fa fa-search"></i> @lang('msg.dettagli_prodotto')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
