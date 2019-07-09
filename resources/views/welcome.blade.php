@extends('layouts.app')

@section('title', 'Home')
    
@section('content')

  @include('front-end.homepage-section.home-image')

  @include('front-end.homepage-section.videos')

  @include('front-end.homepage-section.statics')

  @include('front-end.homepage-section.contact-us')

@endsection