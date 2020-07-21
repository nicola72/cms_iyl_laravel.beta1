<!-- SE ABBINAMENTI -->
@if($pairings)

    @foreach($pairings as $key=>$pairing)
        @include('website.page.partials.box_abbinamento')
    @endforeach

@endif
<!-- -->

<!-- SE PRODOTTI SINGOLI -->
@if($products)

    @foreach($products as $key=>$product)
        @include('website.page.partials.box_prodotto')
    @endforeach

@endif
<!-- -->
