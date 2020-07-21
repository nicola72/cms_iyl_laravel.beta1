<!-- SE ABBINAMENTI -->
@if($pairings)
    <!-- PAGINATORE -->
    {{$pairings->links('website.pagination.default')}}
    <!-- -->

    @foreach($pairings as $key=>$pairing)
        @include('website.page.partials.box_abbinamento')
    @endforeach

    <!-- PAGINATORE -->
    {{$pairings->links('website.pagination.default')}}
    <!-- -->
@endif
<!-- -->

<!-- SE PRODOTTI SINGOLI -->
@if($products)
    <!-- PAGINATORE -->
    {{$products->links('website.pagination.default')}}
    <!-- -->

    @foreach($products as $key=>$product)
        @include('website.page.partials.box_prodotto')
    @endforeach

    <!-- PAGINATORE -->
    {{$products->links('website.pagination.default')}}
    <!-- -->
@endif
<!-- -->
