@if(!$newComments->isEmpty())
    <div class="panel panel-default">
        <div class="panel-heading"> 最新评论</div>
        <ul class="list-group">
            @foreach($newComments as $comment)
                <li class="list-group-item sidebar-comments-list-item">
                    <div class="list-group-item-heading">
                        <span class="comment-author">{{ $comment->nickname }}</span>
                        <span class="pull-right">[{{ $comment->created_at }}]</span>
                    </div>
                    <div class="list-group-item-text">
                        <a href=" {{ route('home.guestbook') . '#comment-' . $comment->id }}" title="评论来源: 留言"
                           rel="nofollow">
                            {{ $comment->content }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif
