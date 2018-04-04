<div class='pag'>

    {{-- Previous Page Link --}}
    @if ($items->onFirstPage())
        <button class='btn btn-default disabled pull-left'>Previous</button>
    @else
        <a href='{{ $items->previousPageUrl() }}' class='btn btn-default pull-left btn-prev-page'>Previous</a>
    @endif

    Showing <strong>{{($items->currentpage()-1) * $items->perpage()+1}}</strong> to

    @if($items->currentpage() * $items->perpage() < $items->total())
        <strong>{{$items->currentpage() * $items->perpage()}}</strong>
    @else
        <strong>{{$items->total()}}</strong>
    @endif

    of <strong>{{$items->total()}}</strong> results

    {{-- Next Page Link --}}
    @if ($items->hasMorePages())
        <a href='{{ $items->nextPageUrl() }}' class='btn btn-default pull-right btn-next-page'>Next</a>
    @else
        <button class='btn btn-default disabled pull-right'>Next</button>
    @endif

</div>