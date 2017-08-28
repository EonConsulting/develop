@extends('eon.lti::app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h1 class="topic-list-header">Department of Economics</h1>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="row subtopic-cards">
                <div class="col s12">

                    <div class="row">

                        @foreach($taxonomy as $config => $item)
                            <div class="col s3">
                                <a class="topic-container" href="{{ route('lti.config', $config) }}">
                                    <img src="{{ (array_key_exists('img', $item) && $item['img'] != '') ? ((strpos($item['img'], 'http') !== false) ? $item['img'] : '/vendor/storyline/core/images/' . $item['img']) : 'http://placehold.it/240x200' }}" alt="" class="img responsive-img">
                                    <div class="card-title">
                                        {{ $item['title'] }}
                                    </div>
                                    <!-- Hover description -->
                                    <!-- <div class="card-description">
                                        {{--{!! str_replace(' ', '', strip_tags($item['summary'])) !!}--}}
                                    </div> -->
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection