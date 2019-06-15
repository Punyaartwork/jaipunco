@foreach($comments as $comment)
<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    
    <div class="comments">
    <div class="comment-profile-into"><img src="{{ $comment->user->profile }}" class="comment-profile-img"></div>
    <strong>{{ $comment->body }}</strong>
    <a href="/profile/{{ $comment->user->id }}"  style="display: block;text-decoration: none;color: #000;">{{ $comment->user->name }}  <span>{{ $comment->created_at }}</span></a>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('comments.store') }}">
        @csrf
            <input type="text" name="body" class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            <input type="hidden" name="commentTime" value="{{time()}}" />        
            <input type="hidden" name="commentType" value="1" />    
            <input type="submit" id="reply" value="Reply" />
    </form>
    </div>
    @include('story.commentsDisplay', ['comments' => $comment->replies])
</div>
@endforeach