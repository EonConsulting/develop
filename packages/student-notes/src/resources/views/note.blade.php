@push('package-modals')

{{-- Create a note --}}
<div class="modal fade" id="create-note-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="{{ route('student-notes.store') }}" method="post" id="create-note-form">
                {{ csrf_field() }}
                <input type="hidden" name="storyline_item_id" value="" />

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create note</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="message">Note</label>
                        <textarea class="form-control" id="body" name="body" style="height: 200px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endpush

@push('package-js')

<script>

$(document).ready(function()
{
    function clearNoteForm()
    {
        $("#create-note-form [name='storyline_item_id']").val('');
        $("#create-note-form [name='body']").val('');
    }

    $(document).on("click", ".menu-btn, .bread-btn, .arrow-btn, .dropdown-btn", function()
    {
        $('#view-notes-link').data('item-id', $(this).data("item-id"));
        $('#create-note-link').data('item-id', $(this).data("item-id"));
    });

    $(document).on("click", "#create-note-link", function() {
        $("#create-note-form input[name='storyline_item_id']").val($(this).data("item-id"));
    });

    $(document).on( "click", ".delete-student-note", function(e) {
        e.preventDefault();

        $.ajax({
            type: "DELETE",
            url: $(this).attr("href"),
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function (data, textStatus, jqXHR)
            {
                swal('Successful', 'Note removed Successfully!', 'success');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Oops...', 'Something went wrong!', 'error');
            }
        });
    });

    $(document).on("click", "#view-notes-link", function() {
        var item_id = $(this).data("item-id");

        $.ajax({
            type: "GET",
            url: '{{ route('student-notes.index') }}',
            data: {storyline_item_id: item_id}, // serializes the form's elements.
            success: function (data, textStatus, jqXHR) {

                swal({
                    title: 'Notes',
                    width: '800px',
                    html: data.html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false
                });

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Oops...', 'Something went wrong!', 'error');
            }
        });
    });

    $("#create-note-form").submit(function(e) {

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(), // serializes the form's elements.
            success: function (data, textStatus, jqXHR)
            {
                clearNoteForm();

                $('#create-note-modal').modal('hide');

                swal('Successful', 'Note Created Successfully!','success');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                clearNoteForm();

                swal('Oops...', 'Something went wrong!', 'error');
            }
        });
    });
});
</script>

@endpush