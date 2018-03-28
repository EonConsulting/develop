@push('package-modals')
    <div class="modal fade pdf-generation-wide" id="pdf-generation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Errors</h4>
                </div>

                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info messages-back-button" style="display: none;">Back</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('package-css')
    <style>
        .modal.pdf-generation-wide .modal-dialog {
            width: 70%;
        }
        .pdf-generation-wide .modal-body {
            overflow-y: auto;
        }
    </style>
@endpush

@push('package-js')
    <script>

        $(".pdf-generation-wide").on("show.bs.modal", function() {
            var height = $(window).height() - 200;
            $(this).find(".modal-body").css("max-height", height);
        });

        $(document).on("click", "#btnsbmit", function(){

            $('#pdf-generation-alert').hide(true);
            $('#pdf-generation-alert p.text-area').html('');
        });

    </script>
@endpush