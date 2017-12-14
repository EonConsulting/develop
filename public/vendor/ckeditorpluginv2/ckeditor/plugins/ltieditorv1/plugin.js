/**
 * Fired When the User clicks the LTI Button on the Toolbar
 * @since 1.0
 * @event click
 * @member CKEDITOR.editor
 *
 */
( function() {
    CKEDITOR.plugins.add( 'ltieditorv1',
        {
            init: function( editor )
            {
                CKEDITOR.dialog.add('ltieditorv1Dialog', function ()
                {
                    return {
                        title : 'TAO ASSESSMENT TOOL',
                        minWidth  : 450,
                        minHeight : 100,
                        contents  : [
                            {
                                id: 'ltitab',
                                label: 'Insert LTI Component',
                                title: 'Insert an LTI Component',
                                expand: true,
                                padding: 5,
                                elements : [{
                                    type: 'vbox',
                                    widths: [null, null],
                                    styles: ['vertical-align-top'],
                                    children: [
                                        {
                                            type: 'text',
                                            id: 'launch_url',
                                            label: 'Launch URL',
                                            style: 'margin-top:5px',
                                            validate: function () {
                                                if ( !this.getValue()) {
                                                    alert('Launch URL can not be empty');
                                                    return false;
                                                }
                                            }
                                        }
                                    ],
                                }]
                            }
                        ],
                        onOk : function () {

                            // Write a function that check if a certain character exists
                            // First lets get the Field
                            var dialog = CKEDITOR.dialog.getCurrent();
                            var launch_url = dialog.getContentElement('ltitab', 'launch_url').getInputElement().getValue();
                            var erorlogNum = 'XD0000000CK111';

                            //Writing a Conditional Statement
                            //If Value Contains an Index of .xml -> Send Config File to Server

                            $.ajax({
                                url: ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + '/tao-client/store',
                                type: 'post',
                                data: {launch_url: launch_url},
                                success: function (config) {
                                    if (config.status == 'success') {
                                        var url = ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + "/tao-client/show?launch_url=" + launch_url;
                                        var div = new CKEDITOR.dom.element('div');
                                        var iframe = new CKEDITOR.dom.element('iframe');
                                        div.setAttributes({
                                            'class': 'iframeCover',
                                        });
                                        iframe.setAttributes({
                                            'width': '100%',
                                            'height': '600px',
                                            'type': 'text/html',
                                            'src': url,
                                            'allowtransparency': 'true',
                                            'frameborder': 0,
                                            'class': 'ckeditorframe',

                                        });

                                        editor.insertElement(div, div.append(iframe));
                                    }
                                    else {
                                        console.log(config);
                                        var domainExistsUrl = ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + "/tao-client/show?launch_url=" + launch_url;
                                        var propDiv = new CKEDITOR.dom.element('div');
                                        var propIframe = new CKEDITOR.dom.element('iframe');
                                        propDiv.setAttributes({
                                            'class': 'iframeCover',
                                        });
                                        propIframe.setAttributes({
                                            'width': '100%',
                                            'height': '600px',
                                            'type': 'text/html',
                                            'src': domainExistsUrl,
                                            'frameborder': 0,
                                            'class': 'ckeditorframe',
                                        });

                                        editor.insertElement(propDiv, propDiv.append(propIframe));
                                    }
                                }
                            });
                        }
                    };
                });

                editor.addCommand( 'ltieditorv1DialogCmd', new CKEDITOR.dialogCommand( 'ltieditorv1Dialog' ) );

                editor.ui.addButton( 'ltieditorv1Dialog',
                {
                    label: 'TAO TOOLS',
                    command: 'ltieditorv1DialogCmd',
                    icon: this.path + 'icons/content.png'
                });
            }
        });

})();

var toolbar = CKEDITOR.config.toolbarButtons;