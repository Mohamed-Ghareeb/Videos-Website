@extends('back-end.layout.app')

@section('title')
    Home Page
@endsection

@section('content')


    @component('back-end.layout.nav-bar')
        @slot('nav_title')
            Home Page
        @endslot
    @endcomponent


@endsection