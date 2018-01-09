<script src="{{ url('/vendor/html-to-pdf/jquery.fileDownload.js') }}"></script>
<script>
    $(document).on("click", "#convert-html-to-pdf", function (e) {

        swal({
            title: "Loading",
            text:  "We are preparing your PDF, please wait...",
            type: "info",
            timer: 3000,
            showConfirmButton: false
        });

        $.fileDownload('{{ route("html-to-pdf.store") }}', {
            data: {
                html_content: encodeURIComponent($("div#body").html()),
                '_token': '{{ csrf_token() }}'
            },
            httpMethod: "POST",
        })
        .success(function () {
            swal.close();
            swal('Success', 'Downloading PDF!', 'success');
        })
        .fail(function () {
            swal.close();
            swal('Oops...', 'Something went wrong!', 'error');
        });

        e.preventDefault(); //otherwise a normal form submit would occur
    });
</script>