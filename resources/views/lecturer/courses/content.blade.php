@extends('layouts.app')

@section('custom-styles')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading"><strong>{{ $course->title }}</strong> Content</div>
                    <table class="panel-body table table-hover table-striped" id="courses-table">
                        <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-5">Name</th>
                            <th class="col-md-2">File Name</th>
                            <th class="col-md-2">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->file_name }}</td>
                                <td><a href="{{ route('courses.single.content.item', [$course->id, $item->id]) }}" class="btn btn-success btn-xs">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('custom-scripts')
    <script src="{{ url('/js/app.js') }}"></script>

    <script>
        $(document).ready(function($) {
            var _token = $('#tok').val();

            $('.clickable-row').on('click', '.manage-course', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var group_id = $(this).data('courseid');

                $('.clickable-row[data-courseid="' + group_id + '"]').hide();
            });

            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
        function search() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("txt_search");
            filter = input.value.toLowerCase();
            table = document.getElementById("courses-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
