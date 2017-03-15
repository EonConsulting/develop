@extends('ckeditorpluginv2::layouts.master')

@section('custom-styles')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <textarea id="ltieditorv2inst" class="ckeditor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>

                <script>
                    /**
                     * Create a New Instance of the CK Editor
                     */
                    CKEDITOR.replace( 'ltieditorv2inst', {
                                // Load the Course Content Plugin to the Editor
                                extraPlugins: 'ltieditorv2',
                            },
                            config.allowedContent = true
                    );
                </script>
                <script>

                    function onGetClick(event) {
                        //We are not passing any data we are simply requesting data
                        $.get();
                    }
                    function onSuccess(data, status, xhr){
                        console.log(data, status, xhr);

                        console.log(String(data.value).toUpperCase());
                    }

                    $('button#getResponse').on('click', onGetClick);


                </script>
            </div>

        </div>


    </div>


@endsection