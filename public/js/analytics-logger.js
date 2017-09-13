var jQueryScript = document.createElement('script');
jQueryScript.setAttribute('src','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
jQueryScript.setAttribute('src','http://code.jquery.com/qunit/git/qunit.js');
document.head.appendChild(jQueryScript);

$.ajax({
    method: "PUT",
    url: global_conf.subdir + '/lecturer/courses/create/metadata',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
        200: function (data) {
            dataSet = data;
            // using lodash to get the metadata types
            var mtypes = _.groupBy(data, "metadata_type");
            $.each(mtypes, function (idx, obj) {
                var option = new Option(idx, obj.metadata_type);
                $("#metadata_store_list").append($(option));
            });
        },
        400: function () {
        },
        500: function () {
        }
    }
}).error(function (data) {
});