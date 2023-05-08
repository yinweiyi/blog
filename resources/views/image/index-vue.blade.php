@extends('master')

@section('js-lib')
    @vite(['resources/js/app.js'])
@endsection

@section('container')
    <a-i-image :model-id="{{ $modelId }}" :list="{{ \json_encode($list) }}" :total="{{ $total }}"></a-i-image>
@endsection
