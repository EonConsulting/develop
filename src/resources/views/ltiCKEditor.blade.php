@extends('ckeditorplugin::layouts.master')

@section('custom-styles')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
          <textarea id="ckeditorplugin" class="ckeditor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>

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
                </script>
            </div>

        </div>


    </div>


@endsection