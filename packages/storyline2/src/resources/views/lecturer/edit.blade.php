@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')
<link rel="stylesheet" href="{{ url('vendor/jstree-themes/bootstrap/style.css') }}" />

<style>

    .jstree-rename-input{
        color: #000 !important; 
    }

    .jstree-proton .jstree-themeicon-custom {
        width: 0px;
    }

    /*.jstree-icon:empty {
        width: 0px;
    }*/

</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">

            <div id="tree">

            </div>

        </div><!--End col-md-3 -->

        <div class="col-md-9">

        </div><!--End col-md-9 -->

    </div><!--End row -->

</div><!--End container-fluid -->

{{ csrf_field() }}

@endsection

@section('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
var base_url = "{{{ url('') }}}";
var url = base_url + "/storyline2/show_items/{{ $storyline_id }}";
</script>
<script src="{{ url('vendor/storyline2/editable-tree.js')}}"></script>



@endsection
