{!! Former::open($url)->method('DELETE') !!}
<button type="submit" class="btn btn-link text-red btn-sm">
    @if(!empty($deleteLabel)) {{ $deleteLabel }} @else Delete @endif
</button>
{!! Former::close() !!}