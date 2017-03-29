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
( function() {
    var iframeWindow = null;
    function createFakeElement(editor, realElement) {
        var fakeElement = editor.createFakeParserElement(realElement, 'myplugin_script', 'iframe', true);
        var fakeStyle = fakeElement.attributes.style || '';
        fakeStyle = fakeElement.attributes.style = fakeStyle + 'width:10px;';
        fakeStyle = fakeElement.attributes.style = fakeStyle + 'height:10px;';
        return fakeElement;
    }
    CKEDITOR.plugins.add( 'ltieditorv2',
        {
            requires: [ 'iframedialog', 'fakeobjects', 'image' ],
            init: function( editor )
            {
                var me = this;

                CKEDITOR.dialog.add('ltieditorv2Dialog', function ()
                {
                    return{
                        title: 'LTI Tools APP Store',
                        minWidth: 600,
                        minHeight: 400,
                        contents :
                        [
                            {
                                id: 'iframe',
                                label: 'Insert an LTI Tool',
                                expand: true,
                                elements : [{
                                    type: 'iframe',
                                    src:  '/ckeditorstore',
                                    width  : '100%',
                                    height : 450,
                                    onContentLoad: function () {
                                        // We Access the DOM Instance of the Iframe
                                        var iframe = document.getElementById(this._.frameId);
                                        var iframeWindow = iframe.contentWindow;
                                        //Still in this context we get the attribute of the selected item
                                        iframeWindow.$('.appitem').each(function () {
                                            var $this = $(this);
                                            $this.on("click", function () {
                                                var context_id = $(this).data('context');
                                                // console.log(context_id);
                                                // Launch an AJAX HTTP Request
                                                $.ajax({
                                                    url: '/ajaxresponse/' + context_id,
                                                    type: 'GET',
                                                    success: function (launchvars) {
                                                        var url        = '/ajaxresponse/' +context_id;
                                                        var height     = '';
                                                        var width      = '';
                                                        var div        = new CKEDITOR.dom.element('div');
                                                        var appframe   = new CKEDITOR.dom.element('iframe');
                                                        //Set Iframe Attributes
                                                        div.setAttributes({
                                                            'class': 'appframe',
                                                            'id' : 'appframe'
                                                        });
                                                        appframe.setAttributes({
                                                            'width' :'100%',
                                                            'type'  : 'text/html',
                                                            'id':'ckv2frame',
                                                            'height': '2000',
                                                            'src': url,
                                                            'allowtransparency': 'true',
                                                            'frameborder': 0,
                                                            'scrolling': 'no',

                                                        });
                                                        //Insert Element and Exit Dialog Window
                                                        editor.insertElement(div, div.append(appframe));
                                                        CKEDITOR.dialog.getCurrent().hide();
                                                    },
                                                })

                                            });
                                        });

                                    },
                                    afterInit: function (editor) {
                                        //Init FakeElement
                                        var dataProcessor = editor.dataProcessor;
                                        var dataFilter = dataProcessor && dataProcessor.dataFilter;
                                        if (dataFilter) {
                                            dataFilter.addRules({
                                                elements: {
                                                    'iframe': function (element) {
                                                        return createFakeElement(editor, element);
                                                    }
                                                }
                                            }, 5);
                                        }
                                    }

                                }]
                            }
                        ],
                        onOk : function () {
                            //Hide the onOk and Cancel Buttons

                        }

                    }

                });

                editor.addCommand( 'ltieditorv2DialogCmd', new CKEDITOR.dialogCommand( 'ltieditorv2Dialog' ) );

                editor.ui.addButton( 'ltieditorv2Dialog',
                    {
                        label: 'LtiTools',
                        command: 'ltieditorv2DialogCmd',
                        icon: this.path + 'icons/content.png'
                    } );
            }
        } );

} )();

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push( 'coursecontentDialog' );