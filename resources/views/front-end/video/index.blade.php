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
            <div class="row" id="comments">
                <div class="col-md-12">
                    <div class="card text-left">
                        <div class="card-header card-header-rose">
                            @php $comments = $video->comments; @endphp
                            <h5>Comments ({{ count($comments) }})</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($comments as $comment)
                             <div class="row">
                                <div class="col-md-8">
                                    <span><i class="nc-icon nc-chat-33"></i> : {{ $comment->user->name }}</span>
                                </div> 
                                <br/>
                                <br/>
                                <div class="col-md-4 text-right">
                                    <span>
                                        <i class="nc-icon nc-calendar-60"></i>  : {{ $comment->created_at }}
                                    </span>
                                </div>
                            </div>   
                                <p>{{ $comment->comment }}</p>
                                <br>
                                @if (auth()->user())
                                    @if ((auth()->user()->group == 'admin') || auth()->user()->id == $comment->user->id)
                                    <a href="{{ route('front.update-comment', ['id' => $comment->id]) }}" onclick="$(this).next('div').slideToggle(350);return false">
                                            <button type="button" class="btn btn-outline-info btn-round btn-sm">Edit Your Comment</button>
                                        </a>
                                        <div style="display:none;margin-top: 20px">
                                            <form action="{{ route('front.update-comment', ['id' => $comment->id]) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment" rows="4">{{ $comment->comment }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-round" data-placement="right">Update Comment</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                                @if (!$loop->last)
                                    <hr />
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()) 
                <form action="{{ route('front.store-comment', ['id' => $video->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add Your Comment</label>
                        <textarea class="form-control" name="comment" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round" data-placement="right">Add Comment</button>
                </form>
            @endif
        </div>
    </div>

@endsection