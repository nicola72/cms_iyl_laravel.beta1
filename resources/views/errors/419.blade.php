@extends('layouts.website_errors')

@section('content')
    <div class="middle-box text-center animated fadeInDown" style="padding:50px 0;min-height:400px">
        <h1>419</h1>
        <h3 class="font-bold">Oops! {{ class_basename($exception->getPrevious() ? : $exception) }}</h3>

        <div class="error-desc">
            {{ $exception->getMessage() }}
            <a href="{{ url('/') }}" class="btn btn-default">Home</a>
        </div>
    </div>
@endsection
