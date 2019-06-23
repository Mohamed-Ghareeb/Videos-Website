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
        <form action="{{ route($routeName . '.update', ['id' => $row]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('back-end.' . $folderName . '.form')
            <button type="submit" class="btn btn-primary pull-right">Update {{ $moduleName }}</button>
            <div class="clearfix"></div>
        </form>
        
        @slot('md4')
            @php $url = getYoutubeId($row->youtube); @endphp
            @if ($url)
                <iframe width="450" height="250" src="https://www.youtube.com/embed/{{ $url }}" frameborder="0" allowfullscreen style="margin-bottom:20px"></iframe>
            @endif    
            <img src="{{ url('uploads/' . $row->image) }}" width="450" height="250">
        @endslot
    @endcomponent
    @component('back-end.shared.edit', ['pageTitle' => 'Comments', 'pageDesc' => 'Here You Can Control The Comment'])
    
        @include('back-end.comments.index')
        @slot('md4')
            @include('back-end.comments.create')
        @endslot
    @endcomponent

@endsection
