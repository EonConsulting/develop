@extends('layouts.app')

@section('page-title')
Storyline Student Single
@endsection


@section('custom-styles')
<link rel="stylesheet" href="{{ url('vendor/jstree-themes/bootstrap/style.css') }}" />

<style>



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

@endsection

@section('custom-scripts')

<script>
    var url = "{{{ url('') }}}" + "/storyline2/json-render"; //add storyline_id: .../json-render/storyline_id
    var tree_id = "#tree";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script src="{{ url('vendor/storyline2/editable-tree.js')}}"></script>

<script>
    $(document).ready(function () {
        $(tree_id).on("rename_node.jstree", function (e, data) {
            var ref = data.node;
            renameNode(ref);

        });

        function renameNode(data) {
            var actionUrl = "{{{ url('') }}}" + "/storyline2/rename";
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: {"data": data, "_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data.msg === 'failed') {
                        alert('Rename failed, please try again.');
                    } else {
                        $.getJSON(url,
                                function (data) {
                                    console.log(data);
                                    renderTree(data);
                                    treeToJSON();
                                }
                        );
                    }
                },
                error: function (req, status, error) {
                    alert(error);
                }
            });

        }
    });


</script>


@endsection
