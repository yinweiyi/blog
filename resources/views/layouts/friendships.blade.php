@if(!$friendships->isEmpty())
    <div class="panel panel-default">
        <div class="panel-heading">友情链接</div>

        <table class="table friendship-link">
            <tbody>
            @foreach($friendships as $links )
                <tr>
                    @foreach($links as $link)
                        <td><a href="{{ $link->link }}" title="{{ $link->title }}"
                               target="_blank">{{ $link->title }}</a></td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endif
