@extends('layouts.app')

@section('page-title')
    Storyline Student Single
@endsection


@section('custom-css')

<style>

    
    .item-tree {



    }

    .item-tree a {



    }

    .item-tree ul {
        list-style-type: none;


    }

    .item-tree ul li {



    }


</style>
    
@endsection


@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="col-md-3">
            
            <div class="item-tree">
                <?php echo $items; ?>
            </div>

        </div><!--End col-md-3 -->

        <div class="col-md-9">

        </div><!--End col-md-9 -->

    </div><!--End row -->

</div><!--End container-fluid -->

@endsection



@section('exterior-content')

@endsection



@section('custom-scripts')


@endsection
