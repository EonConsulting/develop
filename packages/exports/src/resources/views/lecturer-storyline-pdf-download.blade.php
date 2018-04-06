@push('package-js')
    <script>
        $(document).on("click", "#d-pdf", function (e) {

            var item_id = $('#item-id').val();

            var route = '{{ route('export.single-pdf-download', 0) }}';

            route = route.substring(0, route.length - 1) + item_id;

            $.ajax({
                type: 'GET',
                url: route,
                processData: false,
                success: function ()
                {
                    window.location = route;
                },
                error: function (xhr)
                {
                    swal.close();
                    swal('Oops...', xhr.responseJSON.message, 'error');
                }
            });

            e.preventDefault(); //otherwise a normal form submit would occur
        });
    </script>
@endpush