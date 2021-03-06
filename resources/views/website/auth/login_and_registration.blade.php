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
                            <h2 class="fjalla">Login</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">Login</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row" style="padding-top:40px;padding-bottom:40px;">

                    <!-- FORM LOGIN -->
                    <div class="col-md-6">
                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <h3  class="fjalla" style="color:#840025;">@lang('msg.sei_gia_iscritto')</h3>
                                </div>
                                @include('website.form.form_login')
                                <br />
                                <p>
                                    <a style="font-size:120%; font-weight:bold; color:#840025" href="{{url(app()->getLocale().'/retriew_password')}}">
                                        @lang('msg.recupera_password')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- -->

                    <!-- FORM REGISTRAZIONE -->
                    <div class="col-md-6">
                        <div class="row" style="padding-left:10px;padding-right:10px;">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <h3  class="fjalla" style="color:#840025;">@lang('msg.crea_un_account')</h3>
                                </div>
                                @include('website.form.form_registrazione')
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