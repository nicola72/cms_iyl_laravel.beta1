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
                        <!-- TITOLO PAGINA -->
                        <div class="row header-page">
                            <div class="col-xs-6">
                                <div class="page-title">
                                    <h2 class="fjalla">Account</h2>
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <ol class="breadcrumb pull-right">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="#" id="name_category">account</a></li>
                                </ol>
                            </div>
                        </div>
                        <!-- FINE TITOLO PAGINA -->
                        <div class="row" style="padding-top:60px;padding-bottom:100px;">
                            <div class="col-md-7 col-md-offset-1">
                                @include('website.form.form_modifica_account')
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