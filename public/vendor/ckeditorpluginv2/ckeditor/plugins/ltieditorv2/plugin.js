/**
 * @Author Peace Ngara
 * @Ck Editor Version 2 Plugin - Alias ltiv2plugin
 * @file Overview CK Editor LTI Appstore Acceess Component
 *
 */

/**
 * Fired When the User clicks the LTI Button on the Toolbar
 * @since 1.0
 * @event click
 * @member CKEDITOR.editor
 *
 */

console.log("Subdir is set to: " + config["subdir"]);
(function () {
    var iframeWindow = null;
    CKEDITOR.plugins.add('ltieditorv2',
            {
                requires: ['iframedialog'],
                init: function (editor)
                {
                    var me = this;

                    CKEDITOR.dialog.add('ltieditorv2Dialog', function ()
                    {
                        return{
                            title: 'LTI Tools APP Store',
                            Width: '50px',
                            Height: '600px',
                            contents:
                                    [
                                        {
                                            id: 'iframe',
                                            label: 'Insert an LTI Tool',
                                            expand: true,
                                            elements: [{
                                                    type: 'iframe',
                                                    //src:  '/e-content/ckeditorstore',
                                                    src: ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + '/ckeditorstore',
                                                    width: 1000,
                                                    height: 600,
                                                    onContentLoad: function () {
                                                        // We Access the DOM Instance of the Iframe
                                                        var iframe = document.getElementById(this._.frameId);
                                                        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                                                        $(iframeDoc).ready(function (event) {
                                                            //debugger;
                                                          //alert('iframe ready');
                                                          //$(iframeDoc).find('.appitem').click(function(event) {
                                                          $(iframeDoc).on('click', '.appitem', function(event) {
                                                           //$(varStoresNameIframe).click(function () {
                                                            var context_id = $(this).data('context');
                                                            $.ajax({
                                                                url: ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + '/ajaxresponse/' + context_id,
                                                                type: 'GET',
                                                                success: function (launchvars) {
                                                                    //Production
                                                                    //var url        = '/e-content/ajaxresponse/' +context_id;
                                                                    var url = ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + '/ajaxresponse/' + context_id;
                                                                    var div = new CKEDITOR.dom.element('div');
                                                                    var appframe = new CKEDITOR.dom.element('iframe');
                                                                    console.log('appframe', appframe);
                                                                    //Set Iframe Attributes
                                                                    div.setAttributes({
                                                                        'class': 'appframe'
                                                                    });
                                                                    appframe.setAttributes({
                                                                        'width': '100%',
                                                                        'height': 1000,
                                                                        'type': 'text/html',
                                                                        'src': url,
                                                                        'allowtransparency': 'true',
                                                                        'frameborder': 0,
                                                                        'class': 'ckeditorframev2',
                                                                        'scrolling': 'no'
                                                                    });

                                                                    // $(appframe).on('load', function() {
                                                                    //     console.log('appframe2', appframe);
                                                                    //     $(appframe).height($(appframe).contents().find("html").height());
                                                                    //     // appframe.style.height = appframe.contentWindow.document.body.scrollHeight + 'px';
                                                                    //     // $(appframe).setAttribute('height', $(appframe).contentWindow.document.body.scrollHeight + 'px');
                                                                    // });
                                                                    // $(appframe).load();
                                                                    editor.insertElement(div, div.append(appframe));
                                                                    //Insert Element and Exit Dialog Window
                                                                    CKEDITOR.dialog.getCurrent().hide();
                                                                },
                                                            })
                                                        });
                                                        });
                                     

                                                    }

                                                }]
                                        }
                                    ],
                            onOk: function () {
                                //Hide the onOk and Cancel Buttons

                            }
                        }
                    });

                    editor.addCommand('ltieditorv2DialogCmd', new CKEDITOR.dialogCommand('ltieditorv2Dialog'));
                    editor.ui.addButton('ltieditorv2Dialog',
                            {
                                label: 'LtiTools',
                                command: 'ltieditorv2DialogCmd',
                                icon: this.path + 'icons/content.png'
                            });
                }
            });

})();

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push('coursecontentDialog');
