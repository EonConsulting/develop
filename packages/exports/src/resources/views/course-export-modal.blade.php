@push('package-modals')

    <div class="modal fade" id="course-exports" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Course Exports</h4>
            </div>

            <div class="modal-body">

                <a href="#" class="btn btn-info" role="button" id="export1">Export Off-line Solution</a>

                <a href="#" class="btn btn-info" role="button" id="export2">Export Course Item pdf's</a>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="course-singlepdf-exports" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Course Exports</h4>
            </div>

            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
@endpush

@push('package-js')
    <script>

function jsRoute(route, id)
{
    return route.substring(0, route.length - 1) + id;
}

        $(document).on("click", ".course-exports", function (e) {

            var item_id = $(this).data('id');

            $('#course-exports a[id="export1"]').attr("href",
                jsRoute('{{ route('export.full-html-export', 0) }}', item_id)
            );

            $('#course-exports a[id="export2"]').attr("href",
                jsRoute('{{ route('export.full-pdf-export', 0) }}', item_id)
            );
        });

    </script>
@endpush