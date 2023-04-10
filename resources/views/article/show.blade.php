@extends('master')

@section('title', $article->title)
@section('keywords', $article->keywords)
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/highlight/styles/atelier-forest-light.css') }}" />
@endsection
@section('container')
    <div class="row">
        <div class="col-md-8">
            <div id="article" class="well"> 当前位置：
                <a href="{{ route('home.index') }}" title="{{ $config['title'] ?? '' }}">博客首页</a>&gt;&gt;
                <a href="{{ route('home.index_category', ['category' => $article->category->slug]) }}">{{ $article->category->name }}</a>
                &gt;&gt; 阅读正文
                <h2 class="blog-post-title">
                    {{ $article->title }}
                </h2>
                <p class="info"><span class="meat_span">作者: {{ $config['author'] ?? '' }}</span>
                    <span class="meat_span">分类:
                        <a href="{{ route('home.index_category', ['category' => $article->category->slug]) }}"
                           rel="category tag">{{ $article->category->name }}</a>
                    </span> <span class="meat_span">发布于: {{ $article->created_at }}</span>
                    <span class="meat_span">浏览：{{ number_format($article->views) }}</span>
                    <span class="meat_span">
                        <a href="{{ request()->fullUrl() . '#comments' }}">评论({{ $article->comments_count }})</a></span>
                </p>
                <hr>
                <div class="text">
                    {!! $article->html !!}
                </div>
                <div class="alert alert-success"> &nbsp; &nbsp; &nbsp; &nbsp;
                    <div class="post-copyright">
                        <p>
                            转载时请注明出处及相应链接。
                        </p>
                        <p>本文永久链接: {{ request()->url() }}</p>
                    </div>
                </div>
            </div>
            <ul class="pager post-pager">
                @if(!is_null($last))
                    <li class="previous">
                        <a href="{{ route('article.show',['slug' => $last->slug]) }}" rel="prev">上一篇</a>
                    </li>
                @endif
                @if(!is_null($next))
                    <li class="next">
                        <a href="{{ route('article.show', ['slug' => $next->slug]) }}" rel="next">下一篇</a>
                    </li>
                @endif
            </ul>
            @if($article->comments_count)
                <div id="comments" style="height: auto !important;">
                    <h3> {{ $article->title }} : 目前有 {{ $article->comments_count }} 条评论</h3>
                    @include('layouts.comments')
                </div>
            @endif
            <div>
                {{ $comments->links() }}
            </div>
            @include('layouts.comment', ['id' => $article->id, 'type' => 'article'])
        </div><!-- /.blog-main -->
        <div class="col-md-4">
            @include('layouts.tags')
            @include('layouts.hots')
            @include('layouts.newest_comments')
        </div>
    </div><!-- /.row -->
@endsection
@section('js')
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
