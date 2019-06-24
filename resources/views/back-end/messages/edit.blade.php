@extends('back-end.layout.app')

@section('title')
    {{ $pageTitle }}
@endsection

@section('content')

    @component('back-end.layout.nav-bar')
        @slot('nav_title')
            {{ $pageTitle }}
        @endslot
    @endcomponent

    @component('back-end.shared.edit', ['pageTitle' => $pageTitle, 'pageDesc' => $pageDesc])    
            @include('back-end.' . $folderName . '.form')
    @endcomponent

@endsection
