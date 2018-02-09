/**
 * Fired When the User clicks the LTI Button on the Toolbar
 * @since 1.0
 * @event click
 * @member CKEDITOR.editor
 *
 */
( function() {
    CKEDITOR.plugins.add( 'taoclient',
        {
            init: function( editor )
            {
                CKEDITOR.dialog.add('taoclientDialog', function ()
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
                                        },
                                        {
                                            type: 'select',
                                            id: 'assessment_type',
                                            label: 'Select Assessment Type',
                                            style: 'margin-top:5px',
                                            items: [ [ 'Self Assessment' ], [ 'Formal Assessment' ] ],
                                            'default': 'Self Assessment'
                                        },
                                        {
                                            type: 'text',
                                            id: 'assessment_weight',
                                            label: 'Assessment Weight',
                                            style: 'margin-top:5px',
                                            maxLength: '3',
                                            validate: function () {

                                                var assessment_type = CKEDITOR.dialog.getCurrent().getContentElement('ltitab', 'assessment_type').getInputElement().getValue();

                                                if(assessment_type == 'Formal Assessment' && ! this.getValue())
                                                {
                                                    alert('Assessment Weight can not be empty when using Formal Assessment!');
                                                    return false;
                                                }

                                                var numchk = new RegExp("^[0-9]*$");

                                                if( ! numchk.test( this.getValue()) || this.getValue() > 100)
                                                {
                                                    alert('Assessment Weight must be a number between 0 and 100!');
                                                    return false;
                                                }
                                            }
                                        }
                                    ]
                                }]
                            }
                        ],
                        onOk : function () {

                            // Write a function that check if a certain character exists
                            // First lets get the Field
                            var dialog = CKEDITOR.dialog.getCurrent();
                            var data_launch_url = dialog.getContentElement('ltitab', 'launch_url').getInputElement().getValue();
                            var data_assessment_type = dialog.getContentElement('ltitab', 'assessment_type').getInputElement().getValue();
                            var data_assessment_weight = dialog.getContentElement('ltitab', 'assessment_weight').getInputElement().getValue();
                            var erorlogNum = 'XD0000000CK111';

                            $.ajax({
                                url: ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + '/tao-client/store',
                                type: 'post',
                                data: {
                                    launch_url: data_launch_url,
                                    assessment_type: data_assessment_type,
                                    assessment_weight: data_assessment_weight
                                },
                                success: function (config) {
                                    if (config.status == 'success') {
                                        var url = ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + "/tao-client/show?launch_url=" + data_launch_url;
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
                                        var domainExistsUrl = ((window.global_conf.subdir !== 'undefined') ? window.global_conf.subdir : '') + "/tao-client/show?launch_url=" + data_launch_url;
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

                editor.addCommand( 'taoclientDialogCmd', new CKEDITOR.dialogCommand( 'taoclientDialog' ) );

                editor.ui.addButton( 'ltieditorv1Dialog',
                {
                    label: 'TAO TOOLS',
                    command: 'taoclientDialogCmd',
                    icon: this.path + 'icons/content.png'
                });
            }
        });

})();

var toolbar = CKEDITOR.config.toolbarButtons;