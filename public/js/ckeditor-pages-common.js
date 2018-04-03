function init_editor(editor_id){

    var editor = {};
    
    

    editor = CKEDITOR.replace(editor_id, {
        //contentsCss : stylesheet_url,
        
        disableNativeSpellChecker: false,
        scayt_autoStartup: true,
        extraPlugins: 'sourcedialog,interactivegraphs,taoclient,ltieditorv2,mathjax,dialog,xml,templates,widget,lineutils,widgetselection,clipboard',
        removePlugins: 'wsc,sourcearea',
        allowedContent: true,
        fullPage: false,
        mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG'
    });

    editor.on('change', function() {
        body = editor.getData();
        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
    });
    
    editor.Height = '100%';

    return editor;
}
