<div class='pag'>
    @if($meta['fromPrev'] >= 0)
    <a href='#' class='btn btn-default pull-left btn-prev-page'>Previous</a>
    @else
    <button class='btn btn-default disabled pull-left'>Previous</button>
    @endif

    Showing 
    <strong>{{ $meta['fromNext'] - ($meta['size'] - 1) }}</strong>
        to 

    
    @if($meta['fromNext'] < $meta['total'])
    <strong>{{ $meta['fromNext'] }}</strong>
    @else
    <strong>{{ $meta['total'] }}</strong>
    @endif
    
        of 

    <strong>
    {{ $meta['total'] }}
    </strong>
    
        results

    @if($meta['fromNext'] < $meta['total'])
    <a href='#' class='btn btn-default pull-right btn-next-page'>Next</a>
    @else   
    <button class='btn btn-default disabled pull-right'>Next</button>
    @endif
</div>