@extends('master')

@section('js-lib')
    @vite(['resources/js/app.js'])
@endsection

@section('container')
    <a-i-image :model-id="{{ $modelId }}"></a-i-image>
@endsection
