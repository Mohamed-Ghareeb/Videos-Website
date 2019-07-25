@extends('layouts.app')

@section('title', 'Lastest Videos')
    
@section('content')

<div class="section section-buttons">
    <div class="container">
        <div class="title">
            <h2>Lastest Videos</h2>
            <br>
            <p>
                @if (request()->has('search') && request()->get('search') != '')
                    
                    You Are Search On <b>{{ request()->get('search') }}</b> | <a href="{{ route('home') }}">Reset</a>

                @endif
            </p>
        </div>
        @include('front-end.shared.video-row')
    </div>
</div> 



@endsection
