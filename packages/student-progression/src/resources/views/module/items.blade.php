
        <div class="col-xs-12">
            <li class="list-group-item">
                <h2> {!! $item['text'] !!}</h2>
                <p> {!! $item['body'] !!}</p>
            </li>
            @if(isset($item['children']))    
            <ol class="list-group"> 
                @each('student-progression::module.items', $item['children'], 'item')  
            </ol>
            @endif
        </div>
    