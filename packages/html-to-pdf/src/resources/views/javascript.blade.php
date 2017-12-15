<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-ajax-downloader@1.1.0/src/ajaxdownloader.min.js"></script>
<script>
    $('#convert-html-to-pdf').click(function(event) {

        event.preventDefault();

        $.AjaxDownloader({
            url  : "{{ route("html-to-pdf.store") }}",
            data : {
                html_content: encodeURIComponent($('div#body').html()),
                '_token': '{{ csrf_token() }}'
            }
        });
    });
</script>