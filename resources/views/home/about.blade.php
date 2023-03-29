@extends('master')

@section('container')
    <div class="row">
        <div class="col-md-8 blog-main">
            <div id="article" class="well">
                @forelse($abouts as $about)
                    <h2><strong>{{ $about->title }}</strong></h2>
                    <hr>
                    {!! $about->html !!}
                @empty
                    暂无关于
                @endforelse
            </div><!-- /.blog-main -->
            @if($abouts->count())
                <div id="comments" style="height: auto !important;">
                    @if($abouts->first()->comments_count)
                        <h3> 关于 : 目前有 {{ $abouts->first()->comments_count }} 条评论</h3>
                        @include('layouts.comments')
                        <div>
                            {{ $comments->render() }}
                        </div>
                    @endif
                    @include('layouts.comment', ['id' => $abouts->first()->id, 'type' => 'about'])
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
