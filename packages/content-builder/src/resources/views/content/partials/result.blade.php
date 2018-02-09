<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
    <div class='result-card shadow'>
        <div class='result-card-header'>
            {{ $item->title }}
        </div>
        <div class='result-card-body'>
            <div style='margin-bottom: 5px;'>
                @foreach(explode(',',$item->tags) as $tag)
                <span class='label label-default'>{{ $tag }}</span>
                @endforeach
            </div>

            {{ $item->description }}
        </div>
        <div class='result-card-footer'>
            <a href='{{ url('content/view/'.$item->id) }}' class='result-card-footer-leftbutton'><i class='fa fa-eye'></i></a>
            <a href='{{ url('content/update/'.$item->id) }}' class='result-card-footer-leftbutton'><i class='fa fa-pencil'></i></a>
            <a href='#' class='result-card-footer-rightbutton'><i class='fa fa-trash'></i></a>
        </div>
    </div>
</div>