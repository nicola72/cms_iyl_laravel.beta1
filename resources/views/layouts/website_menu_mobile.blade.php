<button type="button" class="navbar-toggle text-right button-small hidden-sm" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<div class="col-xs-12 hidden-md hidden-lg">
    <div class="collapse navbar-collapse navbar-ex1-collapse " style="margin-right:30px; background-color:#000;">
        <ul class="nav navbar-nav navbar-left">
            <li class="">
                <a href="/" class="font-small fjalla">Home</a>
            </li>
            <!-- PAGINE STATICHE -->
            @foreach($pages->where('menu', 1) as $page)
            <li class="{{ $page->is_current() ? 'active' : '' }}">
                <a class="color-white text-capitalize fjalla" href="{{$page->url()}}">
                    {{$page->label() }}
                </a>
            </li>
            @endforeach
            <!-- FINE PAGINE STATICHE -->

            <!-- CATEGORIE PRODOTTI -->
            <li id="mobile_cat_list" class="dropdown megaDropMenu">
                <a href="javascript:void(0)" class="dropdown-toggle fjalla" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false" style="font-size:130%; color:#840025">
                    SHOP
                </a>
                <ul class="dropdown-menu row hidden-md hidden-lg" style="width:100%; margin-top:10px; padding:5px 3px; height:auto;  background-color:#000;">
                    <li class="col-sm-3 col-xs-12">
                    @if(isset($macrocategorie))
                        @foreach($macrocategorie as $key=>$macro)
                            <ul class="list-unstyled">
                                <li class="titolo-menu" style="margin:0; padding:0;">
                                    <a href="#" class="fjalla" data-toggle="collapse" data-target="#collapse_{{$key}}" aria-expanded="false" aria-controls="collapse_{{$key}}" style="padding:5px 0 !important">
                                        <i class="fa fa-plus-square"></i>
                                        &nbsp;&nbsp;{{$macro->{'nome_'.app()->getLocale()} }}
                                    </a>
                                </li>
                                <div class="collapse" id="collapse_{{$key}}">
                                    <li><hr style="margin:10px 0"></li>
                                    @foreach($macro->categories as $category)
                                    <li>
                                        <a href="{{$category->url()}}" class="voci-menu fjalla color-white">
                                            {{ $category->{'nome_'.app()->getLocale()} }}
                                        </a>
                                    </li>
                                    @endforeach
                                </div>
                            </ul>
                        @endforeach
                    @endif
                    </li>
                </ul>
            </li>
            <!-- -->
        </ul>
    </div>
</div>
