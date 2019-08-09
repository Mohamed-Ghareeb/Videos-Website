@extends('layouts.app')

@section('title', $video->name)

@section('content')

    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h1>{{ $video->name }}</h1>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @php $url = getYoutubeId($video->youtube); @endphp
                    @if ($url)
                        <iframe width="100%" height="500px" src="https://www.youtube.com/embed/{{ $url }}" frameborder="0" allowfullscreen style="margin-bottom:20px"></iframe>
                    @endif
                </div>
                <div class="col-md-3">
                    <p>
                        <i class="nc-icon nc-single-02"></i> 
                        {{ $video->user->name }}
                        
                    </p>
                    <p>
                        {{ $video->des }}
                    </p>
                </div>
                <div class="col-md-2">
                    <p>
                        <i class="nc-icon nc-calendar-60"></i> 
                        {{ $video->created_at }}
                    </p>
                </div>
                <div class="col-md-2">
                    <p>
                        <a href="{{ route('front.category', ['id' => $video->cat->id]) }}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            {{ $video->cat->name }}
                        </a>
                    </p>
                </div>
                <div class="col-md-2">
                    <h6>Tags</h6>
                    <p>
                        @foreach ($video->tags as $tag)
                        <a href="{{ route('front.tag', ['id' => $tag->id]) }}">
                            <span class="badge badge-pill badge-primary"><i class="nc-icon nc-tag-content"></i> {{ $tag->name }}</span>
                        </a>
                        @endforeach
                    </p>
                </div>
                <div class="col-md-2">
                    <h6>Skills</h6>
                    <p>
                        @foreach ($video->skills as $skill)
                        <a href="{{ route('front.skill', ['id' => $skill->id]) }}">
                            <span class="badge badge-pill badge-success">{{ $skill->name }}</span>
                        </a>
                        @endforeach
                    </p>
                </div>
            </div>
            <br /><br /> 

            @include('front-end.video.comments')
            @include('front-end.video.create-comment')

        </div>
    </div>

@endsection