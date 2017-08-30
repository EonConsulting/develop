<link rel="stylesheet" href="{{ url('/vendor/csvfileupload/css/fileinput.min.css') }}">

<input id="input-id" type="file" name="csv" class="file-loading" data-preview-file-type="image">
<div id="kv-error-1" style="margin-top:10px;display:none"></div>
<div id="kv-success-1" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
<!-- Global JS Config -->
<script src="{{ url('/js/global-config.js') }}"></script>
<!-- the main fileinput plugin file -->
<script src="{{ url('/vendor/csvfileupload/js/fileinput.js') }}"></script>

<script>
    var filetype = '{{ $filetype }}';
    var course_id = '{{ $course }}';

   $("#input-id").fileinput({
        uploadUrl: ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '' ) + "/lecturer/csv/storeStoryline/" + course_id, // server upload action
        uploadAsync: true,
        showPreview: true,
        allowedFileExtensions: [filetype],
        maxFileCount: 1,
        elErrorContainer: '#kv-error-1',
        uploadExtraData: function() {
            return {
                token: '{{ csrf_token() }}',
                filetype: filetype
            };
        }
    }).on('filebatchpreupload', function(event, data, id, index) {
        $('#kv-success-1').html('<h4>Upload Status</h4><ul></ul>').hide();
    }).on('fileuploaded', function(event, data, id, index) {
        var fname = data.files[index].name,
            out = '<li>' + 'Uploaded file # ' + (index + 1) + ' - '  +
                fname + ' successfully.' + '</li>';
        $('#kv-success-1 ul').append(out);
        $('#kv-success-1').fadeIn('slow');
        setTimeout(function(){
            location.reload();
        },3000)
    });
</script>
