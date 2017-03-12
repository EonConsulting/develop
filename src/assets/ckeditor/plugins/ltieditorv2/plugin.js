/*
 * @example An iframe-based dialog with frame window fit dialog size.
 */
( function() {
    var iframeWindow = null;
    CKEDITOR.plugins.add( 'ltieditorv2',
        {
            requires: [ 'iframedialog' ],
            init: function( editor )
            {
                var me = this;

                CKEDITOR.dialog.add('ltieditorv2Dialog', function ()
                {
                    return{
                        title: 'LTI Tools APP Store',
                        minWidth: 750,
                        minHeight: 450,
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
                                        // DOM Iframe Access

                                        var iframe = document.getElementById(this._.frameId);
                                        var iframeWindow = iframe.contentWindow;
                                        // Global Vars
                                        var launch_url;
                                        var key;
                                        var secret;
                                        //Still in this context we get the attribute of the clicked button
                                        iframeWindow.$('.appitem').each(function () {
                                            var $this = $(this);
                                            $this.on("click", function () {
                                                var context_id = $(this).data('context');
                                               // console.log(context_id);
                                                // Launch an AJAX Get Call i need to get keys to assign to on OK Event
                                                $.ajax({
                                                    url: '/ajaxresponse/' + context_id,
                                                    type: 'GET',
                                                    success: function (launchvars) {
                                                        var launch_url = launchvars['launch_url'];
                                                        var key        = launchvars['key'];
                                                        var secret     = launchvars['secret'];
                                                        var url        = "/eon/lti/launch?launch_url="+launch_url+"&key="+key+"&secret="+secret;
                                                        var div        = new CKEDITOR.dom.element('div');
                                                        var appframe   = new CKEDITOR.dom.element('iframe');
                                                        //Set Iframe Attributes
                                                        div.setAttributes({
                                                            'class': 'appframe'
                                                        });
                                                        appframe.setAttributes({
                                                            'width' :'100%',
                                                            'height': 500,
                                                            'type'  : 'text/html',
                                                            'src': url,
                                                            'allowtransparency': 'true',
                                                            'frameborder': 0,
                                                            'class': 'ckeditorframev2'

                                                        });

                                                        editor.insertElement(div, div.append(appframe));
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
                            //Notify the Iframe Scripts here
                           editor.insert

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