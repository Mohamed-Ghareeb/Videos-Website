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
            <form action="{{ route($routeName . '.update', ['id' => $row]) }}" method="POST">
                @csrf
                @method('put')
                @include('back-end.' . $folderName . '.form')
                <button type="submit" class="btn btn-primary pull-right">Update {{ $moduleName }}</button>
                <div class="clearfix"></div>
            </form>
    @endcomponent

@endsection
