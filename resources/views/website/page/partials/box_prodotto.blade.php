<div class="col-sm-4 col-lg-3 productsContent">
    <div class="productBox">
        <div class="productImage clearfix">
            <a href="{{ $product->url() }}">
                <img src="{{ $website_config['cs_small_dir'].$product->cover() }}" alt="{{$seo->alt ?? ''}}">
            </a>
            @if(isset($is_wishlist))
            <div class="productMasking" style="background-color:rgba(0,0,0,0.6);">
                <ul class="list-inline btn-group" role="group" style="width:103px;">
                    <li>
                        <a href="javascript:void(0)" onclick="addToCart('{{ url(app()->getLocale().'/cart/addproduct',$product->id) }}')" class="btn btn-default">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="deleteFromWishList('{{ url(app()->getLocale().'/wishlist_delete',$product->id) }}')" class="btn btn-default">
                            <i class="fa fa-trash"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
        <div class="productCaption clearfix">
            <a href="{{ $product->url() }}">
                <div class="titolo_prodotto">
                    @if(strlen($product->{'nome_'.app()->getLocale()}) > 50))
                        {{ substr($product->{'nome_'.app()->getLocale()},0,50) }}...
                    @else
                        {{ $product->{'nome_'.app()->getLocale()} }}
                    @endif

                </div>
            </a>
            <div class="fjalla prezzo" >
                @if($product->availability_id == 4)
                    @lang('msg.su_ordinazione')
                @else
                    @if($product->is_scontato())
                        <span class="FullProdPrice">@money($product->prezzo)</span>
                        &nbsp;&nbsp;
                        <span>@money($product->prezzo_scontato)</span>
                    @else
                        <span>@money($product->prezzo)</span>
                    @endif
                @endif
            </div>
            <div class="prodDescrizione">
                <strong>{{ $product->{'desc_'.app()->getLocale()} }}</strong>
            </div>

            <i>@lang('msg.codice_prodotto'): {{ $product->codice }}</i>
            <a href="{{ $product->url() }}" class="dettagli" >
                <i class="fa fa-search"></i> @lang('msg.dettagli_prodotto')
            </a>
        </div>
    </div>
</div>
