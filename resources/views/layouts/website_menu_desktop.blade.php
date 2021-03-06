<ul class="nav navbar-nav col-md-12 ">

    <li class="display-block">
        <a class="fjalla color-black desk-menu text-uppercase" href="{{$pages->where('nome','tutti_prodotti')->first()->url()}}">
            {{$pages->where('nome','tutti_prodotti')->first()->label()}}
        </a>
    </li>

    <!-- Accrocchio per far passare le categorie della macro set completi come macro -->
    @foreach($macrocategorie as $macro)
        @if($macro->id == 22)
            @if($macro->categories)
                @foreach($macro->categories as $cat)
                    <li class="display-block">
                        <a class="fjalla color-black desk-menu {{(isset($category) && $category && ($category->id == $cat->id)) ? 'active-menu':''}}" href="{{$cat->url()}}">
                            {{$cat->{'nome_'.app()->getLocale()} }}
                        </a>
                    </li>
                @endforeach
            @endif
        @endif
    @endforeach
    <!-- -->

    @foreach($macrocategorie as $macro)
        @if($macro->id != 22)
        <li class=" dropdown display-block">
            <a href="{{$macro->url()}}"
               class="dropdown-toggle fjalla color-black text-uppercase desk-menu {{(isset($macrocategory) && $macrocategory && ($macrocategory->id == $macro->id)) ? 'active-menu':''}}">
                {{$macro->{'nome_'.app()->getLocale()} }}
            </a>
            <ul class="dropdown-menu dropdown-menu-left" style="top: 10px;left: 180px;">
                @foreach($macro->categories as $cat)
                    <li>
                        <a class="fjalla {{(isset($category) && $category && ($category->id == $cat->id)) ? 'sub-active-menu':''}}" href="{{$cat->url()}}" style="font-size:90%;">
                            {{$cat->{'nome_'.app()->getLocale()} }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        @endif
    @endforeach
</ul>
