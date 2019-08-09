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
                        <span><i class="nc-icon nc-chat-33"></i> : 
                            <a href="{{ route('front.profile', ['id' => $comment->user->id, 'slug' => slug($comment->user->name)]) }}">{{ $comment->user->name }}</a>
                        </span>
                    </div>
                    <br />
                    <br />
                    <div class="col-md-4 text-right">
                        <span>
                            <i class="nc-icon nc-calendar-60"></i> : {{ $comment->created_at }}
                        </span>
                    </div>
                </div>
                <p>{{ $comment->comment }}</p>
                <br>
                @if (auth()->user())
                @if ((auth()->user()->group == 'admin') || auth()->user()->id == $comment->user->id)
                <a href="{{ route('front.update-comment', ['id' => $comment->id]) }}"
                    onclick="$(this).next('div').slideToggle(350);return false">
                    <button type="button" class="btn btn-outline-info btn-round btn-sm">Edit Your Comment</button>
                </a>
                <div style="display:none;margin-top: 20px">
                    <form action="{{ route('front.update-comment', ['id' => $comment->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="4">{{ $comment->comment }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-round" data-placement="right">Update
                            Comment</button>
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