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
    CKEDITOR.plugins.add( 'interactivegraphs',
        {
            requires: [ 'iframedialog' ],
            init: function( editor )
            {
                var me = this;

                CKEDITOR.dialog.add('interactivegraphsDialog', function ()
                {
                    return{
                        title: 'INTERACTIVE GRAPHS',
                        minWidth: 850,
                        minHeight: 400,
                        contents :
                        [
                            {
                                id: 'iframe',
                                label: 'Insert an LTI Tool',
                                expand: true,
                                elements : [{
                                    type: 'iframe',
                                    //src:  '/ckeditorstore',
                                    src:  '/graphstore',
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
                                                    //Production Url
                                                    //url: '/ajaxresponse/' + context_id,
                                                    url: '/graphstore/init/' + context_id,
                                                    type: 'GET',
                                                    success: function (launchvars) {
                                                        //Production
                                                        //var url        = '/ajaxresponse/' +context_id;
                                                        var url        = '/graphstore/init/' +context_id;
                                                        var div        = new CKEDITOR.dom.element('div');
                                                        var appframe   = new CKEDITOR.dom.element('iframe');
                                                        console.log('appframe', appframe);
                                                        //Set Iframe Attributes
                                                        div.setAttributes({
                                                            'class': 'appframe'
                                                        });
                                                        appframe.setAttributes({
                                                            'width' :'100%',
                                                            'height': 450,
                                                            'type'  : 'text/html',
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
                        onOk : function () {
                            //Hide the onOk and Cancel Buttons

                        }

                    }

                });

                editor.addCommand( 'interactivegraphsDialogCmd', new CKEDITOR.dialogCommand( 'interactivegraphsDialog' ) );

                editor.ui.addButton( 'interactivegraphsDialog',
                    {
                        label: 'Insert an Interactive Graph',
                        command: 'interactivegraphsDialogCmd',
                        icon: this.path + 'icons/content.png'
                    } );
            }
        } );

} )();

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push( 'coursecontentDialog' );
