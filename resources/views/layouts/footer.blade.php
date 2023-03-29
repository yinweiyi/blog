<footer class="footer">
    <p> Copyright © 2010-2020
        访问 : {{ $visitCount }} 次
        <a href="{{ route('home.index') }}">{{ $configs['title'] ?? '' }}</a>
        <a href="https://beian.miit.gov.cn" target="_blank" rel="nofollow">{{ $configs['icp'] ?? '' }}</a>

        @if($configs['beian'])
            <img style="display: inline-block; margin-left: 5px" src="{{ asset('images/beian.png') }}"/>
            <a target="_blank"
               href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ find_number($configs['beian']) }}">
                {{ $configs['beian'] }}
            </a>
        @endif
    </p>
</footer>
