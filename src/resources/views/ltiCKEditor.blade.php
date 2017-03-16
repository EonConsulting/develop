@extends('ckeditorplugin::layouts.master')

@section('custom-styles')
@endsection

@section('content')

    <div class="container">
        <div class="row">
         <form name="save" id="save" action="/ckesavedata">
          <textarea id="ckeditorplugin" class="ckeditor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
             <br />
             <button id="submit" class="btn" name="submit">Save Data</button>
             <input type="hidden" id="token" value="{{ csrf_token() }}"/>
         </form>
                <script>
                    /**
                     * Create a New Instance of the CK Editor
                     */
                    CKEDITOR.replace( 'ckeditorplugin', {
                        // Load the Course Content Plugin to the Editor
                       extraPlugins: 'coursecontent',
                    },
                        config.allowedContent = true
                    );
                    CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorplugin/css/custom-contents.css')}}");

                    $('#submit').click(function (event) {
                        event.preventDefault();
                        CKEDITOR.instances.ckeditorplugin.updateElement();
                        var data = $('#ckeditorplugin').val();
                        $.ajax({
                            url: '/ckesavedata',
                            context: document.body,
                            data: {
                                data: data
                            },
                            success: function (response) {
                                alert(data); // Get Current Editor Data.
                                console.log(response);
                            }

                        });

                    });

                </script>
            </div>


    </div>


@endsection