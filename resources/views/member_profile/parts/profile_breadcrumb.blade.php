<ul class="breadcrumb">
    @foreach ($breadcrumb as $item)
        @if (!empty($item['url']))
            <li><a href="{{ $item['url'] }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
        @else
            <li><span>{{ $item['title'] }}</span></li>
        @endif
    @endforeach
</ul>
