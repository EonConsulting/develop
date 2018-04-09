<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
    <div class='result-card shadow'>
        <div class='result-card-header'>
            {{ $content->title }}
        </div>
        <div class='result-card-body'>
            <div style='margin-bottom: 5px;'>
                @foreach(explode(',',$content->tags) as $tag)
                <span class='label label-default'>{{ $tag }}</span>
                @endforeach
            </div>

            {{ $content->description }}
        </div>
        <div class='result-card-footer'>
            <a href='{{ url('content/view/'.$content->id) }}' class='result-card-footer-leftbutton'><i class='fa fa-eye'></i></a>
            <a href='{{ url('content/update/'.$content->id) }}' class='result-card-footer-leftbutton'><i class='fa fa-pencil'></i></a>
        </div>
    </div>
</div>