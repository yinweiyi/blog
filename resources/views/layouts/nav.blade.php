<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-navbar-collapse" aria-expanded="false"><span class="sr-only">下拉菜单</span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a href="{{ route('home.index') }}" class="navbar-brand">{{ $site['title'] ?? '博客' }}
                | {{$site['sub_title'] ?? ''}}</a></div>
        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav top-navbar-nav">
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home.index') }}">首页</a></li>

                @foreach($categories as  $category)
                    <li class="{{ request()->is('category/' . $category->slug) || request()->is(array_map(fn($item) => 'category/' . $item->slug, $category->children)) ? 'active' : '' }}  dropdown">
                        @if(count($category->children) > 0)
                            <a href="javascript:void(0)" class="dropdown-toggle"
                               data-toggle="dropdown">{{ $category->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($category->children as $childItem)
                                    <li>
                                        <a href="{{ route('home.index_category', ['category' => $childItem->slug]) }}">{{ $childItem->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ route('home.index_category', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        @endif

                    </li>
                @endforeach

                <li class="{{ request()->is('image') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">AI图片 <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('image.index')}}">全部</a></li>
                        @foreach($imageModels as $imageModel)
                            <li>
                                <a href="{{ route('image.index') . '?model_id=' . $imageModel->id }}">{{ $imageModel->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="{{ request()->is('guestbook*') ? 'active' : '' }}">
                    <a href="{{ route('home.guestbook') }}">留言</a>
                </li>
            </ul>
            @if(!(request()->is('image') || request()->is('guestbook')))
                <form id="search-form" class="navbar-form navbar-right" role="search" target="_blank"
                      action="{{ route('home.index') }}" method="get">
                    <div class="form-group">
                        <input type="text" id="q" name="q" class="form-control" data-provide="typehead"
                               autocomplete="off"
                               placeholder="输入关键词查找">
                    </div>
                    <input type="submit" class="btn btn-default" id="submitsearch" value="搜索">
                </form>
            @endif
        </div>
    </div>
</nav>
