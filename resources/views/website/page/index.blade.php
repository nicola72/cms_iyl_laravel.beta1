@extends('layouts.website')
@section('content')
    <div class="col-md-12" style="margin:0; padding:0; background-color:#e4e0dc;">
        <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">
            <!-- MENU' DESKTOP -->
            @include('layouts.website_menu_desktop')
            <!-- FINE MENU' DESKTOP -->
        </div>
        <div class="col-md-10" style="margin:0; padding:0;">
            <!-- SLIDER -->
            @include('website.page.partials.slider')
            <!-- FINE SLIDER -->
        </div>
    </div>

    <div class="clearfix"></div>

    <section class="mainContent  productsContent">
        <div class="container-fluid" style="margin-bottom:40px;">
            <div class="row">
                <div class="col-md-12 text-center" style="font-size:200%; padding-top:30px; padding-bottom:30px;line-height:1.5em; font-weight:bold; color:#840025; background-color:#d2d0ce; ">
                    @lang('msg.home_1')
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <!-- OFFERTE -->
                    @include('website.page.partials.home_offerte')
                    <!-- FINE OFFERTE -->

                    <!-- NOVITA' -->
                    @include('website.page.partials.home_novita')
                    <!-- FINE NOVITA' -->

                    <div class="clearfix"></div>

                    <div class="col-md-12  text-center mossa-giusta">
                        <p class="mossa-giusta-p">
                            <img src="/img/scacco.png" alt="{{ $seo->alt ?? '' }}" style="vertical-align:middle; max-height:40px;" />
                            <br/>
                            @lang('msg.fai_la_mossa_giusta')
                        </p>

                        <img src="/img/pacco-regalo-copia.jpg" class="img-responsive img-center" alt="{{ $seo->alt ?? '' }}" style="margin-bottom: 20px; width:80%"/>

                        <p class="mossa-giusta mossa-giusta-p-1">
                            <img src="/img/gift.png" alt="{{ $seo->alt ?? '' }}" style="vertical-align:middle; max-height:40px;" />
                            <br/>
                            @lang('msg.pacchetto_regalo_msg')
                        </p>
                    </div>

                    <div class="col-md-10 col-md-offset-1">
                        <div class="col-md-4" style="margin: 30px 0 0 0; padding: 0 2px 0 0;">
                            <img src="/img/artigianale.jpg" class="img-responsive" alt="{{ $seo->alt ?? '' }}" style="margin-bottom: 20px;"/>
                        </div>


                        <div class="col-md-4" style="margin: 30px 0 0 0; padding: 0 0 0 2px;">
                            <img src="/img/dealer1.jpg" class="img-responsive" alt="{{ $seo->alt ?? '' }}" style="margin-bottom: 20px;"/>
                        </div>


                        <div class="col-md-4" style="margin: 30px 0 0 0; padding: 0 2px 0 0;">
                            <img src="/img/fabbrica.jpg" class="img-responsive" alt="{{ $seo->alt ?? '' }}" style="margin-bottom: 20px;"/>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- POPUP NEWS -->
    @if($popup)
    <div id="popup" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modalpopup-title">{{$popup->{'nome_'.app()->getLocale()} }}</h4>
                </div>
                <div class="modalpopup-body">
                    <div>
                        <img src="/file/news/small/{{$popup->cover()}}" alt="" class="img_news">
                    </div>
                    {!! $popup->{'desc_'.app()->getLocale()} !!}
                </div>
                <div class="modal-footer" style="text-align:left;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    @endif
    <!-- -->

@endsection
@section('js_script')
    <script>
        $(document).ready(function() {
            $("#popup").modal('show');
        });
    </script>
@stop