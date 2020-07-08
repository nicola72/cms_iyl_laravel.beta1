<!-- SE ABBINAMENTI -->
@if($pairings)

    @foreach($pairings as $pairing)
        @include('website.page.partials.box_abbinamento')
    @endforeach

@endif
<!-- -->

<!-- SE PRODOTTI SINGOLI -->
@if($products)

    @foreach($products as $product)
        @include('website.page.partials.box_prodotto')
    @endforeach

@endif
<!-- -->