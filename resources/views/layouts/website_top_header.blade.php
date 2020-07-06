<div class="topBar">
    <h1 class="h1 hidden-xs">{{$seo->h1  ?? ""}}</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 hidden-sm hidden-xs">

                <!-- MENU' SOCIAL -->
                <ul class="list-inline">
                    <li>
                        <a href="https://www.facebook.com/Marsilis-Company-316915328512344/" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/chess.store.florence/?hl=it" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/uv?hl=it&pb=!1s0x132a51555407ea59%3A0xf0b9337e0e59d237!3m1!7e115!4s%2Fmaps%2Fplace%2Fchess%2Bstore%2F%4043.767682%2C11.2520167%2C3a%2C75y%2C198.35h%2C90t%2Fdata%3D*213m4*211e1*213m2*211sAD6gH58TmDF8fmAYZfOPXw*212e0*214m2*213m1*211s0x132a51555407ea59%3A0xf0b9337e0e59d237%3Fsa%3DX!5schess%20store%20-%20Cerca%20con%20Google!15sCgIgAQ&imagekey=!1e2!2sAD6gH58TmDF8fmAYZfOPXw&sa=X&ved=2ahUKEwi8-72VqbjqAhWISsAKHY-FDiEQpx8wCnoECBMQCw" target="_blank">
                            <img src="/img/gmb.png" alt=""style="vertical-align:middle; max-width:13px;" />
                        </a>
                    </li>
                </ul>
                <!-- FINE MENU' SOCIAL -->

            </div>
            <div class="col-md-6 col-xs-12">
                <ul class="list-inline pull-right">

                    <!-- MENU' LINGUE -->
                    <li>
                        @if(app()->getLocale() == 'it')
                            <a href="https://www.chess-store.org">
                                <img src="/img/flag_eng.jpg" alt="{{$seo->alt ?? ""}}" />
                            </a>
                        @else
                            <a href="https://www.chess-store.it">
                                <img src="/img/flag_ita.jpg" alt="{{$seo->alt ?? ""}}" />
                            </a>
                        @endif
                        <a href="https://www.chess-store.net">
                            <img src="/img/flag_esp.jpg" alt="{{$seo->alt ?? ""}}" />
                        </a>
                        <a href="https://www.chess-store-italy.ru">
                            <img src="/img/flag_rus.jpg" alt="{{$seo->alt ?? ""}}" />
                        </a>
                        <a href="https://www.chessstore.de">
                            <img src="/img/flag_deu.jpg" alt="{{$seo->alt ?? ""}}" />
                        </a>
                    </li>
                    <!-- FINE MENU LINGUE -->

                    <!-- MENU USER O GUEST -->
                    @if(Auth::guard('website')->check())
                        @include('layouts.website_auth_menu')
                    @else
                        @include('layouts.website_guest_menu')
                    @endif
                    <!-- -->

                    <!-- WISHLIST -->
                    <li>
                        <a href="{{$pages->where('nome','wishlist')->first()->url()}}">
                            &nbsp;&nbsp;
                            <i class="fa fa-heart" aria-hidden="true"></i>&nbsp;&nbsp;
                        </a>
                    </li>
                    <!-- FINE WISHLIST -->

                    <!-- pulsante CARRELLO MOBILE -->
                    <li class="hidden-md hidden-sm hidden-lg">
                        <a href="{{$pages->where('nome','carrello')->first()->url()}}">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="carrello_nr">{{$carts->count()}}</span>
                        </a>
                    </li>
                    <!-- fine CARRELLO MOBILE -->

                    <!-- pulsante CARRELLO DESKTOP -->
                    <li class="dropdown hidden-xs" >
                        <a href="{{$pages->where('nome','carrello')->first()->url()}}" class="dropdown-toggle" data-toggle="dropdown disabled">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="carrello_nr">{{$carts->count()}}</span>
                        </a>
                        <ul id="cart-menu" class="dropdown-menu dropdown-menu-right">

                            @if($carts->count() > 0)
                                <li>@lang('msg.carrello_1')</li>

                                @foreach($carts as $cart)
                                    <li>
                                        <div class="media" style="padding:6px 16px;color:#fff">
                                            <img class="media-left media-object foto_carrello" src="{{ $website_config['cs_small_dir'].$cart->product->cover() }}" alt="">
                                            <div class="media-body">
                                                <h8 class="media-heading" style="max-width:130px;overflow: hidden;font-size:12px">
                                                    {{substr($cart->product->{'nome_'.app()->getLocale()},0,20)}}
                                                    ...
                                                    <br>
                                                    <span>{{$cart->qta}} X @money($cart->product->prezzo_vendita())</span>
                                                </h8>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>@lang('msg.carrello_2')</li>
                            @endif
                            <li>
                                <div class="btn-group" role="group" aria-label="..." style="text-align:right;">
                                    <button type="button" class="btn btn-default" style="color:#000;margin-left:130px;" onclick="location.href='{{$pages->where('nome','carrello')->first()->url()}}';">
                                        @lang('msg.carrello')
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!--  fine CARRELLO DESKTOP -->
                </ul>
            </div>
        </div>
    </div>
</div>