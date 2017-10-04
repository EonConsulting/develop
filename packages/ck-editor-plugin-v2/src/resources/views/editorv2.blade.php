@extends('ckeditorpluginv2::layouts.master')

@section('content')

    <div>
        <div id="editor-wrapper">
            <form name="data" id="data" action="/cksavedata" method="POST">
                <textarea onkeyup="Preview.Update()" name="data" id="ltieditorv2inst"
                          class="ckeditor">&lt;p&gt;Initial editor contents.&lt;/p&gt;</textarea>
                <br/>
                <button id="submit" class="btn unisa-blue-btn" name="submit">Save Data</button>
            </form>
        </div>
        <div id="container"></div>
        <br/>
        <script type="text/x-mathjax-config">
         MathJax.Hub.Config({
         showProcessingMessages: false,
         tex2jax: { inlineMath: [['$','$'],['\\(','\\)']] }
         });
        </script>
        <script>
            /**
             * Create a New Instance of the CK Editor
             */

            CKEDITOR.replace('ltieditorv2inst', {
                extraPlugins: 'ltieditorv2,docprops,html2PDF,dialog,xml,templates,widget,lineutils,widgetselection,clipboard,mathjax',
                allowedContent: true,
                fullPage: true,
                mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG'
            });

            CKEDITOR.on('instanceReady',
                    function (evt) {
                        var editor = evt.editor;
                        //editor.execCommand('maximize');
                        editor.resize("100%", $('#editor-wrapper').height());

                    });

            CKEDITOR.document.appendStyleSheet("{{ url('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");
            CKEDITOR.instances.ltieditorv2inst.updateElement();


            //            window.addEventListener('message',function(event) {
            //                console.log('message received:  ' + event.data,event);
            //            },false);

            // CKEDITOR.config.allowedContent = true;
            {{--//document.appendStyleSheet("{{ url('/vendor/ckeditorpluginv2/css/custom-contents.css')}}");--}}


            //                                $('#submit').click(function (event) {
            //                                        event.preventDefault();
            //                                        CKEDITOR.instances.ltieditorv2inst.updateElement();
            //                                        var data = $('#ltieditorv2inst').val();
            //                                        $.ajax({
            //                                            url: '/cksavedata',
            //                                            context: document.body,
            //                                            type: 'post',
            //                                            data: {
            //                                                data: data
            //                                            },
            //                                            success: function (response) {
            //                                                console.log(response);
            //                                                $('#ltieditorv2inst').append(response) ;
            //                                            }
            //
            //                                        });
            //
            //                                    });

        </script>
    </div>



@endsection