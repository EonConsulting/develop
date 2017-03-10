/*
 * @example An iframe-based dialog with frame window fit dialog size.
 */
( function($) {
    CKEDITOR.plugins.add( 'coursecontent',
        {
            init: function( editor )
            {


                CKEDITOR.dialog.add('coursecontentDialog', csdialogDefinition);

                editor.addCommand( 'coursecontentDialogCmd', new CKEDITOR.dialogCommand( 'coursecontentDialog' ) );

                editor.ui.addButton( 'coursecontentDialog',
                    {
                        label: 'LtiTools',
                        command: 'coursecontentDialogCmd',
                        icon: this.path + 'icons/content.png'
                    } );

            }
        } );

    var csdialogDefinition = function (editor) {
        var openMsgDialog = function () {
            alert('This Launch URI can not be empty');
        }
        var dialogDefinition =
        {
            title : 'LTI Insert',
            minWidth  : 450,
            minHeight : 200,
            contents  : [
                {
                    // To make things simple, we are just going to have one tab

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
                                    if (!this.getValue()){
                                        openMsgDialog();
                                        return false;
                                    }
                                },
                            },{
                                type: 'text',
                                id: 'launchkey',
                                label: 'Launch KEY',
                                style: 'margin-top:5px',
                                validate: function () {

                                },
                            },{
                                type: 'text',
                                id: 'launchsecret',
                                label: 'Launch Secret',
                                style: 'margin-top:5px',
                                validate: function () {

                                },
                            },{
                                type: 'text',
                                id: 'height',
                                label: 'Iframe Height',
                                style: 'margin-top:5px',
                                width: '100px',
                                validate: function () {

                                },
                            },
                        ],

                    }]
                }
            ],
            buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ],

            onOk : function () {
                var launch_url = this.getContentElement('ltitab', 'launch_url').getInputElement().getValue();
                var key = this.getContentElement('ltitab', 'launchkey').getInputElement().getValue();
                var secret = this.getContentElement('ltitab', 'launchsecret').getInputElement().getValue();
                var url = "/eon/lti/launch?launch_url=" + launch_url + "&key=" +key + "&secret=" + secret ;
                var uheight = this.getContentElement('ltitab', 'height').getInputElement().getValue();
                var paragraph = new CKEDITOR.dom.element('div');
                var iframe =    new CKEDITOR.dom.element('iframe');
                // Set paragraphn Attributes
                paragraph.setAttributes({
                    'class': 'iframeCover',
                })
                // Set Iframe Attributes
                iframe.setAttributes({
                    'width' :'100%',
                    'height': uheight,
                    'type'  : 'text/html',
                    'src': url,
                    'allowtransparency': 'true',
                    'frameborder': 0,
                    'class': 'ckeditorframe',

                });

                editor.insertElement(paragraph, paragraph.append(iframe));

            }
        };
        return dialogDefinition;

    }
})(jQuery);

var toolbar = CKEDITOR.config.toolbarButtons;
//toolbar[toolbar.length-1].items.push( 'coursecontentDialog' );