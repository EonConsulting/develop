@extends('ckeditorpluginv2::layouts.master')

@section('content')

            <div>
                <div id ="editor-wrapper">
                <form name="save-data" id="save-data" action="/cksavedata">
                <textarea id="ltieditorv2inst" class="ckeditor">&lt;p&gt;Initial editor contents.&lt;/p&gt;</textarea>
                    <br />
                    <button id="submit" class="btn unisa-blue-btn" name="submit">Save Data</button>
                </form>
                </div>
                <script>
                    /**
                     * Create a New Instance of the CK Editor
                     */

                        CKEDITOR.replace('ltieditorv2inst', {
                            extraPlugins: 'ltieditorv2'
                        },
                            config.allowedContent = true
                        );

                        CKEDITOR.on('instanceReady',
                        function (evt)
                        {
                            var editor = evt.editor;
                            //editor.execCommand('maximize');
                            editor.resize("100%", $('#editor-wrapper').height());

                        });

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
                                    console.log(response);
                                    $('#ltieditorv2inst').append(response) ;
                                }

                            });

                        });

                </script>
            </div>



@endsection