@extends('layouts.app')


@section('page-title')
    Content Store
@endsection


@section('custom-styles')

@endsection


@section('content')

    <div class="container-fluid">
        <h1>Content Builder Store Place Holder</h1>

        <?php foreach($content as $item): ?>

        <?php 
        $tags = explode(',',$item->tags); 
        
        foreach($categories as $category){
            array_push($tags, $category->tags);
        }
        ?>

        <div class="content-card">
            <h3><?php echo $item->title; ?></h3>
            <div><?php echo $item->body; ?></div>
            <div>
                <?php foreach($tags as $tag): ?>
                <span class="label label-default"><?php echo $tag ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        

        <?php endforeach; ?>


    </div>

    
    
@endsection


@section('custom-scripts')
    
@endsection
