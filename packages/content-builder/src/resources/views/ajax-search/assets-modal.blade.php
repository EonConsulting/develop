@push('package-modals')
    <div id="assetsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Import Asset</h4>
                </div>

                <div class="modal-body import-list">

                    <form action="{{ route('content-builder.asset-search.show') }}" method="post" id="assetsModal-form">
                        <div class="form-inline">

                            <div class="form-group">
                                <input type="text" id="searchterm" class="form-control" name="searchterm" placeholder="Enter a search term">
                            </div>

                            <button type="submit" class="btn btn-primary" id="btnSearch">Search</button>
                            <button type="button" class="btn btn-info" id="btnReset">Reset</button>
                        </div>
                    </form>

                    <br/><br/>

                    <div id="assetsModal-content"></div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#assetsModal"><i class="fa fa-save"></i><span> Cancel</span></button>
                </div>
            </div>

        </div>
    </div>
@endpush

@push('package-js')

    <script>
        $(document).ready(function(){

            $('#assetsModal').on('shown.bs.modal', function(event){

                $('form#assetsModal-form input[name="searchterm"]').val('');

                $.ajax({
                    method: "GET",
                    url: "{{ route('content-builder.asset-search.index') }}",
                    success: function(response)
                    {
                        $( '#assetsModal' ).find('#assetsModal-content').html(response.content);
                    }
                });
            });

            $(document).on('submit', 'form#assetsModal-form', function() {

                event.preventDefault();

                var form = $(this);

                $.ajax({
                    method: "POST",
                    url: $(form).attr('action'),
                    data : $(form).serialize(),
                    success: function(response)
                    {
                        $( '#assetsModal' ).find('#assetsModal-content').html(response.content);
                    }
                });

            });

            $(document).on('click', '.import-asset', function(event)
            {
                $asset_id = $(this).data("asset-id");
                importAsset($asset_id);
            });

            function importAsset(asset)
            {
                actionUrl = base_url + "/content/assets/" + asset;

                $.ajax({
                    method: "GET",
                    url: actionUrl,
                    contentType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    statusCode: {
                        200: function (data)
                        {
                            var html ='<div style="display: inline-block;" data-asset-id=' + asset + '>';

                            if(data['content'] !== null)
                            {
                                html += data['content'];
                            }

                            html +=  data['html'];
                            html += '</div>';

                            CKEDITOR.instances['ltieditorv2inst'].insertHtml(html);

                            $('#assetsModal').modal('hide');

                        }
                    }
                });
            }
        });
    </script>

@endpush