@extends('layouts.app')


@section('page-title')
    View Content
@endsection


@section('custom-styles')



@endsection


@section('content')

    <div class="container-fluid">

        <div class="content-page shadow">

            <a href="#" class="pull-right" style="font-size: 16px; margin-left: 15px;"><i class="fa fa-trash"></i><span class="hidden-xs"> Delete</span></a>
            <a href="{{ url('content/edit/'.$content->id) }}" class="pull-right" style="font-size: 16px; margin-left: 15px;"><i class="fa fa-pencil"></i><span class="hidden-xs"> Edit</span></a>
            
            <h3 style="margin: 0px;"><?php echo $content->title; ?></h3>
            <hr>
            <div>
                <?php echo $content->body; ?>
            </div>
        
        </div>
        <div style="margin: 15px;">
            <span>Tags: </span>
            <?php foreach($content->tags as $tag => $count): ?>
            <span class="label label-default"><?php echo $tag ?></span>
            <?php endforeach; ?>
        </div>
       
    </div>

@endsection


@section('custom-scripts')
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG"></script>


@endsection
