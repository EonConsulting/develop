function init_editor(editor_id,stylesheet_url){

    var editor = {};

    editor = CKEDITOR.replace(editor_id, {
        contentsCss : stylesheet_url,
        extraPlugins: 'interactivegraphs,taoclient,ltieditorv2,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
        removePlugins: 'sourcearea',
        allowedContent: true,
        fullPage: false,
        mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG'
    });

    editor.on('change', function() {
        body = editor.getData();
        $("#content-preview").html(body);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
    });

    editor.Height = '100%';

    return editor;
}
