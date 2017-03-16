@extends('ckeditorpluginv2::layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form name="save-data" id="save-data" action="/cksavedata">
                <textarea id="ltieditorv2inst" class="ckeditor">&lt;p&gt;Initial editor contents.&lt;/p&gt;</textarea>
                    <br />
                    <button id="submit" class="btn" name="submit">Save Data</button>
                </form>
                <script>
                    /**
                     * Create a New Instance of the CK Editor
                     */

                        CKEDITOR.replace('ltieditorv2inst', {
                            extraPlugins: 'ltieditorv2'
                        },
                            config.allowedContent = true
                        )

                        CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");
//                        CKEDITOR.config.allowedContent = true;
                        {{--//document.appendStyleSheet("{{URL::asset('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");--}}


                    $('#submit').click(function (event) {
                            event.preventDefault();
                            CKEDITOR.instances.ltieditorv2inst.updateElement();
                            var data = $('#ltieditorv2inst').val();
                            $.ajax({
                                url: '/cksavedata',
                                context: document.body,
                                type: 'post',
                                data: {
                                    data: data
                                },
                                success: function (response) {
//                                    alert(data); // Get Current Editor Data.
//                                    console.log(response);
                                }

                            });

                        });

                </script>
            </div>

        </div>


    </div>


@endsection