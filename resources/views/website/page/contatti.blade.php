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
                            <div class="col-md-4">
                                <div class="page-content">
                                    @if(app()->getLocale() == 'it')
                                        <b>CENTRO STORICO:</b><br><br>
                                        oltrepassare Ponte Vecchio in direzione Piazza Pitti,
                                        svoltare alla prima a destra (borgo S. Jacopo) e camminare per ca. 100mt:
                                        il negozio è sulla sinistra al numero 23/r.<br><br>
                                        Via Borgo S.Jacopo, 23/r<br>
                                        50125 Firenze (FI)<br>
                                        Toscana - Italia<br><br>
                                        Tel.: +39 055 2645488
                                    @else
                                        <b>HISTORICAL CENTER:</b><br><br>
                                        Cross "Ponte Vecchio" bridge towards Piazza Pitti, turn right at the first cross (borgo S. Jacopo) and walk down for about 100mt: you'll find our shop on your left (number 23/r).<br><br>
                                        Via Borgo S.Jacopo, 23/r<br>
                                        50125 Florence (FI)<br>
                                        Tuscany - Italy<br><br>
                                        Phone: +39 055 2645488
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7 col-md-offset-1">
                                @include('website.form.form_contatti')
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