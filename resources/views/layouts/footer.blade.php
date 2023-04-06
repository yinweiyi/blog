<footer class="footer">
    <p> Copyright © 2010-2020
        访问 : {{ $visitCount }} 次
        <a href="{{ route('home.index') }}">{{ $site['title'] ?? '' }}</a>
        <a href="https://beian.miit.gov.cn" target="_blank" rel="nofollow">{{ $site['icp'] ?? '' }}</a>

        @if(!empty($site['beian']))
            <img style="display: inline-block; margin-left: 5px" src="{{ asset('images/beian.png') }}"/>
            <a target="_blank"
               href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ find_number($site['beian']) }}">
                {{ $site['beian'] }}
            </a>
        @endif
    </p>
</footer>
