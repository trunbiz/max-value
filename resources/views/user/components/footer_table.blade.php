@if(isset($items))
    @if(empty($items->count()))
        <div class="text-center" style="padding: 20px;">
            No data !
        </div>
    @else
        <div style="padding: 20px;">
            {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>

    @endif
@endif
