@push('package-modals')
<div class="modal fade auditing-wide" id="auditing-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Module Auditing</h4>
            </div>

            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info auditing-back-button" style="display: none;">Back</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('package-css')
<style>
.modal.auditing-wide .modal-dialog {
    width: 90%;
}
.auditing-wide .modal-body {
    overflow-y: auto;
}
</style>
@endpush

@push('package-js')
<script>

    $(document).ready(function() {

        $(".auditing-wide").on("show.bs.modal", function() {
            var height = $(window).height() - 200;
            $(this).find(".modal-body").css("max-height", height);
        });

        function call_auditing_route(storylineItem, ajax_url)
        {
            if(ajax_url == null)
            {
                var ajax_url = "{{ route('auditing.content.index', 0) }}".slice(0,-1) + storylineItem;
            }

            $.ajax({
                type: "GET",
                url: ajax_url,
                success: function (data, textStatus, jqXHR)
                {
                    $("#auditing-modal").find('.modal-body').html(data.message);

                    if ( ! $('#auditing-modal').hasClass('in') )
                    {
                        $("#auditing-modal").modal('show');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal('Oops...', 'Something went wrong!', 'error');
                }
            });
        }

        $(document).on( "click", ".auditing-index-pagination", function(e)
        {
            e.preventDefault();
            call_auditing_route(null, $(this).attr("href"));
        });

        $(document).on( "click", "#auditing-index", function(e)
        {
            e.preventDefault();
            call_auditing_route($("#item-id").attr('value'), null);
        });

        $(document).on( "click", ".auditing-view", function(e)
        {
            e.preventDefault();

            var ajax_url = "{{ route('auditing.content.show', ['audit' => 0]) }}".slice(0,-1)
                         + $(this).data('audit-id');

            call_auditing_route(null, ajax_url);

            $("#auditing-modal").find('.auditing-back-button').show();
            $("#auditing-modal").find('.auditing-back-button').data('item-id', $("#item-id").attr('value'));
        });

        $(document).on( "click", ".auditing-back-button", function(e)
        {
            e.preventDefault();

            call_auditing_route($(this).data('item-id'), null);
            $("#auditing-modal").find('.auditing-back-button').hide();
        });

    });

</script>
@endpush