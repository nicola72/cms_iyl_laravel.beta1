<ul class="nav navbar-nav col-md-12 ">

    <!-- Accrocchio per far passare le categorie della macro set completi come macro -->
    @foreach($macrocategorie as $macro)
        @if($macro->id == 22)
            @if($macro->categories)
                @foreach($macro->categories as $category)
                    <li class="display-block">
                        <a class="fjalla color-black desk-menu" href="{{$category->url()}}">
                            {{$category->{'nome_'.app()->getLocale()} }}
                        </a>
                    </li>
                @endforeach
            @endif
        @endif
    @endforeach
    <!-- -->

    @foreach($macrocategorie as $macro)
        <li class=" dropdown display-block">
            <a href="{{$macro->url()}}" class="dropdown-toggle fjalla color-black text-uppercase desk-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                {{$macro->{'nome_'.app()->getLocale()} }}
            </a>
            <ul class="dropdown-menu dropdown-menu-left" style="top: 10px;left: 180px;">
                @foreach($macro->categories as $category)
                    <li>
                        <a class="fjalla" href="{{$category->url()}}" style="font-size:90%;">
                            {{$category->{'nome_'.app()->getLocale()} }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
