@extends('master')

@section('container')
    <div class="row">
        <div class="col-md-8 blog-main">
            <div id="article" class="well">
                {!! $guestbook->value['content'] ?? '欢迎灌水交流，别看我长时间不发博，博主可一直都在线~' !!}
            </div><!-- /.blog-main -->

            @if($guestbook)
                <div id="comments" style="height: auto !important;">
                    @if($guestbook->comments_count)
                        <h3> 留言 : 目前有 {{ $guestbook->comments_count }} 条评论</h3>
                        @include('layouts.comments')
                        <div>
                            {{ $comments->render() }}
                        </div>
                    @endif

                    @if($guestbook->value['can_comment'] ?? false)
                        @include('layouts.comment', ['id' => $guestbook->id, 'type' => 'guestbook'])
                    @endif
                </div>
            @endif
        </div>
        <div class="col-md-4">
            @include('layouts.tags')
            @include('layouts.hots')
            @include('layouts.newest_comments')
        </div>

    </div><!-- /.row -->
@endsection
