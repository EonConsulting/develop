@extends('layouts.app')


@section('page-title')
    Content Store
@endsection


@section('custom-styles')
<link href="{{url('/vendor/appstore/css/radio-checkbox.css')}}" rel="stylesheet" />

    <style>
        .filters {width: 180px; padding-left: 15px; float: left;}
        .filters h1 {font-size: 20px; color: #c2c2c2;}

        .results {margin-left: 180px;}

        .search {padding: 0px 15px 0px 15px;}
    </style>
    

@endsection


@section('content')

    <div>
        <div class="filters">
            <h1>Category</h1>

            <div class="form-group">

                <div class="radio">
                    <input id="categories" name="category" type="radio" value="all" ng-model="orderList">
                    <label for="category">
                        All
                    </label>
                </div>
                <?php foreach($categories as $category): ?>

                    <div class="radio">
                        <input id="radio<?php echo $category->id; ?>" name="category" type="radio" value="<?php echo $category->id; ?>" ng-model="orderList">
                        <label for="radio<?php echo $category->id; ?>">
                            <?php echo $category->name; ?>
                        </label>
                    </div>

                <?php endforeach; ?>
            </div>  
        </div>
        
        <div class="results"> 
            <div class="search">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" class="form-control" name="search" placeholder="Enter a search term">
                </div>
            </div>

            <div class="container-fluid sp-top-15">

                <?php foreach($content as $item): ?>

                <div class="content-card shadow">
                    <div class="content-card-header">
                        <?php echo $item->title; ?>
                    </div>
                    <div class="content-card-body">
                        <div style="margin-bottom: 5px;">
                            <?php foreach($item->tags as $tag => $count): ?>
                            <span class="label label-default"><?php echo $tag ?></span>
                            <?php endforeach; ?>
                        </div>

                        <?php echo $item->description; ?>
                    </div>
                    <div class="content-card-footer">
                        <a href="{{ url('content/view/'.$item->id) }}" class="content-card-footer-leftbutton"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('content/update/'.$item->id) }}" class="content-card-footer-leftbutton"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="content-card-footer-rightbutton"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
                

                <?php endforeach; ?>
            </div>

        </div>
    
    </div>
    
    
    

    
    
@endsection


@section('custom-scripts')
    
@endsection
