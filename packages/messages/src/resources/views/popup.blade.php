@push('package-modals')
    <div class="modal fade messages-wide" id="messages-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Messages</h4>
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
        .modal.messages-wide .modal-dialog {
            width: 70%;
        }
        .messages-wide .modal-body {
            overflow-y: auto;
        }
    </style>
@endpush

@push('package-js')
    <script>

        $(document).ready(function() {

            $(".messages-wide").on("show.bs.modal", function() {
                var height = $(window).height() - 200;
                $(this).find(".modal-body").css("max-height", height);
            });

            function messages_index(ajax_url)
            {
                $.ajax({
                    type: "GET",
                    url: ajax_url,
                    dataType: "json",
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#messages-modal").find('.modal-body').html(data.message);

                        if ( ! $('#messages-modal').hasClass('in') )
                        {
                            $("#messages-modal").modal('show');
                        }
                    },
                    error: function (data)
                    {
                        swal('Oops...', data.responseJSON.message, 'error');
                    }
                });
            }

            $(document).on( "click", ".messages-index-pagination", function(e)
            {
                e.preventDefault();
                messages_index($(this).attr("href"));
            });

            $(document).on( "click", "#messages-index", function(e)
            {
                e.preventDefault();

                var ajax_url = "{{ route('messages.index') }}";
                messages_index(ajax_url);
            });

            $(document).on( "click", ".messages-view", function(e)
            {
                e.preventDefault();

                messages_index($(this).attr("href"));

                $("#messages-modal").find('.messages-back-button').show();
            });

            $(document).on( "click", ".messages-back-button", function(e)
            {
                e.preventDefault();

                var ajax_url = "{{ route('messages.index') }}"
                messages_index(ajax_url);
                $("#messages-modal").find('.messages-back-button').hide();
            });

            $(document).on( "click", ".messages-delete", function(e)
            {
                e.preventDefault();

                var ajax_url = $(this).attr("href");
                var parent_dom = $(this).closest('tr');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "DELETE",
                    url: ajax_url,
                    dataType: "json",
                    success: function (data, textStatus, jqXHR)
                    {
                        $(parent_dom).fadeOut('slow', function(tr) {
                            $(this).remove();
                        });

                        swal('Successful', data.message, 'success');
                    },
                    error: function (data)
                    {
                        swal('Oops...', data.responseJSON.message, 'error');
                    }
                });
            });
        });

    </script>
@endpush