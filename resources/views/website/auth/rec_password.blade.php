@extends('layouts.website')
@section('content')
    <div class="col-md-12" style="background-color:#e4e0dc;">
        <div class="row">
            <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">
                <!-- MENU' DESKTOP -->
                @include('layouts.website_menu_desktop')
                <!-- FINE MENU' DESKTOP -->
            </div>
            <div class="col-md-10" style="background-color: #fff;">
                <!-- TITOLO PAGINA -->
                <div class="row header-page">
                    <div class="col-xs-6">
                        <div class="page-title">
                            <h2 class="fjalla">@lang('msg.recupera_password')</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">@lang('msg.recupera_password')</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row" style="padding-top:40px;padding-bottom:40px;">

                    <!-- FORM RECUPERA PASSWORD -->
                    <div class="col-md-6">
                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <div class="col-md-12">
                                @include('website.form.form_rec_password')
                                <br />
                            </div>
                        </div>
                    </div>
                    <!-- -->

                </div>

            </div>
        </div>
    </div>

@endsection
@section('js_script')

@stop