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