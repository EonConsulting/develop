@push('package-modals')
    <div id="importModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Import Content</h4>
                </div>

                <div class="modal-body import-list">

                    <form action="{{ route('content-builder.content-search.show') }}" method="post" id="importModal-form">
                        <input type="hidden" name="is_content_builder" value="{{ $content_builder ?? false }}">
                        <div class="form-inline">

                            <div class="form-group">
                                <input type="text" id="searchterm" class="form-control" name="searchterm" placeholder="Enter a search term">
                            </div>

                            <button type="submit" class="btn btn-primary" id="btnSearch">Search</button>
                            <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                        </div>
                    </form>

                    <br/><br/>

                    <div id="importModal-content"></div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#importModal"><i class="fa fa-save"></i><span> Cancel</span></button>
                </div>
            </div>

        </div>
    </div>
@endpush

@push('package-js')

    <script>
        $(document).ready(function(){

            $('#importModal').on('shown.bs.modal', function(event){

                $('form#importModal-form input[name="searchterm"]').val('');

                $.ajax({
                    method: "GET",
                    data : {
                        is_content_builder: "{{ $content_builder ?? false }}"
                    },
                    url: "{{ route('content-builder.content-search.index') }}",
                    success: function(response)
                    {
                        $( '#importModal' ).find('#importModal-content').html(response.content);
                    }
                });
            });

            $(document).on('submit', 'form#importModal-form', function() {

                event.preventDefault();

                var form = $(this);

                $.ajax({
                    method: "POST",
                    url: $(form).attr('action'),
                    data : $(form).serialize(),
                    success: function(response)
                    {
                        $( '#importModal' ).find('#importModal-content').html(response.content);
                    }
                });

            });


            @if(isset($content_builder))
            $(document).on("click", ".content-action", function(){
                $cont_id = $(this).data("content-id");
                getContent($cont_id);
            });
            @endif
        });
    </script>
@endpush