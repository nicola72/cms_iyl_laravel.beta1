<!-- NAVBAR -->
<nav class="navbar navbar-main navbar-default " role="navigation"  style="background-color:#000;padding-bottom:10px;">
    <div class="col-xs-12 col-md-7">

        <div class="col-xs-6 col-sm-4 col-md-4 gratis ">

            <!-- box spese consegna gratuite -->
            @if(app()->getLocale() == 'it')
                <img src="/img/gratis.jpg" alt="Scacchi online"  style="margin-bottom:2px; max-width:50px; float:left; margin-right:5px;" class="img-responsive">
                CONSEGNA GRATUITA<br/>IN 24/48H LAVORATIVE<br/>IN TUTTA ITALIA<br/>
                <span class="gratis-small">per ordini superiori a 49€</span>
            @endif
            <!-- box fine spese consegna gratuite -->

        </div>

        <div class="col-xs-6  col-sm-4 col-md-4 col-md-offset-4 text-right ">

            <!-- LOGO -->
            <a href="/" style="display:block;">
                <img src="/img/logo3.jpg" alt="{{$seo->alt ?? ''}}"  style="display:block; margin-bottom:2px; width:100%; max-width:240px; margin:0 auto;"   class="img-responsive"/>
            </a>
            <!-- fine LOGO -->

            <!-- scritta sotto il logo -->
            <p class="negozio scritta  text-center payoff" style="color:#eee;">
                @lang('msg.negozio_di_scacchi_firenze')
            </p>
            @if(app()->getLocale() == 'en')
                <p class="color-white fjalla text-center hidden-sm hidden-xs">
                    FOR EXTRA UE SHIPPINGS THE ITALIAN VAT WILL BE AUTOMATICALLY DEDUCED DURING THE PURCHASE
                </p>
            @endif
            <!-- fine scritta sotto il logo -->

        </div>

    </div>
    <div class="col-lg-5 col-md-5">

        <!-- MENU' ORIZZONTALE -->
        <div class=" hidden-sm hidden-xs">
            <div class="collapse navbar-collapse navbar-ex1-collapse pull-right" style="background-color:#000;padding-bottom:18px;">
                <div class="nav navbar-nav navbar-right text-right nav-top">
                    <a href="/" class="color-white text-capitalize">Home</a>
                    @foreach($pages->where('menu', 1) as $page)
                        <a class="color-white text-capitalize" href="{{$page->url()}}">
                            {{$page->label() }}
                        </a>
                    @endforeach
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <!-- FINE MENU' ORIZZONTALE -->

        <!-- FORM RICERCA -->
        <div class="col-sm-4 col-md-6 col-lg-6 col-lg-offset-6 pull-right search-mobile">
            <form id="search_form" action="{{$pages->where('nome','ricerca')->first()->url()}}" method="get">
                <span class="input-group">
                    <input type="text" name="searchterm" class="form-control" placeholder="@lang('msg.cerca')" aria-describedby="basic-addon2">
                    <span style="cursor:pointer" class="input-group-addon" id="basic-addon2" onclick="$('#search_form').submit();">@lang('msg.cerca')</span>
                </span>
            </form>
        </div>
        <!-- FINE FORM RICERCA -->

    </div>
    @include('layouts.website_menu_mobile')
</nav>
