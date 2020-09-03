@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            @foreach($cms_modules as $modulo)
                @if(($modulo->role_id >= Auth::user()->role->id) && $modulo->stato)
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <a href="{{route('cms.'.$modulo->nome)}}" style="color:#fff"><i class="fa {{$modulo->icon}} fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <a href="{{route('cms.'.$modulo->nome)}}" style="color:#fff"><span class="text-uppercase"> {{$modulo->label}} </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection