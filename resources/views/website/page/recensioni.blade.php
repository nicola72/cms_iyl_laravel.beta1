@extends('layouts.website')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="background-color:#e4e0dc;">
                <div class="row">
                    <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding-top:20px;padding-bottom: 20px;">
                        <!-- MENU' DESKTOP -->
                        @include('layouts.website_menu_desktop')
                        <!-- FINE MENU' DESKTOP -->
                    </div>
                    <div class="col-md-10" style="background-color: #fff">
                        <div class="row" style="padding-top:60px;padding-bottom:100px;">
                            <div class="col-md-8 col-md-offset-2">
                                @if($reviews)
                                    @foreach($reviews as $review)
                                        <div class="recensione-item">
                                            <div class="recensione-data">{{ $review->created_at->format('d/m/Y') }}</div>
                                            <div class="recensione-nome">{{ $review->nome }}</div>
                                            <div class="recensione-messaggio">{!! $review->messaggio !!}</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js_script')

@stop