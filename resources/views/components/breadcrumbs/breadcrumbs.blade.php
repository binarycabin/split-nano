<div class="breadcrumbs">
    @foreach($links as $url => $link)
        <a href="{{ $url }}"><span>{{ $link }}</span></a>
    @endforeach
</div>